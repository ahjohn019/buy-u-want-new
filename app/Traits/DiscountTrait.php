<?php

namespace App\Traits;



trait DiscountTrait{
    public function discountProcess($product){
        // get product from product discount table, check active status data.
        $getDiscount = $product->pivotDiscount->first();
        $getDiscountStatus = $getDiscount->pivot->status ?? $product->price;

        // when discount status active, calculate the price
        $checkDiscount = $product->price;
        if($getDiscountStatus != 'active') return $checkDiscount;

        // if discount is percentage, do the percentage calculation
        if($getDiscount->method == 'percentage') $checkDiscount = $product->price * ((100 - $getDiscount->value) / 100);
        // if discount is fixed, do the fixed calculation
        if($getDiscount->method == 'fixed') $checkDiscount = $product->price - $getDiscount->value;

        return number_format($checkDiscount, 2);
        
    }
}