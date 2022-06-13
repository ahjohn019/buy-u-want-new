<?php
namespace App\Services;

use App\Models\User;
use Cartalyst\Stripe\Stripe;
use App\Http\Resources\StripeResources;
use App\Http\Requests\StripeCreateCustomerRequest;
   
class StripeServices
{
    protected $stripeKey;
    protected $stripeResources;

    public function __construct(StripeResources $stripeResources){
        $this->stripeKey = Stripe::make(config('app.stripe_secret'));
        $this->stripeResources = $stripeResources;
    }

    public function getStripeKey(){
        return $this->stripeKey;
    }

    public function getCartTotal(){
        return \Cart::session(auth()->user()->id)->getTotal();
    }

    public function createCustomer($request){
        $customerCreate = $this->getStripeKey()->customers()->create($request->validated());
        User::findAuthUser()->update(['stripe_id' => $customerCreate['id']]);
    }

    public function retrieveCustomer(){
        $customerGet = empty(auth()->user()->stripe_id) ? null : $this->getStripeKey()->customers()->find(auth()->user()->stripe_id);
        return $customerGet;
    }

     public function createPaymentMethod($request){
        $paymentMethod = $this->getStripeKey()->paymentMethods()->create($request->validated());
        return $paymentMethod['id'];
    }

    public function createPaymentIntents(){
        $intentData = $this->stripeResources->intentResource($this->getCartTotal());

        if($intentData['amount'] <= 0){
            return response()->json(["data" => $intentData, "status" => 0]);
        }

        $paymentIntent = $this->getStripeKey()->paymentIntents()->create($intentData);
        return response()->json(["data" => $paymentIntent, "status" => 1]);
    }

    public function beforePayment($customerRequest, $cardRequest){
        if(empty(auth()->user()->stripe_id)){
            $this->createCustomer($customerRequest);
        }

        $createPaymentIntents = $this->createPaymentIntents()->getData();

        if($createPaymentIntents->status <= 0){
            return response()->json(["data" => "Unavailable", "status" => 0]);
        }

        $confirmPaymentIntents = $this->getStripeKey()->paymentIntents()->confirm($createPaymentIntents->data->id, [
            'payment_method' => $this->createPaymentMethod($cardRequest),
        ]);

        return $createPaymentIntents;
    }
}