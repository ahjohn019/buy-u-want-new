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
        
        $search = $request->search;
        $priceRange = $request->price;

        if($search) $productList = $this->searchByAdmin($search,  $productAdminIndex);
        if($priceRange) $productList = $productAdminIndex->filterPrice($priceRange)->get();
        
        return $productList;
    }

    public function getMaxPrice(){
        $product = Product::all();
        $price = empty($product->pluck('price')->toArray()) ? 0 : max($product->pluck('price')->toArray());
        return $price;
    }

    public function searchByAdmin($search, $products){
       $columns = productColumnName();
       $searchContent = array_diff($columns,['attachments']);
       $search = $products->searchProductByAdmin($search, $searchContent)->get();

       return $search;
    }

    public function validated($request){
        $getTagsOnly = array_column($request->tags, 'tags');
        $productData = ['user_id' => auth()->user()->id, 'image' => optional($request->attachments)->hashName(), 'tags' => json_encode($getTagsOnly)];
        $validated = array_merge($request->validated(), $productData);
        $validated['sku'] = strtoupper($validated['sku']);
        $validated['status'] = $validated['status']['id'];
        $validated['category_id'] = $validated['category_id']['id'];

        return $validated;
    }

}