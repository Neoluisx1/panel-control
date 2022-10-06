<?php
namespace App\Services;


use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class Cartp {
    protected Collection $cartp;

    public function __construct(){
        if(session()->has("cartp")){
            $this->cartp = session("cartp");
        }else{
            $this->cartp = new Collection;
        }
    }

    // obtener contenido del carrito     
    public function getContent(): Collection
    {
            return $this->cartp->sortBy(['name', ['name', 'asc']]);
    }

    // guardar el carrito en sesion
    protected function save(): void
    {
        session()->put("cartp", $this->cartp);
        session()->save();
    }


    // agregar un producto al carrito de Compras   
    public function addProduct(Product $product, $cant = 1, $changes = 0): void
    {       
        $pre = Arr::add($product, 'qty', 1);
        $this->validate($pre);
        $this->cartp->push($pre);
        $this->save();
    }

    // agregar cambios a un producto / platillo
    public function addChanges($id, $changes)
    {      
        $mycart = $this->getContent();
        $oldItem = $mycart->where('id', $id)->first();
        $newItem = $oldItem;        
        $newItem->changes = $changes;

        $this->removeProduct($id);
        $this->addProduct($newItem);
    }
    public function removeChanges($id)
    {
        $mycart = $this->getContent();
        $oldItem = $mycart->where('id', $id)->first();
        $newItem = $oldItem;
        $newItem->changes = '';
        $this->removeProduct($id);
        $this->addProduct($newItem);
    }



    // validar si existe X producto en carrito
    public function existsInCartp(int $id): bool
    {
        $mycartp = $this->getContent();
        $cont = $mycartp->where('id', $id)->count();
        $res = $cont > 0 ? true : false;
        
        return $res;
    }

    // cantidad de X producto agregada al carrito
    public function countInCartp(int $id): int
    {
        $mycartp = $this->getContent();
        $cont = $mycartp->where('id', $id)->sum('qty');
        return $cont;
    }


    // incrementar cantidad de X producto en carrito
    public function updateQuantity(int $id, $cant = 1): void
    {
        $mycart = $this->getContent();
        $oldItem = $mycart->where('id', $id)->first();
        $newItem = $oldItem;
        $newItem->qty += $cant;
        $this->removeProduct($id);
        $this->addProduct($newItem); 
    }

    // decrementar cantidad de X producto en carrito
    public function decreaseQuantity($id, $cant = 1)
    {
        $mycart = $this->getContent();
        $oldItem = $mycart->where('id', $id)->first();
        $newItem = $oldItem;
        $newItem->qty -= $cant;
        $this->removeProduct($id);
        if ($newItem->qty > 0) $this->addProduct($newItem);
    }

    // reemplazar cantidad de X producto en carrito
    public function replaceQuantity($id, $cant = 1): void
    {        
        $mycart = $this->getContent();
        $oldItem = $mycart->where('id', $id)->first();
        $newItem = $oldItem;
        $newItem->qty = $cant;
        $this->validate($newItem);
        $this->removeProduct($id);
        $this->addProduct($newItem);
    }



    // eliminar producto del carrito    
    public function removeProduct(int $id): void
    {
        $this->cartp = $this->cartp->reject(function (Product $product) use ($id) {
            return $product->id === $id;
        });
        $this->save();
    }

    // obtenemos total en carrito     
    public function totalAmount(){
        $amount = $this->cartp->sum(function ($product) {
            return ($product->cost * $product->qty);
        });
        return $amount;
    }



    // obtenemos el cantidad de productos en carrito
    public function hasProducts(): int
    {
        return $this->cart->count();
    }

    // obtenemos sumatoria de productos en carrito
    public function totalItems(): int
    {

        $items = $this->cartp->sum(function ($product) {
            return $product->qty;
        });
        return $items;
    }

    // vaciar carrito
    public function clear(): void
    {
        $this->cartp = new Collection;
        $this->save();
    }



    // validación antes de agregar item al carrito
    protected function validate($item)
    {
        $validator = Validator::make($item->toArray(), [
            'id' => 'required',
            'price' => 'required|numeric',
            'qty' => 'required|numeric|min:1',
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            throw new \ErrorException($validator->messages());
        }

        return $item;
    }
    public function cantProductCartp($id){
        $mycart = $this->getContent();
        $oldItem = $mycart->where('id', $id)->first();
        return $oldItem->qty;
    }
    public function replaceCost($id, $cost){
        $mycart = $this->getContent();
        $oldItem = $mycart->where('id', $id)->first();
        $newItem = $oldItem;
        $newItem->cost = $cost;
        
    }

}