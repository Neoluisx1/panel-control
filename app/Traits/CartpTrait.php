<?php
namespace App\Traits;

use App\Models\Product;
use App\Services\Cartp;

trait CartpTrait {
    public function getContentCartp(){
        $cartp = new Cartp;
        return $cartp->getContent()->sortBy('name');
    }
    public function getTotalCartp(){
        $cartp = new Cartp;
        return $cartp->totalAmount(false);
    }
    public function countInCartp($id){
        $cartp = new Cartp;
        return $cartp->countInCartp($id);
    }
    public function getItemsCartp(){
        $cartp = new Cartp;
        return $cartp->totalItems();
    }
    public function updateQtyCartp(Product $product, $cant = 1){
        $cartp = new Cartp;
        $cartp->updateQuantity($product->id, $cant);
        $this->noty('Cantidad Actualizada');
    }
    public function addProductToCartp(Product $product, $cant = 1, $changes = ''){
        $cartp = new Cartp;
        if($cartp->existsInCartp($product->id)){
            $cartp->updateQuantity($product->id, $cant);
            $this->noty('Cantidad Actualizada');
        }else{
            $cartp->addProduct($product, $cant, $changes);
            $this->noty('Producto a la Lista de Compras');
        }
    }
    public function inCartp($id){
        $cartp = new Cartp;
        return $cartp->existsInCartp($id);
    }
    public function replaceQuantyCartp($id,$cant = 1){
        $cartp = new Cartp;
        $cartp->replaceQuantity($id,$cant);
        $this->noty('La Cantidad se actualizo Correctamente');
    }
    public function decreaseQtyCartp($id){
        $cartp = new Cartp;
        $cartp->decreaseQuantity($id);
        $this->noty('Cantidad Actualizada');
    }    
    public function removeProductCartp($id){
        $cartp = new Cartp;
        $cartp->removeProduct($id);
        $this->noty('El Producto se Elimino correctamente de la Lista de Compras');
    }
    public function addChanges2Product($id, $changes){
        $cartp = new Cartp;
        $cartp->addChanges($id, $changes);
    }
    public function clearChanges($id)
    {
        $cartp = new Cartp;
        $cartp->removeChanges($id);
    }
    public function clearCartp(){
        $cartp = new Cartp;
        $cartp->clear();
    }
    public function cantidadProductCartp($id){
        $cartp = new Cartp;
        return $cartp->cantProductCartp($id);
    }
    public function updateCostCartp($id, $cost = 1){
        $cartp = new Cartp;
        $cartp->replaceCost($id,$cost);
        $this->noty('La Cantidad se actualizo Correctamente');
    }
}