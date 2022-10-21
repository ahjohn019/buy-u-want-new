<?php
namespace App\Services;

use App\Models\Product;
use App\Models\Category;

class ProductServices{

    public function inputCondition($request, $product){
        $productList = $product->get();

        $search = $request->productSearch;
        $priceRange = $request->priceRange;

        if($search){
            $columns = $this->getProductAttributes($productList);
            $productList = $this->searchByAdmin($search, $columns, $product);
        }

        if($priceRange){
            $productList = $this->filterByAdmin($product, $priceRange);
        }

        return $productList;
    }

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

    public function validated($request){
        $productData = ['user_id' => auth()->user()->id, 'image' => optional($request->attachments)->hashName()];
        $validated = array_merge($request->validated(), $productData);
        
        $validated['sku'] = strtoupper($validated['sku']);
        $validated['status'] == "active" ? $validated['status'] = 1 : $validated['status'] = 0;
        $category = Category::get();

        foreach($category as $cat){
            if($validated['category_id'] == $cat->name){
                $validated['category_id'] = $cat->id;
            }
        }

        return $validated;
    }

}