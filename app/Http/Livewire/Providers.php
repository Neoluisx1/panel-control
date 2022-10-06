<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Livewire\WithPagination;
use Livewire\WithFileUploads;

use App\Models\Provider;

class Providers extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $name = '', $address = '', $phone = '' ,$email = '', $form = false, $selected_id = 0, $search='';

    public $componentName = 'PROVEEDORES ', $action = ' Registrar Nuevo';

    private $pagination = 5;
    protected $paginationTheme='tailwind';

    public function render()
    {
        if(strlen($this->search) > 0){
            $info=Provider::where('name','like',"%{$this->search}%")->paginate($this->pagination);
        }else{
            $info=Provider::orderBy('name','asc')->paginate($this->pagination);
        }
        
        return view('livewire.providers.component',[
            'providers' => $info,
        ])->layout('layouts.theme.app');
    }
    public function Add(){
        $this->form = true;
        $this->action = 'Registrar Nuevo';
        $this->componentName = 'PROVEEDORES';
    }
    public $listeners = ['resetUI', 'Destroy'];
    
    public function Store(){
        $this->validate(Provider::rules($this->selected_id),Provider::$messages);
        $provider = Provider::updateOrCreate(
            ['id' => $this->selected_id ],
            [
                'name' => $this->name,
                'address' => $this->address,
                'phone' => $this->phone,
                'email' => $this->email,
            ]
        );
        $this->noty($this->selected_id > 0 ? 'Proveedor Actualizado' : 'Proveedor Registrado', 'noty', true, 'listado');
    }
    public function noty($msg, $eventName = 'noty', $reset = true, $action = ''){
        $this->dispatchBrowserEvent($eventName,['msg' => $msg, 'type' => 'success', 'action' => $action]);
        if($reset) $this->resetUI();
    }
    public function resetUI(){
        $this->resetValidation();
        $this->resetPage();
        $this->reset('name','phone','address','email','selected_id','search','action','componentName','action','form');
    }
    public function Edit(Provider $provider){
        $this->selected_id = $provider->id;
        $this->name = $provider->name;
        $this->address = $provider->address;
        $this->phone = $provider->phone;
        $this->email = $provider->email;
        $this->form = true;
    }
    public function Destroy($id){
        $provider = Provider::find($id);
        $provider->delete();
        $this->noty("La Categoria <b>$provider->name</b> fue eliminada");
    }
}
