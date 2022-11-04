<?php

namespace App\Traits;



trait DiscountTrait{
    public function discountProcess($product){
        // when discount status active, calculate the price
        $checkDiscount = $product->price;

        if(optional($product->discount)->status != 1) return $checkDiscount;

        // if discount is percentage, do the percentage calculation
        if($product->discount->method == 'percentage') $checkDiscount = $product->price * ((100 - $product->discount->value) / 100);
        // if discount is fixed, do the fixed calculation
        if($product->discount->method == 'fixed') $checkDiscount = $product->price - $product->discount->value;

        return number_format($checkDiscount, 2);
        
    }
}