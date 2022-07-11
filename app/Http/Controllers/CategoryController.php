<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\BaseController;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categoryList = $this->category->getActiveCategory()->get();
        return $categoryList;
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
    public function store(CategoryRequest $request)
    {
        //
        try{
            if(!Gate::inspect('create', $this->category)->allowed()) return abort(403);
            $category = $this->category->create($request->validated());
            $this->category->where('id', $category->id)->update(['user_id' => auth()->user()->id]);
            return response()->json(["data" => $category]);
        } catch(Exception $e){
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
        $categoryShow = $this->category->find($id); 
        return $categoryShow;
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
    public function update(CategoryRequest $request, $id)
    {
        //
        try{
            if(!Gate::inspect('update', $this->category->find($id))->allowed()) return abort(403);
            $category = $this->category->where('id',$id)->update($request->validated());
            return $category;
        } catch(Exception $e){
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
            if(!Gate::inspect('delete', $this->category->find($id))->allowed()) return abort(403);
            $this->category->find($id)->delete();
            return true;
        } catch(Exception $e){
            return back()->with('error',$e->getMessage());
        }
        
    }
}
