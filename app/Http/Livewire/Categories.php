<?php

namespace App\Http\Livewire;


use App\Models\Category;
use Livewire\Component;
use App\Models\Image;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Categories extends Component
{

    use WithPagination;
    use WithFileUploads;

    public $form=false, $name='',$selected_id=0,$photo='';
    public $action='Listado', $componentName='Categorias',$search='';
    private $pagination = 5;
    protected $paginationTheme='tailwind';
    public function render()
    {
        if(strlen($this->search)>0)
        $info=Category::where('name','like',"%{$this->search}%")->paginate($this->pagination);
        else
        $info=Category::orderBy('name','asc')->paginate($this->pagination);
        return view('livewire.categories.component',['categories' => $info])
                ->layout('layouts.theme.app');
    }

    public function Edit(Category $category){
        $this->selected_id = $category->id;
        $this->name = $category->name;
        $this->form = true;

    }
    public function noty($msg, $eventName = 'noty', $reset = true, $action = ''){
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
        $this->resetValidation();
        $this->resetPage();
        $this->reset('name', 'selected_id', 'search', 'form' );
    }

    public $listeners=['resetUI', 'Destroy'];

    public function Store(){

        sleep(1);

        $this->validate(Category::rules($this->selected_id), Category::$messages);

        $category = Category::updateOrCreate(['id'=>$this->selected_id],[
            'name'=>$this->name,
        ]); 
        if (!empty($this->photo)) {
            // delete all images in drive
            $tempImg = $category->image->file;
            if ($tempImg != null && file_exists('storage/categories/' . $tempImg)) {
                unlink('storage/categories/' . $tempImg);
            }
            // delete relationship image from db
            $category->image()->delete();

            // generate random file name
            $customFileName = uniqid() . '_.' . $this->photo->extension();
            $this->photo->storeAs('public/categories', $customFileName);

            // save image record
            $img = Image::create([
                'model_id' => $category->id,
                'model_type' => 'App\Models\User',
                'file' => $customFileName
            ]);

            // save relationship
            $category->image()->save($img);
        }       
        $this->noty($this->selected_id > 0 ? 'CAtegoria Actualizado' : 'Categoria Registrada' , 'noty', false, 'close-modal');
        $this->resetUI();
    }
    public function Destroy(Category $category){

        if($category->products->count() < 1){

            $category->delete();
            $this->noty("La Categoria <b>$category->name</b> fue eliminada");
        }
        else{
            $this->noty("La Categoria <b>$category->name</b> tiene productos registrados");
        }
    }
}
