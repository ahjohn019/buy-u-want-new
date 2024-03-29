<?php

namespace App\Listeners;

use App\Events\InvoiceNotification;
use App\Notifications\InvoiceEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendInvoiceNotification
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
     * @param  \App\Events\InvoiceNotification  $event
     * @return void
     */
    public function handle($event)
    {
        if($event->status == 'fulfilled'){
            $orderDetails = $event->order->get();
        
            foreach($orderDetails as $order){
                $order->user->notify(new InvoiceEmail($order));
            }
        }

        if($event->status == 'checkout'){
            auth()->user()->notify(new InvoiceEmail($event->order));
        }
        
    }
}
