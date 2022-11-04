<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdatePaymentStripe
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
        $event->stripeKey->paymentIntents()->update($event->createPaymentIntents->data->id, [
            'metadata' => [
                'Order ID' => $event->order->number,
                'Shipping Address' =>  $event->customerRequest->validated()['address']['line1'] . " " . $event->customerRequest->validated()['address']['city'] . " " . 
                              $event->customerRequest->validated()['address']['postal_code'] . " " . $event->customerRequest->validated()['address']['country']
            ]
        ]);
    }
}
