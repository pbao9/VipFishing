<?php

namespace App\Api\V1\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        'App\Api\V1\Repositories\Lakes\LakesRepositoryInterface' => 'App\Api\V1\Repositories\Lakes\LakesRepository',
        'App\Api\V1\Repositories\Lakechilds\LakechildsRepositoryInterface' => 'App\Api\V1\Repositories\Lakechilds\LakechildsRepository',
        'App\Api\V1\Repositories\LakeFishs\LakeFishsRepositoryInterface' => 'App\Api\V1\Repositories\LakeFishs\LakeFishsRepository',
        'App\Api\V1\Repositories\Fishs\FishsRepositoryInterface' => 'App\Api\V1\Repositories\Fishs\FishsRepository',
        'App\Api\V1\Repositories\VariationFishs\VariationFishsRepositoryInterface' => 'App\Api\V1\Repositories\VariationFishs\VariationFishsRepository',
        'App\Api\V1\Repositories\Ratings\RatingsRepositoryInterface' => 'App\Api\V1\Repositories\Ratings\RatingsRepository',
        'App\Api\V1\Repositories\Ranks\RanksRepositoryInterface' => 'App\Api\V1\Repositories\Ranks\RanksRepository',
        'App\Api\V1\Repositories\Withdraws\WithdrawsRepositoryInterface' => 'App\Api\V1\Repositories\Withdraws\WithdrawsRepository',
        'App\Api\V1\Repositories\Deposits\DepositsRepositoryInterface' => 'App\Api\V1\Repositories\Deposits\DepositsRepository',
        'App\Api\V1\Repositories\TransactionHistory\TransactionHistoryRepositoryInterface' => 'App\Api\V1\Repositories\TransactionHistory\TransactionHistoryRepository',
        'App\Api\V1\Repositories\Balances\BalancesRepositoryInterface' => 'App\Api\V1\Repositories\Balances\BalancesRepository',
        'App\Api\V1\Repositories\Compensations\CompensationsRepositoryInterface' => 'App\Api\V1\Repositories\Compensations\CompensationsRepository',
        'App\Api\V1\Repositories\CommissionHistory\CommissionHistoryRepositoryInterface' => 'App\Api\V1\Repositories\CommissionHistory\CommissionHistoryRepository',
        'App\Api\V1\Repositories\Banks\BanksRepositoryInterface' => 'App\Api\V1\Repositories\Banks\BanksRepository',
        'App\Api\V1\Repositories\Bookings\BookingsRepositoryInterface' => 'App\Api\V1\Repositories\Bookings\BookingsRepository',
        'App\Api\V1\Repositories\FishingSet\FishingSetRepositoryInterface' => 'App\Api\V1\Repositories\FishingSet\FishingSetRepository',
        'App\Api\V1\Repositories\BookingLake\BookingLakeRepositoryInterface' => 'App\Api\V1\Repositories\BookingLake\BookingLakeRepository',
        'App\Api\V1\Repositories\Notifications\NotificationsRepositoryInterface' => 'App\Api\V1\Repositories\Notifications\NotificationsRepository',
        'App\Api\V1\Repositories\Events\EventsRepositoryInterface' => 'App\Api\V1\Repositories\Events\EventsRepository',
        'App\Api\V1\Repositories\LakeEvents\LakeEventsRepositoryInterface' => 'App\Api\V1\Repositories\LakeEvents\LakeEventsRepository',
        'App\Api\V1\Repositories\UserEvents\UserEventsRepositoryInterface' => 'App\Api\V1\Repositories\UserEvents\UserEventsRepository',
        'App\Api\V1\Repositories\UserScores\UserScoresRepositoryInterface' => 'App\Api\V1\Repositories\UserScores\UserScoresRepository',

        'App\Api\V1\Repositories\User\UserRepositoryInterface' => 'App\Api\V1\Repositories\User\UserRepository',
        'App\Api\V1\Repositories\Slider\SliderRepositoryInterface' => 'App\Api\V1\Repositories\Slider\SliderRepository',
        'App\Api\V1\Repositories\Slider\SliderItemRepositoryInterface' => 'App\Api\V1\Repositories\Slider\SliderItemRepository',
        'App\Api\V1\Repositories\Post\PostRepositoryInterface' => 'App\Api\V1\Repositories\Post\PostRepository',
        'App\Api\V1\Repositories\PostCategory\PostCategoryRepositoryInterface' => 'App\Api\V1\Repositories\PostCategory\PostCategoryRepository',
        'App\Api\V1\Repositories\Review\ReviewRepositoryInterface' => 'App\Api\V1\Repositories\Review\ReviewRepository',
        'App\Api\V1\Repositories\CloseLakes\CloseLakesRepositoryInterface' => 'App\Api\V1\Repositories\CloseLakes\CloseLakesRepository',
        'App\Api\V1\Repositories\Address\ProvinceRepositoryInterface' => 'App\Api\V1\Repositories\Address\ProvinceRepository',
        'App\Api\V1\Repositories\Settings\SettingRepositoryInterface' => 'App\Api\V1\Repositories\Settings\SettingRepository',

    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        foreach ($this->repositories as $interface => $implement) {
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
