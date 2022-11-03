<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Events\InvoiceNotification;
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
        $orderList = OrderDetails::orderOverview()->get();
        $columns = orderColumnName();

        return Inertia::render('Admin/Order/Index',[ "order" => $orderList, "columns" => $columns ]);
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
        $orderShow = $this->order->where('number',$number)->first();
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

    /**
     * Update To fulfilled status
     *
     * @return void
     */
    public function fulfillStatus(Request $request){
        try {
            $selectedRows = json_decode($request->selectedRows);
            
            foreach($selectedRows as $selected){
                $result[] = $selected->number;
            }

            $orderDetails = $this->order->whereIn('number', $result);
            $orderDetails->update(['status' => 'fulfilled']);

            event(new InvoiceNotification($orderDetails, 'fulfilled'));

            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
