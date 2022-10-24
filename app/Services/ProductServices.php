<?php
namespace App\Services;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class ProductServices{

    public function inputCondition($request){
        $productQuery = Product::query();
        $productAdminIndex = $productQuery->GetAdminIndex();
        $productList = $productAdminIndex->get();
 
        $search = $request->productSearch;
        $priceRange = $request->priceRange;

        if($search) $productList = $this->searchByAdmin($search,  $productAdminIndex);
        if($priceRange) $productList = $productAdminIndex->filterPrice($priceRange)->get();
        
        return $productList;
    }

    public function getProductAttributes(){
        $product = Product::getAdminIndex()->first();
        return array_keys($product->toArray());
    }

    public function getMaxPrice(){
        $product = Product::all();
        return max($product->pluck('price')->toArray());
    }

    public function searchByAdmin($search, $products){
       $columns = $this->getProductAttributes();
       $search = $products->searchProductByAdmin($search, $columns)->get();

       return $search;
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