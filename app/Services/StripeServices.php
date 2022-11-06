<?php
namespace App\Services;

use App\Models\User;
use App\Models\Order;
use App\Traits\CartTrait;
use App\Models\StripeUsers;
use App\Models\OrderDetails;
use Cartalyst\Stripe\Stripe;
use App\Services\OrderServices;
use App\Events\PaymentStripeWasUpdated;
use App\Http\Requests\StripeCreateCustomerRequest;
   
class StripeServices
{
    use CartTrait;

    protected $stripeKey;
    protected $user;
    protected $userStripe;

    public function __construct(User $user, StripeUsers $userStripe, OrderServices $orderServices ){
        $this->stripeKey = Stripe::make(config('app.stripe_secret'));
        $this->user = $user;
        $this->userStripe = $userStripe;
        $this->orderServices = $orderServices;
    }

    /**
     * Create new customer if first time customer didn't register as stripe services.
     *
     * @param array $request
     * @return void
     */
    public function createCustomer($request){
        try {
            $customerCreate = $this->stripeKey->customers()->create($request->validated());
            $this->userStripe->create([
                'user_id' => auth()->user()->id,
                'stripe_customer_id' => $customerCreate['id']
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
        
        return $customerCreate;
    }

    /**
     * Retrieve the selected customer by stripe customer id.
     *
     * @return void
     */
    public function retrieveCustomerService(){
        $customerGet = empty(auth()->user()->stripe_id) ? null : $this->stripeKey->customers()->find(auth()->user()->stripe_id);
        return $customerGet;
    }

    /**
     * Create the stripe payment method
     *
     * @param array $request
     * @return void
     */
     public function createPaymentMethod($request){
        $paymentMethod = $this->stripeKey->paymentMethods()->create($request->validated());
        return $paymentMethod['id'];
    }

    /**
     * Create the steipe payment intents
     *
     * @return void
     */
    public function createPaymentIntents($customerNew = null){
        $intentData = paymentIntentData($this->getCartTotal(), $customerNew = null);
        if($intentData['amount'] <= 0) return response()->json(["data" => $intentData, "status" => 0]);

        $paymentIntent = $this->stripeKey->paymentIntents()->create($intentData);
        return response()->json(["data" => $paymentIntent, "status" => 1]);
    }

    /**
     * Confirm Payment Intents Methods
     *
     * @param [type] $createPaymentIntents
     * @param [type] $cardRequest
     * @param [type] $customerAddress
     * @return void
     */
    public function confirmPaymentIntents($createPaymentIntents, $cardRequest, $customerAddress){
        return $this->stripeKey->paymentIntents()->confirm($createPaymentIntents->data->id, [
            'payment_method' => $this->createPaymentMethod($cardRequest),
            'shipping' => [
                'address' => [
                    'city' => $customerAddress['city'],
                    'country' => $customerAddress['country'],
                    'line1' => $customerAddress['line1'],
                    'postal_code' => $customerAddress['postal_code'],
                    'state' => $customerAddress['state'],
                ],
                'name' => "Test",
                'phone' => "60123771428",
                'tracking_number' => "TestTracking"
            ]
        ]);
    }

    /**
     * Final process payment after user confirmed to make an order
     *
     * @param array $customerRequest
     * @param array $cardRequest
     * @return void
     */
    public function paymentProcess($customerRequest, $cardRequest){
 
        $customerNew = null;
        $customerAddress = $customerRequest->validated()['address'];

        if(empty(auth()->user()->stripeUsers)) $customerNew = $this->createCustomer($customerRequest);
        
        $createPaymentIntents = $this->createPaymentIntents($customerNew)->getData();

        if($createPaymentIntents->status <= 0) return response()->json(["data" => "Unavailable", "status" => 0]);

        $confirmPaymentIntents = $this->confirmPaymentIntents($createPaymentIntents, $cardRequest, $customerAddress);

        $orderData = $this->orderServices->generateOrder($confirmPaymentIntents);

        event(new PaymentStripeWasUpdated($orderData, 'checkout', $this->stripeKey, $createPaymentIntents, $customerRequest));

        $this->clearAll();
    }
}