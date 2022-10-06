<?php

namespace App\Http\Livewire;

use App\Models\Venta;
use Livewire\Component;
use Livewire\WithPagination;

class Ventas extends Component
{
    use WithPagination;
    public $name='',$namecliente='',$pago='',$tipo='',$total='',$cambio='', $selected_id=0;
    public $search='', $componentName='VENTAS', $action='Listado', $form= false;
    public function render()
    {
        return view('livewire.ventas.component');
    }
}
