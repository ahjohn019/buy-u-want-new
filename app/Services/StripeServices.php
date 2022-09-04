<?php
namespace App\Services;

use App\Models\User;
use App\Models\Order;
use App\Traits\CartTrait;
use App\Models\OrderDetails;
use Cartalyst\Stripe\Stripe;
use App\Http\Requests\StripeCreateCustomerRequest;
   
class StripeServices
{
    use CartTrait;

    protected $stripeKey;
    protected $user;
    protected $order;
    protected $orderDetails;

    public function __construct(User $user, Order $order, OrderDetails $orderDetails){
        $this->stripeKey = Stripe::make(config('app.stripe_secret'));
        $this->order = $order;
        $this->user = $user;
        $this->orderDetails = $orderDetails;
    }

    /**
     * Get the stripe key from the dashboard
     *
     * @return void
     */
    public function getStripeKey(){
        return $this->stripeKey;
    }

    /**
     * List of payment intent resource
     *
     * @return void
     */
    public function intentResource() {
        return [
            'amount' => $this->getCartTotal(),
            'currency' => currencyList('Malaysia'),
            'customer' => $this->user->stripe_id,
            'payment_method_types' => [
                'card',
            ]
        ];
    }

    /**
     * Create new customer if first time customer didn't register as stripe services.
     *
     * @param array $request
     * @return void
     */
    public function createCustomer($request){
        $customerCreate = $this->getStripeKey()->customers()->create($request->validated());
        $this->user->findAuthUser()->update(['stripe_id' => $customerCreate['id']]);
        return $customerCreate;
    }

    /**
     * Retrieve the selected customer by stripe customer id.
     *
     * @return void
     */
    public function retrieveCustomerService(){
        $customerGet = empty(auth()->user()->stripe_id) ? null : $this->getStripeKey()->customers()->find(auth()->user()->stripe_id);
        return $customerGet;
    }

    /**
     * Create the stripe payment method
     *
     * @param array $request
     * @return void
     */
     public function createPaymentMethod($request){
        $paymentMethod = $this->getStripeKey()->paymentMethods()->create($request->validated());
        return $paymentMethod['id'];
    }

    /**
     * Create the steipe payment intents
     *
     * @return void
     */
    public function createPaymentIntents($customerNew = null){
        $intentData = [
            'amount' => $this->getCartTotal(),
            'currency' => currencyList('Malaysia'),
            'customer' => auth()->user()->stripe_id ?? $customerNew['id'],
            'payment_method_types' => [
                'card',
            ]
        ];

        if($intentData['amount'] <= 0){
            return response()->json(["data" => $intentData, "status" => 0]);
        }

        $paymentIntent = $this->getStripeKey()->paymentIntents()->create($intentData);
        return response()->json(["data" => $paymentIntent, "status" => 1]);
    }

    /**
     * Create an order after make stripe payment
     *
     * @param [type] $confirmPaymentIntents
     * @return void
     */
    public function generateOrder($confirmPaymentIntents){
        $order = $this->order->create([
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
            $this->orderDetails->create([
                'quantity' => $item->quantity,
                'price' => $item->price,
                'order_id' => $orderId,
                'product_id' => $item->id,
                'shipment_id' => null
            ]);
        }
    }

    /**
     * Final process payment after user confirmed to make an order
     *
     * @param array $customerRequest
     * @param array $cardRequest
     * @return void
     */
    public function paymentProcess($customerRequest, $cardRequest){
        $createPaymentIntents = $this->createPaymentIntents()->getData();

        if(empty(auth()->user()->stripe_id)){
            $customerNew = $this->createCustomer($customerRequest);
            $createPaymentIntents = $this->createPaymentIntents($customerNew)->getData();
        }

        if($createPaymentIntents->status <= 0){
            return response()->json(["data" => "Unavailable", "status" => 0]);
        }

        $confirmPaymentIntents = $this->getStripeKey()->paymentIntents()->confirm($createPaymentIntents->data->id, [
            'payment_method' => $this->createPaymentMethod($cardRequest)
        ]);

        $orderData = $this->generateOrder($confirmPaymentIntents);

        $updatePaymentIntents = $this->getStripeKey()->paymentIntents()->update($createPaymentIntents->data->id, [
            'metadata' => ['order_id' => $orderData->number]
        ]);

        $this->clearAll();

        return $updatePaymentIntents;
    }
}