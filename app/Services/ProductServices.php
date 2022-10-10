<?php
namespace App\Services;

use App\Models\Product;

class ProductServices{

    public function getProductAttributes($productList){
        $product = $productList->first();
        return array_keys($product->toArray());
    }

    public function getMaxPrice($products){
        return max($products->pluck('price')->toArray());
    }

    public function searchByAdmin($search, $columns, $products){
        return $products->where(function($query) use($search, $columns){
                            foreach($columns as $column){
                                $query->orWhere($column, 'like', '%'. $search.'%');
                            }
                        })->get();
    }

    public function filterByAdmin($products, $priceRange){
        return $products->whereBetween('price',[0, (int)$priceRange])->get();
    }

}