<?php

namespace App\Traits;

use Cart;

trait CartTrait{
    public function getAuthSession(){
        return Cart::session(auth()->user()->id);
    }

    public function getCartContent(){
        return $this->getAuthSession()->getContent();
    }

    public function getCartTotal(){
        return number_format($this->getAuthSession()->getTotal(), 2);
    }

    public function getUnitTotal($cartContent){
        return array_map(function($v){return $v['price'] * $v['quantity'];}, $cartContent->toArray());
    }

    public function clearAll(){
        $this->getAuthSession()->clear();
    }

    public function getQuantity(){
        return Cart::getTotalQuantity();
    }

    public function getList(){
        $cartContent = $this->getCartContent();
        $unitTotal = $this->getUnitTotal($cartContent);

        return [ 'cart'=>$cartContent, 'unitTotal' => $unitTotal];
    }
}