<?php

namespace App\Providers;

use App\Events\InvoiceNotification;
use Illuminate\Support\Facades\Event;
use App\Listeners\UpdatePaymentStripe;
use Illuminate\Auth\Events\Registered;
use App\Events\PaymentStripeWasUpdated;
use App\Listeners\SendInvoiceNotification;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        InvoiceNotification::class => [
            SendInvoiceNotification::class,
        ],
        PaymentStripeWasUpdated::class => [
            SendInvoiceNotification::class,
            UpdatePaymentStripe::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
