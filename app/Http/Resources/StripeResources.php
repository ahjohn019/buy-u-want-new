<?php

namespace App\Http\Resources;

class StripeResources{

    public function intentResource($getCartTotal) {
        return [
            'amount' => $getCartTotal,
            'currency' => currencyList('Malaysia'),
            'customer' =>  auth()->user()->stripe_id,
            'payment_method_types' => [
                'card',
            ]
        ];
    }
}