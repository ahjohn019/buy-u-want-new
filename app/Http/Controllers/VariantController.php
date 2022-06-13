<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;
use App\Http\Requests\VariantRequest;
use Illuminate\Support\Facades\DB;

class VariantController extends BaseController
{

    public function restrictProduct($request){
        $getProductId = Product::pluck('id')->all();
        $findProduct = Product::find($request->product_id);
        $getProductOwnerId = $findProduct->user_id ?? null;

        return ["getProductId"=> $getProductId, "getProductOwnerId"=> $getProductOwnerId];
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $variantList = Variant::getActiveVariant()->get();
        return $variantList;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VariantRequest $request)
    {
        //
        try{
            $productNotValid = !in_array($request->product_id, $this->restrictProduct($request)['getProductId']) 
                               || auth()->user()->id != $this->restrictProduct($request)['getProductOwnerId'];

            if($productNotValid){
                return response()->json(["data" => "Unauthorized", "status" => 0]);
            }

            $variantCreate = Variant::create($request->validated());
            return response()->json(["data" => $variantCreate, "status" => 1]);
        } catch(\Throwable $e){
            dd($e);
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
        $variantShow = Variant::find($id);
        return $variantShow->product;
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
    public function update(VariantRequest $request, $id)
    {
        //
        try{

            $productNotValid = !in_array($request->product_id, $this->restrictProduct($request)['getProductId']) 
                               || auth()->user()->id != $this->restrictProduct($request)['getProductOwnerId'];

            if($productNotValid){
                return response()->json(["data" => "Unauthorized", "status" => 0]);
            }

            $variantUpdate = Variant::where('id', $id)->update($request->validated());
            return response()->json(["data" => $variantUpdate, "status" => 1]);

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

            if(auth()->user()->id != Variant::find($id)->product->user_id){
                return response()->json(["data" => "Unauthorized", "status" => 0]);
            }

            return response()->json(["data" => "Delete Variant", "status" => 1]);
        } catch(\Throwable $e){
            DB::rollback();
            return back()->with('error',$e->getMessage());
        }

    }
}
