<?php

namespace App\Http\Livewire;
use Livewire\WithPagination;
use Livewire\WithFileUploads; //subir imagenes
use Livewire\Component;
use App\Models\User;
use App\Models\Branchoffice;

class Users extends Component
{
    use WithPagination;

    public $name = '', $email = '', $password = '', $temppass='', $selected_id = 0, $search ='', $profile = 'elegir', $componentName = 'USUARIOS', $form = false, $action='Listado', $branchoffice = '';

    protected $paginationTheme = 'tailwind';

    private $pagination = 5;

    public function render()
    {
        if(strlen($this->search) > 0 ){
            $users = User::where('name', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%")
                    ->orderBy('name', 'asc')
                    ->paginate($this->pagination);
        }else{
            $users = User::orderBy('name', 'asc')
                    ->paginate($this->pagination);
        }
        return view('livewire.users.component',[
            'users' => $users,
            //'branchoffices' => Branchoffice::orderBy('id','asc')->get(),
        ])
        ->layout('layouts.theme.app');
    }


    public function noty($msg, $eventName = 'noty', $reset = true, $action = ''){
        $this->dispatchBrowserEvent($eventName,['msg' => $msg, 'type' => 'success', 'action' => $action]);
        if($reset) $this->resetUI();
    }
    public function AddNew(){
        $this->action = 'Agregar Nuevo';
        $this->resetUI();
        $this->form = true;
    }
    public function CloseModal(){
        $this->resetUI();
        $this->noty(null, 'close-modal');
    }
    public function resetUI(){
        $this->resetValidation();
        $this->resetPage();
        $this->reset('name','selected_id','temppass','search','componentName','email','password','profile','form');
    }
    public function Edit(User $user){
        $this->selected_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->profile = $user->profile;
        $this->password = null;
        $this->temppass = $user->password;
        //$this->branchoffice = $user->branchoffice_id;
        $this->form = true;
        $this->action = 'Editar';
    }
    public $listeners = ['resetUI','Destroy'];
    public function Store(){
        $this->validate(User::rules($this->selected_id),User::$messages);
        User::updateOrCreate([
            'id' => $this->selected_id],
            [
                'name' => $this->name,
                'email' => $this->email,
                'profile' => $this->profile,
                //'branchoffice_id' => $this->branchoffice,
                'password' => strlen($this->password) > 0 ? bcrypt($this->password) : $this->temppass,
        ]);
        $this->noty($this->selected_id > 0 ? 'Usuario Actulizado': 'Usuario Registrado Exitosamente');
        $this->resetUI();
    }
    public function Destroy(User $user){
        if($user->sales->count() < 1 ){
            $user->delete();
            $this->noty("El Usuario <b>$user->name</b> fue Eliminado del Sistema");
        }else{
            $this->noty('No es posible Eliminar el Usuario porque tiene ventas registradas');
        }
    }
}
