<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Traits\PaymentStripeTraits;
use App\Http\Controllers\BaseController;
use App\Http\Requests\StripeCreateCardRequest;
use App\Http\Requests\StripeCreateCustomerRequest;
use App\Services\StripeServices;

class StripeController extends BaseController
{
    protected $stripeService;

    public function __construct(StripeServices $stripeService){
        $this->stripeService = $stripeService;
    }

    public function finalPayments(StripeCreateCustomerRequest $customerRequest, StripeCreateCardRequest $cardRequest)
    {
        $confirmPaymentIntents = $this->stripeService->beforePayment($customerRequest, $cardRequest);

        $this->clearAll();

        return $confirmPaymentIntents;
    }
}
