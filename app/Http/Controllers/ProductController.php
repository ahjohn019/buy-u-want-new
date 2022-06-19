<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\ProductRequest;
use App\Http\Controllers\BaseController;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
        return response()->json(["data" => $productShow]);
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
}
