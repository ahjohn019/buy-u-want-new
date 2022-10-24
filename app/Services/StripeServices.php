<?php
namespace App\Services;

use App\Models\User;
use App\Models\Order;
use App\Traits\CartTrait;
use App\Models\StripeUsers;
use App\Models\OrderDetails;
use Cartalyst\Stripe\Stripe;
use App\Http\Requests\StripeCreateCustomerRequest;
use App\Services\OrderServices;
   
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
     * Final process payment after user confirmed to make an order
     *
     * @param array $customerRequest
     * @param array $cardRequest
     * @return void
     */
    public function paymentProcess($customerRequest, $cardRequest){
        $customerNew = null;
        
        if(empty(auth()->user()->stripeUsers)) $customerNew = $this->createCustomer($customerRequest);
        
        $createPaymentIntents = $this->createPaymentIntents($customerNew)->getData();

        if($createPaymentIntents->status <= 0) return response()->json(["data" => "Unavailable", "status" => 0]);

        $confirmPaymentIntents = $this->stripeKey->paymentIntents()->confirm($createPaymentIntents->data->id, [
            'payment_method' => $this->createPaymentMethod($cardRequest)
        ]);

        $orderData = $this->orderServices->generateOrder($confirmPaymentIntents);

        $updatePaymentIntents = $this->stripeKey->paymentIntents()->update($createPaymentIntents->data->id, [
            'metadata' => ['order_id' => $orderData->number]
        ]);

        $this->clearAll();

        return $updatePaymentIntents;
    }
}