<?php
namespace App\Services;

use App\Models\Product;

class VariantServices
{
    /**
     * Get The list of product id & find the product owner who modify variant 
     *
     * @param string $request
     * @param string $product
     * @return void
     */
    public function check($request, $product){
        $getProductId = $product::pluck('id')->all();
        $getProductOwner = $product::find($request->product_id)->user_id ?? null;

        return ["getProductId"=> $getProductId, "getProductOwner"=> $getProductOwner];
    }

    /**
     * Check the product belongs to the owner
     *
     * @param string $request
     * @param string $product
     * @return void
     */
    public function checkProductInvalid($request, $product){
        $productInvalid = !in_array($request->product_id, $this->check($request, $product)['getProductId']) 
                          || auth()->user()->id != $this->check($request, $product)['getProductOwner'];

        return $productInvalid;
    }
}