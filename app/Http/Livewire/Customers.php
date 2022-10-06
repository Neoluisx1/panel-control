<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class Customers extends Component
{
    use WithPagination;

    public $name='',$ci_nit='',$phone='',$city='',$mail='',$notes='', $selected_id=0,$address='';
    public $search='', $componentName='CLIENTES', $action='Listado', $form= false;
    private $pagination=5;
    protected$paginationTheme = 'tailwind';
    public function render()
    {
        if(strlen($this->search)>0)
            $customers = Customer::where('name','like',"%{$this->search}%")->orWhere('ci_nit','like',"%{$this->search}%")->orWhere('phone','like',"%{$this->search}%")->orWhere('city','like',"%{$this->search}%")->orWhere('mail','like',"%{$this->search}%")->orderBy('name','asc')->paginate($this->pagination);
        else
            $customers = Customer::orderBy('name','asc')->paginate($this->pagination);
        return view('livewire.customers.component',['customers' => $customers])->layout('layouts.theme.app');
    }
    public function noty($msg, $eventName = 'Noty', $reset = true, $action = ''){
        $this->dispatchBrowserEvent($eventName, ['msg' => $msg, 'type' => 'success', 'action' => $action]);
        if($reset) $this->resetUI();
    }

    public function AddNew(){
        $this->resetUI();
        $this->form=true;
        $this->action = 'Agregar';
    }
    public function CloseModal(){
        $this->resetUI();
        $this->noty(null,'close-modal');
    }
    public function resetUI(){
        $this->resetPage();
        $this->resetValidation();
        $this->reset('name','ci_nit', 'selected_id', 'search', 'phone', 'city', 'mail', 'notes', 'form','address');
    }

    public function Edit(Customer $customer){
        $this->selected_id = $customer->id;
        $this->name = $customer->name;
        $this->ci_nit = $customer->ci_nit;
        $this->address = $customer->address;
        $this->phone = $customer->phone;
        $this->city = $customer->city;
        $this->mail = $customer->mail;
        $this->notes = $customer->notes;
        $this->form = true;
    }

    public $listeners=['resetUI', 'Destroy'];

    public function Store(){
        $this->validate(Customer::rules($this->selected_id), Customer::$messages);

        Customer::updateOrCreate(['id'=>$this->selected_id],[
            'name'=>$this->name,
            'ci_nit'=>$this->ci_nit,
            'phone'=>$this->phone,
            'city'=>$this->city,
            'address'=>$this->address,
            'mail'=>$this->mail,
            'notes'=>$this->notes,
        ]);

        $this->noty($this->selected_id > 0 ? 'Cliente Actualizado' : 'Cliente Registrado' , 'noty', false, 'close-modal');
        $this->resetUI();
    }
    public function Destroy(Customer $customer){
        if($customer->orders->count()<1){
            $customer->delete();
            $this->noty("El cliente <b>$customer->name</b> fue eliminado");
        }
        else{
            $this->noty("El clietne tiene ventas relacioandas no se puede eliminar");
        }
    }
}
