<?php
namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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

    public function getMaxPrice(){
        $product = Product::all();
        return max($product->pluck('price')->toArray());
    }

    public function searchByAdmin($search, $products){
       $columns = productColumnName();
       $search = $products->searchProductByAdmin($search, $columns)->get();

       return $search;
    }

    public function validated($request){

        $productData = ['user_id' => auth()->user()->id, 'image' => optional($request->attachments)->hashName()];
        $validated = array_merge($request->validated(), $productData);
        $validated['sku'] = strtoupper($validated['sku']);
        $validated['status'] = $validated['status']['id'];
        $validated['category_id'] = $validated['category_id']['id'];


        return $validated;
    }

}