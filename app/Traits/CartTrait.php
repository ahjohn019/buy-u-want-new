<?php

namespace App\Traits;

use Cart;

trait CartTrait{
    public function getCartContent(){
        return Cart::session(auth()->user()->id)->getContent();
    }

    public function getCartTotal(){
        return number_format(Cart::session(auth()->user()->id)->getTotal(), 2);
    }

    public function getUnitPrice($productId){
        return number_format(Cart::get($productId)->getPriceSum(), 2);
    }

    public function clearAll(){
        Cart::session(auth()->user()->id)->clear();
    }

    public function getQuantity(){
        return Cart::getTotalQuantity();
    }
}