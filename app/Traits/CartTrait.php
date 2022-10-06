<?php
namespace App\Traits;

use App\Models\Product;
use App\Services\Cart;

trait CartTrait {
    public function getContentCart(){
        $cart = new Cart;
        return $cart->getContent()->sortBy('name');
    }
    public function getTotalCart(){
        $cart = new Cart;
        return $cart->totalAmount(false);
    }
    public function countInCart($id){
        $cart = new Cart;
        return $cart->countInCart($id);
    }
    public function getItemsCart(){
        $cart = new Cart;
        return $cart->totalItems();
    }
    public function updateQtyCart(Product $product, $cant = 1){
        $cart = new Cart;
        $cart->updateQuantity($product->id, $cant);
        $this->noty('Cantidad Actualizada');
    }
    public function addProductToCart(Product $product, $cant = 1, $changes = ''){
        $cart = new Cart;
        if($cart->existsInCart($product->id)){
            $cart->updateQuantity($product->id, $cant);
            $this->noty('Cantidad Actualizada');
        }else{
            $cart->addProduct($product, $cant, $changes);
            $this->noty('Producto Agregad');
        }
    }
    public function inCart($id){
        $cart = new Cart;
        return $cart->existsInCart($id);
    }
    public function replaceQuantyCart($id,$cant = 1){
        $cart = new Cart;
        $cart->replaceQuantity($id,$cant);
    }
    public function decreaseQtyCart($id){
        $cart = new Cart;
        $cart->decreaseQuantity($id);
        $this->noty('Cantidad Actualizada');
    }    
    public function removeProductCart($id){
        $cart = new Cart;
        $cart->removeProduct($id);
    }
    public function addChanges2Product($id, $changes){
        $cart = new Cart;
        $cart->addChanges($id, $changes);
    }
    public function clearChanges($id)
    {
        $cart = new Cart;
        $cart->removeChanges($id);
    }
    public function clearCart(){
        $cart = new Cart;
        $cart->clear();
    }
}