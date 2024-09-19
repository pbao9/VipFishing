<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    protected $services = [
        'App\Services\Auth\AuthServiceInterface' => 'App\Services\Auth\AuthService',
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        foreach ($this->services as $interface => $implement) {
            $this->app->singleton($interface, $implement);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
