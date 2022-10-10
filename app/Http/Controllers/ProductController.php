<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\ProductRequest;
use App\Http\Controllers\BaseController;
use App\Services\ProductServices;
use App\Models\Product;
use App\Models\Category;

class ProductController extends BaseController
{
    protected $product;
    protected $productServices;
    protected $category;

    public function __construct(Product $product, Category $category, ProductServices $productServices){
        $this->product = $product;
        $this->productServices = $productServices;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productList = $this->product->getActiveProduct()->get();
        return response()->json(["data" => $productList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = statusList();
        $categoryList = @$this->category->getActiveCategory()->get()->pluck('name')->toArray();

        return Inertia::render("Admin/Product/Create",["status" => $status,"category"=>$categoryList]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try{
            if(!Gate::inspect('create', $this->product)->allowed()) return abort(403);
            DB::beginTransaction();
            
            $product = $this->product->create($request->validated());
            
            $this->product->where('id', $product->id)->update([
                'user_id' => auth()->user()->id, 
                'sku' => strtoupper($product->sku) 
            ]);

            // check discount id must be exist.
            $discount = $this->discount::findorFail($request->discount_id);

            // when discount value is set, product_discount add the new data row.
            $discount->pivotProduct()->attach($request->id, ['status' => 'active']);

            DB::commit();
            return response()->json(["data" => $product]);
        } catch(\Throwable $e){
            DB::rollback();
            return back()->with('error',$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $productShow = $this->product->find($id); 

        return Inertia::render('Front/Products/Show', ["products" => $productShow, 
                "productsCategory" => $productShow->category, 
                "productsVariant" => $productShow->variant,
                "productsAttachment" => $productShow->attachments
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        try{
            if(!Gate::inspect('update', $this->product->find($id))->allowed()) return abort(403);
            DB::beginTransaction();
            $product = $this->product->where('id',$id)->update($request->validated());

            // check discount id must be exist.
            $product = $this->product::findorFail($id);

            // when found the product id , discount value update on existing products.
            $product->pivotDiscount()->update(['discount_id' => $request->discount_id]);
            
            DB::commit();
            return response()->json(["data" => "Updated Successfully"]);
        } catch(\Throwable $e){
            DB::rollback();
            return back()->with('error',$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try{
            if(!Gate::inspect('delete', $this->product->find($id))->allowed()) return abort(403);
            $this->product->find($id)->delete();
            return response()->json(["data" => "Deleted Successfully"]);
        } catch(\Throwable $e){
            DB::rollback();
            return back()->with('error',$e->getMessage());
        }
    }

    /**
     * Product list with admin authorization
     *
     * @return void
     */
    public function admin(Request $request){
        $productList = $this->product->get();
        $columns = $this->productServices->getProductAttributes($productList);

        $search = $request->input('productSearch');
        $priceRange = $request->input('priceRange');

        $getMaxPrice = $this->productServices->getMaxPrice($this->product);

        if($search){
            $productList = $this->productServices->searchByAdmin($search, $columns, $this->product);
        }

        if($priceRange){
            $productList = $this->productServices->filterByAdmin($this->product, $priceRange);
        }

        return Inertia::render('Admin/Product/Index', ['products' => $productList, 'columns' => $columns, 'maxPrice' => $getMaxPrice ]);
    }

}
