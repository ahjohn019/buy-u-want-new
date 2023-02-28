<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Attachment;
use Illuminate\Http\Request;
use App\Services\ProductServices;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\BaseController;
use App\Services\ConditionServices;

class ProductController extends BaseController
{
    protected $product;
    protected $productServices;
    protected $category;
    protected $variantService;

    public function __construct(Product $product, Category $category, ProductServices $productServices, ConditionServices $conditionServices){
        $this->product = $product;
        $this->productServices = $productServices;
        $this->category = $category;
        $this->conditionServices = $conditionServices;
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
    public function create(DB $database)
    {

        $status = $database::table('status')->get();
        $category = $database::table('categories')->get();

        return Inertia::render("Admin/Product/Create",["status" => $status,"category"=>$category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        if(!Gate::inspect('create', $this->product)->allowed()) return abort(403);

        try {
            DB::transaction(function() use($request) {
                $validated = $this->productServices->validated($request);
                $product = $this->product->create($validated);
            });
            return redirect()->route("products.admin")->with('createProductSuccesMessage', sessionMessage()['createProductSuccesMessage']);
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
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
        $productShow = $this->product->with('category','variant','attachments')->find($id); 

        return Inertia::render('Front/Products/Show', ["products" => $productShow]);
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
            // if(!Gate::inspect('update', $this->product->find($id))->allowed()) return abort(403);

            DB::transaction(function() use($request, $id){
                $status = DB::table('status')->where('name', $request->status)->first();
                $requestValidated = $request->validated();
                $requestValidated['status'] = $status->id;

                $product = $this->product->where('id',$id)->update($requestValidated);
            });

            return redirect()->back()->with(['updateProductSuccessMessage' => sessionMessage()['updateProductSuccessMessage']]);
        } catch(\Throwable $e){
            dd($e);
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
            // if(!Gate::inspect('delete', $this->product->find($id))->allowed()) return abort(403);
            $this->product->find($id)->delete();
            return redirect()->back()->with(['deleteProductSuccessMessage' => sessionMessage()['deleteProductSuccessMessage']]);
            // return response()->json(["data" => "Deleted Successfully"]);
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
        try {
            $productList = $this->productServices->inputCondition($request);
            $getMaxPrice = $this->productServices->getMaxPrice();
            $status = DB::table('status')->get();

            return Inertia::render('Admin/Product/Index', [
                'products' => $productList, 
                'columns' => productColumnName(), 
                'maxPrice' => $getMaxPrice,
                'status' => $status 
            ]);
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
        
    }

}
