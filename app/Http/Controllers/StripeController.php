<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Order;
use App\Traits\CartTrait;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Services\StripeServices;
use App\Http\Controllers\BaseController;
use App\Http\Requests\StripeCreateCardRequest;
use App\Http\Requests\StripeCreateCustomerRequest;

class StripeController extends BaseController
{
    protected $stripeService;

    use CartTrait;

    /**
     * Get Stripe Services Function
     *
     * @param StripeServices $stripeService
     */
    public function __construct(StripeServices $stripeService){
        $this->stripeService = $stripeService;
    }

    /**
     * Get The Specific Stripe Customer From Service Class
     *
     * @return void
     */
    public function retrieveCustomer(){
        return $this->stripeService->retrieveCustomerService();
    }

    /**
     * Process the stripe payments after customer purchased the items
     *
     * @param StripeCreateCustomerRequest $customerRequest
     * @param StripeCreateCardRequest $cardRequest
     * @return void
     */
    public function finalPayments(
        StripeCreateCustomerRequest $customerRequest, 
        StripeCreateCardRequest $cardRequest
    )
    {
        $confirmPaymentIntents = $this->stripeService->paymentProcess($customerRequest, $cardRequest);
        return redirect()->route('main.index')->with('checkoutSuccessMessage', 'Payment Successfully');
    }

    /**
     * Checkout Main Pages
     *
     * @return void
     */
    public function checkoutIndex(Request $request){
        return Inertia::render('Front/Checkout/Index' , [
            "cart" => $this->getList()['cart'], 
            "unitTotal" => $this->getList()['unitTotal'],
            "total" => $this->getCartTotal(),
            "authentication" => auth()->user()
        ]);
    }
}
