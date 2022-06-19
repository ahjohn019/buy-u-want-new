<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\VariantRequest;
use Illuminate\Support\Facades\DB;
use App\Services\VariantServices;

class VariantController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $variantList = $this->variant->getActiveVariant()->get();
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
            $productNotValid = !in_array($request->product_id, $this->variantServices->restrictProduct($request)['getProductId']) 
                               || auth()->user()->id != $this->variantServices->restrictProduct($request)['getProductOwnerId'];

            if($productNotValid){
                return response()->json(["data" => "Unauthorized", "status" => 0]);
            }

            $variantCreate = $this->variant->create($request->validated());
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
        $variantShow = $this->variant->find($id);
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
            $productNotValid = !in_array($request->product_id, $this->variantServices->restrictProduct($request)['getProductId']) 
                               || auth()->user()->id != $this->variantServices->restrictProduct($request)['getProductOwnerId'];

            if($productNotValid){
                return response()->json(["data" => "Unauthorized", "status" => 0]);
            }

            $variantUpdate = $this->variant->where('id', $id)->update($request->validated());
            return response()->json(["data" => $variantUpdate, "status" => 1]);

        } catch(\Throwable $e){
            dd($e);
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
            if(auth()->user()->id != $this->variant->find($id)->product->user_id){
                return response()->json(["data" => "Unauthorized", "status" => 0]);
            }
            $this->variant->find($id)->delete();
            return response()->json(["data" => "Delete Variant", "status" => 1]);
        } catch(\Throwable $e){
            DB::rollback();
            return back()->with('error',$e->getMessage());
        }

    }
}
