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
        $categoryList = Category::getActiveCategory()->get();
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
            if(!Gate::inspect('create', Category::class)->allowed()) return abort(403);
            $category = Category::create($request->validated());
            Category::where('id', $category->id)->update(['user_id' => auth()->user()->id]);
            return $category;
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
        $categoryShow = Category::find($id); 
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
            if(!Gate::inspect('update', Category::find($id))->allowed()) return abort(403);
            $category = Category::where('id',$id)->update($request->validated());
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
            if(!Gate::inspect('delete', Category::find($id))->allowed()) return abort(403);
            Category::find($id)->delete();
            return true;
        } catch(Exception $e){
            return back()->with('error',$e->getMessage());
        }
        
    }
}
