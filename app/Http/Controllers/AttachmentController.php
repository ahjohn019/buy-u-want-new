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
            $attachments = $request->file('attachments');
            $products = $request->product_id;
            $selected = $this->attachments->where('product_id',$products);

            if(empty($attachments)) return redirect()->back()->with(['imageIsEmpty' => sessionMessage()['imageIsEmpty']]);
            Storage::disk('public')->putFile('file',$attachments);

            if($request->update && isset($selected->first()->name)){
                Storage::disk('public')->delete('file/'. $selected->first()->name);
                $selected->update($this->services->attributes($attachments, $products));
                return redirect()->back();
            }

            $this->attachments->create($this->services->attributes($attachments, $products));

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
