<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderController extends BaseController
{
    use SoftDeletes;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orderList = $this->order->where('created_at','DESC')->get();
        return response()->json(["data" => $orderList]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($number)
    {
        //
        $orderShow = $this->order->where('number',$id)->get();
        $orderDetails = $orderShow->orderDetails;
        return response()->json(["data" => $orderShow,"details"=>$orderDetails]);
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
            $this->order->find($id)->delete();
            return response()->json(["data" => "Delete Order Succsessfully", "status" => 1]);
        } catch(\Throwable $e){
            DB::rollback();
            return back()->with('error',$e->getMessage());
        }

    }
}
