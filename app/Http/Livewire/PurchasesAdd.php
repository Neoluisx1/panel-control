<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Branchoffice;
use App\Models\Provider;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\PurchaseDetail;
use App\Traits\CartpTrait;

use DB;

class PurchasesAdd extends Component
{
    use CartpTrait;

    public  $totalCart = 0, $itemsCart = 0, $contentCartp = [];

    //Datos publicos para poder guardar datos de un nuevo proveedor
    public $name = '', $phone = '', $address = '', $email = '', $selected_id = 0, $changes = '', $total, $payment, $items, $type;

    //datos publicos para poder editar precios de un producto
    public $price = 0, $product_name = '', $qty = 0, $unit_product = '', $cost = 0, $selected_idP = 0;


    public $search = '', $form = false, $date_register = '', $references = '', $almacen_id = 0, $status = '', $provider_id = 0, $product_id, $branchoffice_id = 'Elegir';

    public $componentName = '', $action = '', $more_options = false, $providerSelected = 'Seleccionar Proveedor';

    public function render()
    {
        $references = Purchase::select('references')->orDerby('references','desc')->limit(1)->get();
        $this->date_register = date('d-m-Y h:i:s', time());

        if($references){

            $num = explode("/",$references);
            $num_atual = sprintf('%04d',(int)($num[2])+1);
        }else{
            $num_atual = 1;
        }
        $this->references = 'COMPRA'.date('Y/d', time()).'/'.$num_atual;


        if(strlen($this->search) > 0){
            $products = Product::where('name','like',"%{$this->search}%")->get();
        }
        else{$products = [];}
        $this->contentCartp = $this->getContentCartp();
        $this->totalCart = $this->getTotalCartp();
        $this->itemsCart = $this->getItemsCartp();
        return view('livewire.purchasesadd.purchases-add',[
            'branchoffices' => Branchoffice::all(),
            'providers' => Provider::all(),
            'products' => $products,
        ])->layout('layouts.theme.app');
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
    public $listeners = [
            'addProduct' => 'addProduct',
    ];
    public function addProduct(Product $product){
        //agregar los datos para poder agregar los productos a la venta
        $this->addProductToCartp($product, 1, $this->changes);
        $this->changes = '';
        $this->search = null;
    }
    public function removeFromCartp($id)
    {
        $this->removeProductCartp($id);
        $this->search = null;
    }

    public function updateQty(Product $product, $cant = 1)
    {
        if ($cant <= 0)
            $this->removeProductCartp($product->id);
        else
            $this->replaceQuantyCartp($product->id, intval($cant));
        $this->search = null;
    }
    // Guardar nueva Compra //
    public function storePurchase($print = false){
        $this->validate(Purchase::rules($this->provider_id),Purchase::$messages);

        if ($this->getTotalCartp() <= 0) {
            $this->noty('AGREGA PRODUCTOS A LA VENTA', 'noty', 'error');
            return;
        }
        \DB::beginTransaction();
        try {
            if ($this->provider_id != 0) {
            } else {
                $this->noty('Selecciona un Proveedor', 'noty', 'error');
                return;
            }

            $sale = Purchase::create([
                'provider_id' => $this->provider_id,
                'references' => $this->references,
                'total' => $this->getTotalCartp(),
                'payment' => $this->getTotalCartp(),
                'status' => $this->status,
                'user_register' => auth()->user()->id,
                'user_edit' => auth()->user()->id,
                'branchoffice_id' => $this->branchoffice_id,
                'created_at' => $this->date_register,
                'items' => $this->getItemsCartp(),
                'type' => 'Web',
            ]);

            if ($sale) {
                $items = $this->getContentCartp();
                foreach ($items as  $item) {
                    PurchaseDetail::create([
                        'purchase_id' => $sale->id,
                        'product_id' => $item->id,
                        'quantity' => $item->qty,
                        'price' => $item->price,
                    ]);

                    //update stock
                    $product = Product::find($item->id);
                    $product->stock = $product->stock + $item->qty;
                    $product->save();
                }
            }


            DB::commit();


            $this->noty('Compra Registrada con Éxito');

        } catch (Exception $e) {
            DB::rollback();
            $this->not('Error al guardar el pedido: ' . $e->getMessage(), 'noty', 'error');
        }
        $this->clearCartp();
        $this->resetUI();
    }
    public function resetUI(){
        $this->reset('provider_id','references','total','payment','status','branchoffice_id','items', 'type', 'search', 'totalCart', 'itemsCart','contentCartp');
    }
    public function editProduct(Product $product){
        $cant = $this->cantidadProductCartp($product->id);
        $this->product_name = $product->name;
        $this->qty = $cant;
        $this->unit_product = $product->unit_product;
        $this->cost = $product->cost;
        $this->selected_idP = $product->id;
        $this->dispatchBrowserEvent('openModalEditProduct');
    }
    public function StoreEditProduct(){
        $this->validate([
            'qty' => 'required',
            'cost' => 'required',
        ],[
            'qty.required' => 'Ingresa la Cantidad',
            'cost.required' => 'Ingresa el Costo',
        ]);
        if($this->cost <= 0){
            $this->noty('El Costo no puede ser 0', 'noty', 'error');
            return;
        }else{
            $this->updateCostCartp(intval($this->selected_idP), $this->cost);
        }
        if ($this->qty <= 0){
            $this->removeProductCartp($this->selected_idP);
            $this->noty('Producto Eliminado de la Lista de Compras', 'noty', true, 'listado');
        }else{
            $this->replaceQuantyCartp($this->selected_idP, intval($this->qty));
        }
        $this->dispatchBrowserEvent('closeModalEditProduct');
        $this->noty('Producto Actualizado', 'noty', true, 'listado');
        $this->search = null;
    }
}
