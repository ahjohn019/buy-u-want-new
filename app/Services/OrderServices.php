<?php
namespace App\Services;

use App\Models\Order;
use App\Models\OrderDetails;
use App\Traits\CartTrait;

class OrderServices
{
    use CartTrait;

    /**
     * Create an order after make stripe payment
     *
     * @param [type] $confirmPaymentIntents
     * @return void
     */
    public function generateOrder($confirmPaymentIntents){
        $order = Order::create([
            'number' => 'ORDER-' . uniqid(),
            'total' => $this->getCartTotal(),
            'grand_total' => $this->getCartTotal(),
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
        $getItems = $this->getCartContent();
        foreach($getItems as $item){
            OrderDetails::create([
                'quantity' => $item->quantity,
                'price' => $item->price,
                'order_id' => $orderId,
                'product_id' => $item->id,
                'shipment_id' => null
            ]);
        }
    }
}