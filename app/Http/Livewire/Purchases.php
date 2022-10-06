<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Purchase;
use App\Models\Branchoffice;
use App\Models\Provider;

use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Purchases extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search, $form = false, $vewr = false, $date_register = '', $references = '', $almacen_id = 0, $status = 0, $provider_id = 0, $product_id;

    //Datos publicos para poder guardar datos de un nuevo proveedor
    public $name = '', $phone = '', $address = '', $email = '', $selected_id = 0;

    public $componentName = '', $action = '', $more_options = false;

    private $pagination = 10;

    public function render()
    {
        $references = Purchase::select('references')->orDerby('references','desc')->limit(10)->get();
        $this->date_register = date('d-m-Y h:i:s', time());
        if(strlen($this->search) > 0){
            $info=Purchase::join('providers as p', 'p.id', 'purchases.provider_id')
            ->select('purchases.*', 'p.name as provider')
            ->where('references','like',"%{$this->search}%")->paginate($this->pagination);
        }else{
            $info=Purchase::join('providers as p', 'p.id', 'purchases.provider_id')
            ->select('purchases.*', 'p.name as provider')->orderBy('references','desc')->paginate($this->pagination);
        }
        return view('livewire.purchases.component',[
            'purchases' => $info,
            'branchoffices' => Branchoffice::all(),
            'providers' => Provider::all(),
        ])->layout('layouts.theme.app');
    }
    public function Add(){
        $this->resetUI();
        $this->date_register = date('m-d-Y h:i:s a', time());
        dd($this->date_register);
        $this->form = true;
    }
    public function StoreNewP(){
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
        $this->provider_id = $provider->id;
        $this->dispatchBrowserEvent('closeModalAddProvider');
        $this->noty($this->selected_id > 0 ? 'Proveedor Actualizado' : 'Proveedor Registrado', 'noty', true, 'listado');
    }

    public function noty($msg, $eventName = 'noty', $reset = true, $action = ''){
        $this->dispatchBrowserEvent($eventName,['msg' => $msg, 'type' => 'success', 'action' => $action]);
    }
    public function ShowPurchase(Purchase $purchase){
        $this->vewr = true;
        $this->form = false;
        
        //dd($this->vewr);
        //return view('livewire.purchases.purchaseDetails')->layout('layouts.theme.app');;
    }
}
