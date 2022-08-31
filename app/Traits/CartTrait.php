<?php

namespace App\Traits;

use Cart;

trait CartTrait{
    private function getCartContent(){
        return Cart::session(auth()->user()->id)->getContent();
    }

    private function getCartTotal(){
        return number_format(Cart::session(auth()->user()->id)->getTotal(), 2);
    }

    private function getUnitPrice($productId){
        return number_format(Cart::get($productId)->getPriceSum(), 2);
    }

    private function clearAll(){
        Cart::session(auth()->user()->id)->clear();
    }
}