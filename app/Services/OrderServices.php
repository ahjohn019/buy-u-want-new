<?php
namespace App\Services;

use Carbon\Carbon;
use App\Models\Order;
use App\Traits\CartTrait;
use App\Models\OrderDetails;
use Illuminate\Support\Facades\DB;

class OrderServices
{
    use CartTrait;

    /**
     * Initialize order info
     *
     * @return void
     */
    private function orderCondition(){
        $totalQty = $this->getQuantity();
        $totalItems = $this->getCartTotal();

        if(request()->draft){
            $getQuantity = array_column(request()->draft['cart'], 'quantity');
            $totalQty = array_sum($getQuantity);
            $totalItems = request()->draft['total'];
        }

        return ['totalItems' => $totalItems, 'totalQty' => $totalQty];
    }

    /**
     * Initialize order details info
     *
     * @param [type] $item
     * @param [type] $orderId
     * @return void
     */
    private function orderDetailsInfo($item, $orderId){
        return [
            'quantity' => $item->quantity,
            'price' => $item->price * $item->quantity,
            'order_id' => $orderId,
            'product_id' => $item->id,
            'shipment_id' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }

    /**
     * Switch to order condition and return order data
     *
     * @param [type] $orderId
     * @return void
     */
    private function orderDetailsCondition($orderId){
        $cartList = $this->getCartContent();
        if(request()->draft) $cartList = request()->draft['cart'];

        foreach($cartList as $item) {
            $getItems[] = $this->orderDetailsInfo((object)$item, $orderId);
        }

        return $getItems;
    }

    /**
     * Create an order after make stripe payment
     *
     * @param [type] $confirmPaymentIntents
     * @return void
     */
    public function generateOrder($confirmPaymentIntents){
        try {
            $order = Order::create([
                'number' => 'ORDER-' . uniqid(),
                'total' => $this->orderCondition()['totalItems'],
                'grand_total' => $this->orderCondition()['totalItems'],
                'total_qty' => $this->orderCondition()['totalQty'],
                'tax' => null,
                'status' => $confirmPaymentIntents['status'],
                'user_id' => auth()->user()->id,
                'payment_id' => $confirmPaymentIntents['id']
            ]);

            $this->generateOrderDetails($order->id);

            return $order;
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }

    /**
     * Store the order details data if order was done on payment.
     *
     * @param [type] $orderId
     * @return void
     */
    public function generateOrderDetails($orderId){
        try {
            DB::table('order_details')->insert($this->orderDetailsCondition($orderId));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Handle list of selected order to archive
     *
     * @param [type] $request
     * @param [type] $order
     * @param [type] $orderDetails
     * @return void
     */
    public function handleArchive($request, $order, $orderDetails){
        try {
            $archiveList = json_decode($request->input("selected"));
            $getListId = array_column($archiveList, 'id');
            $orderDetails->whereIn('order_id', $getListId)->delete();
            $order->whereIn('id', $getListId)->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Handle the datatable selected rows
     *
     * @param [type] $request
     * @param [type] $order
     * @param [type] $status
     * @return void
     */
    public function handleSelectedRows($request, $order, $status){
        try {
            $selectedRows = json_decode($request->selectedRows);
            $selectedNumber = array_column($selectedRows, 'number');
            
            $orderDetails = $order->whereIn('number', $selectedNumber);
            $orderDetails->update(['status' => $status]);

            return $orderDetails;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}