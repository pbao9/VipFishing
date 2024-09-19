<?php

namespace App\Api\V1\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    protected $services = [
        'App\Api\V1\Services\Lakes\LakesServiceInterface' => 'App\Api\V1\Services\Lakes\LakesService',
        'App\Api\V1\Services\Lakechilds\LakechildsServiceInterface' => 'App\Api\V1\Services\Lakechilds\LakechildsService',
        'App\Api\V1\Services\LakeFishs\LakeFishsServiceInterface' => 'App\Api\V1\Services\LakeFishs\LakeFishsService',
        'App\Api\V1\Services\Fishs\FishsServiceInterface' => 'App\Api\V1\Services\Fishs\FishsService',
        'App\Api\V1\Services\VariationFishs\VariationFishsServiceInterface' => 'App\Api\V1\Services\VariationFishs\VariationFishsService',
        'App\Api\V1\Services\Ratings\RatingsServiceInterface' => 'App\Api\V1\Services\Ratings\RatingsService',
        'App\Api\V1\Services\Ranks\RanksServiceInterface' => 'App\Api\V1\Services\Ranks\RanksService',
        'App\Api\V1\Services\Withdraws\WithdrawsServiceInterface' => 'App\Api\V1\Services\Withdraws\WithdrawsService',
        'App\Api\V1\Services\Deposits\DepositsServiceInterface' => 'App\Api\V1\Services\Deposits\DepositsService',
        'App\Api\V1\Services\TransactionHistory\TransactionHistoryServiceInterface' => 'App\Api\V1\Services\TransactionHistory\TransactionHistoryService',
        'App\Api\V1\Services\Balances\BalancesServiceInterface' => 'App\Api\V1\Services\Balances\BalancesService',
        'App\Api\V1\Services\Compensations\CompensationsServiceInterface' => 'App\Api\V1\Services\Compensations\CompensationsService',
        'App\Api\V1\Services\CommissionHistory\CommissionHistoryServiceInterface' => 'App\Api\V1\Services\CommissionHistory\CommissionHistoryService',
        'App\Api\V1\Services\Banks\BanksServiceInterface' => 'App\Api\V1\Services\Banks\BanksService',
        'App\Api\V1\Services\Bookings\BookingsServiceInterface' => 'App\Api\V1\Services\Bookings\BookingsService',
        'App\Api\V1\Services\FishingSet\FishingSetServiceInterface' => 'App\Api\V1\Services\FishingSet\FishingSetService',
        'App\Api\V1\Services\BookingLake\BookingLakeServiceInterface' => 'App\Api\V1\Services\BookingLake\BookingLakeService',
        'App\Api\V1\Services\Notifications\NotificationsServiceInterface' => 'App\Api\V1\Services\Notifications\NotificationsService',
        'App\Api\V1\Services\Events\EventsServiceInterface' => 'App\Api\V1\Services\Events\EventsService',
        'App\Api\V1\Services\LakeEvents\LakeEventsServiceInterface' => 'App\Api\V1\Services\LakeEvents\LakeEventsService',
        'App\Api\V1\Services\UserEvents\UserEventsServiceInterface' => 'App\Api\V1\Services\UserEvents\UserEventsService',
        'App\Api\V1\Services\UserScores\UserScoresServiceInterface' => 'App\Api\V1\Services\UserScores\UserScoresService',

        'App\Api\V1\Services\User\UserServiceInterface' => 'App\Api\V1\Services\User\UserService',
        'App\Api\V1\Services\Auth\AuthServiceInterface' => 'App\Api\V1\Services\Auth\AuthService',
        'App\Api\V1\Services\CloseLakes\CloseLakesServiceInterface' => 'App\Api\V1\Services\CloseLakes\CloseLakesService',
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
