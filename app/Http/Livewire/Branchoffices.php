<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Branchoffice;


use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Branchoffices extends Component
{

    use WithPagination;
    use WithFileUploads;
    
    public $search = '', $form = false, $assignments = false, $selected_id=0,$name='',$phone='',$address='',$leyend='';

    public $componentName = 'SUCURSALES ', $action = ' Registrar Nueva Sucursal';

    private $pagination = 5;

    protected $paginationTheme='tailwind';

    public function render()
    {
        if(strlen($this->search) > 0)
        $info=Branchoffice::where('name','like',"%{$this->search}%")->paginate($this->pagination);
        else
        $info=Branchoffice::orderBy('name','asc')->paginate($this->pagination);
        
        return view('livewire.branchoffices.component',[
            'branch' => $info
        ])->layout('layouts.theme.app');;
    }

    public function AddNew(){
        $this->resetUI();
        $this->form=true;
        $this->action = 'Agregar';
    }

    public function Destroy(Branchoffice $branchOffice){
                
        if($branchOffice->users->count() < 1){

            $branchOffice->delete();
            $this->noty("La Sucursal <b>$branchOffice->name</b> fue eliminada");
        }
        else{
            $this->noty("La Sucursal  tiene Usuarios Asignados");
        }
    }

    public function Store(){
        
        $this->validate(Branchoffice::rules($this->selected_id), Branchoffice::$messages);

        $new_branch = Branchoffice::updateOrCreate(['id'=>$this->selected_id],[
            'name'=>$this->name,
            'phone'=>$this->phone,
            'address'=>$this->address,
            'leyend'=>$this->leyend,
        ]); 

        $this->noty($this->selected_id > 0 ? 'Se actualizo correctamente los datos de la Sucursal' : 'Se Registro correctamente la nueva Sucursal' , 'noty', false, 'close-modal');
        $this->resetUI();
    }
    public function resetUI(){
        $this->resetValidation();
        $this->resetPage();
        $this->reset('name', 'selected_id', 'search', 'form','phone','address','leyend','assignments');
    }
    public $listeners=['Destroy','resetUI','Asignados'];

    public function Edit(Branchoffice $branchOffice){
        $this->selected_id = $branchOffice->id;
        $this->name = $branchOffice->name;
        $this->phone = $branchOffice->phone;
        $this->address = $branchOffice->address;
        $this->leyend = $branchOffice->leyend;
        $this->form = true;

    }
    
    public function noty($msg, $eventName = 'noty', $reset = true, $action = ''){
        $this->dispatchBrowserEvent($eventName,['msg' => $msg, 'type' => 'success', 'action' => $action]);
        if($reset) $this->resetUI();
    }    
    public function Asignados(Branchoffice $branchOffice){
        $this->action = 'Ver Listas';
        $this->assignments = true;
        
    }
}
