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
        foreach($this->getCartContent() as $item){
            $getItems[] = $this->orderDetailsInfo($item, $orderId);
        }

        if(request()->draft['cart']){
            $getItems = array_map(function($el) use($orderId) {
                return $this->orderDetailsInfo((object)$el, $orderId);
            }, request()->draft['cart']);
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
        $archiveList = json_decode($request->input("selected"));

        foreach($archiveList as $archive){
            $selected = $order->find($archive->id);
            $orderDetails->where('order_id',$archive->id)->delete();
            $selected->delete();
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
        $selectedRows = json_decode($request->selectedRows);
        $selectedNumber = array_column($selectedRows, 'number');
        
        $orderDetails = $order->whereIn('number', $selectedNumber);
        $orderDetails->update(['status' => $status]);

        return $orderDetails;
    }
}