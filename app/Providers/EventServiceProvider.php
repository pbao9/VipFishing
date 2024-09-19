<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
        \App\Models\Order::observe(\App\Observers\OrderObserver::class);
        \App\Models\Deposits::observe(\App\Observers\DepositObserver::class);
        \App\Models\Withdraws::observe(\App\Observers\WithdrawObserver::class);
        \App\Models\Compensations::observe(\App\Observers\CompensationObserver::class);
        \App\Models\CommissionHistory::observe(\App\Observers\CommissionObserver::class);
        \App\Models\Bookings::observe(\App\Observers\BookingObserver::class);
        \App\Models\User::observe(\App\Observers\UserObserver::class);
        \App\Models\Events::observe(\App\Observers\EventObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
