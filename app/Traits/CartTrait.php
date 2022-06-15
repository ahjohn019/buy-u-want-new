<?php

namespace App\Traits;

trait CartTrait{
    public function getCartContent(){
        return \Cart::session(auth()->user()->id)->getContent();
    }

    public function getCartTotal(){
        return \Cart::session(auth()->user()->id)->getTotal();
    }

    public function clearAll(){
        \Cart::session(auth()->user()->id)->clear();
    }
}