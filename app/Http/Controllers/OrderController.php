<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Services\OrderServices;
use App\Services\StripeServices;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $product = new Product();
        $user = new User();
        $productList = $product->getActiveProduct()->get();
        $columns = $product->getFillable();
        $userList = $user->with(['address'])->get();

        return Inertia::render('Admin/Order/Create',['products' => $productList, 'columns' => $columns,'users' => $userList]);
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
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
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
        $orderDetails = OrderDetails::with('product')
                        ->where('order_id', $orderShow->id)->get();

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
        try{
            $this->order->find($id)->delete();
            return redirect()->back()->with("orderDeletedMessage",sessionMessage()["orderDeletedMessage"]);
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
    public function fulfillStatus(Request $request, OrderServices $orderServices){
        try {
            $orderDetails = $orderServices->handleSelectedRows($request, $this->order, 'fulfilled');
            
            event(new InvoiceNotification($orderDetails, 'fulfilled'));

            return redirect()->back()->with("orderFulFilledMessage", sessionMessage()["orderFulFilledMessage"]);
        } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());
        }
    }

    /**
     * Delete selected order by multiple or single order
     *
     * @param Request $request
     * @param OrderServices $orderServices
     * @param OrderDetails $orderDetails
     * @return void
     */
    public function archive(Request $request, OrderServices $orderServices, OrderDetails $orderDetails){
        try {
            $orderServices->handleArchive($request, $this->order, $orderDetails);
            return redirect()->back()->with("orderDeletedMessage", sessionMessage()["orderDeletedMessage"]);
        } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());
        }
    }

    /**
     * Refund selected order
     *
     * @param Request $request
     * @return void
     */
    public function refund(Request $request, StripeServices $stripeServices, OrderServices $orderServices){
        try {
            $stripeServices->handleRefund($request);
            $orderDetails = $orderServices->handleSelectedRows($request, $this->order, 'refund');
            event(new InvoiceNotification($orderDetails, 'refund'));

            return redirect()->back()->with("refundSuccessMessage", sessionMessage()["refundSuccessMessage"]);
 
        } catch (\Throwable $th) {
            return redirect()->back()->with("error",$th->getMessage());
        }
    }

    /**
     * Search selected order
     *
     * @param Request $request
     * @return void
     */
    public function search(Request $request){
        try {
            $columns = orderColumnName();
            $orderList = OrderDetails::orderOverview()->searchOrderDetails($request, $columns)->get();
    
            return Inertia::render('Admin/Order/Index',[ "order" => $orderList, "columns" => $columns ]);
        } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());
        }
    }
}
