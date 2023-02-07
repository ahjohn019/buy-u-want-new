<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Attachment;
use Illuminate\Http\Request;
use App\Services\AttachmentServices;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{

    protected $attachments;

    public function __construct(Attachment $attachments, AttachmentServices $services){
        $this->attachments = $attachments;
        $this->services = $services;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $list = Attachment::productAttachments()->get();
        $productList = Product::all();
        return Inertia::render('Front/Images/ImagesTest', ['data' => $list, 'products'=> $productList]);
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
    public function store(Request $request)
    {
        //
        try {
            $selected = $this->attachments->where('product_id',$request->id)->first();

            if($request->update && !empty($selected)){
                $this->services->update($request, $selected);
                return redirect()->back();
            }

            $this->services->save($request);
            return redirect()->back();
        } catch (\Throwable $th) {
            throw $th;
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
    public function update(Request $request, $id)
    {
        //
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
        try {
            $attachment = $this->attachments->where('id', $id);
            $attachmentsName = $attachment->first()->name;
            Storage::disk('public')->delete('file/'. $attachmentsName);
            $attachment->delete();
            return redirect()->back();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
