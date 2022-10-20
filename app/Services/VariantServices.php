<?php
namespace App\Services;

use App\Models\Product;
use App\Models\Variant;

class VariantServices
{
    /**
     * Save the variant into database along with product id
     *
     * @param array $request
     * @param array $product
     * @return void
     */
    public function save($request, $product){

        foreach($request->variants as $key => $value){
            $value = array_column($value, $key);

            foreach($value as $a){
                Variant::create([
                    'name' => $key,
                    'type' => $a,
                    'product_id' => $product->id,
                    'status' => 1
                ]);
            }

        }

                        
    }
}