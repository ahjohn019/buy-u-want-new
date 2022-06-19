<?php
namespace App\Services;

use App\Models\Product;

class VariantServices
{
    public function restrictProduct($request){
        $getProductId = Product::pluck('id')->all();
        $findProduct = Product::find($request->product_id);
        $getProductOwnerId = $findProduct->user_id ?? null;

        return ["getProductId"=> $getProductId, "getProductOwnerId"=> $getProductOwnerId];
    }

}