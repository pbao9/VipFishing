<?php

namespace App\Admin\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        'App\Admin\Repositories\Lakes\LakesRepositoryInterface' => 'App\Admin\Repositories\Lakes\LakesRepository',
        'App\Admin\Repositories\Lakechilds\LakechildsRepositoryInterface' => 'App\Admin\Repositories\Lakechilds\LakechildsRepository',
        'App\Admin\Repositories\LakeFishs\LakeFishsRepositoryInterface' => 'App\Admin\Repositories\LakeFishs\LakeFishsRepository',
        'App\Admin\Repositories\Fishs\FishsRepositoryInterface' => 'App\Admin\Repositories\Fishs\FishsRepository',
        'App\Admin\Repositories\VariationFishs\VariationFishsRepositoryInterface' => 'App\Admin\Repositories\VariationFishs\VariationFishsRepository',
        'App\Admin\Repositories\Ratings\RatingsRepositoryInterface' => 'App\Admin\Repositories\Ratings\RatingsRepository',
        'App\Admin\Repositories\Ranks\RanksRepositoryInterface' => 'App\Admin\Repositories\Ranks\RanksRepository',
        'App\Admin\Repositories\Withdraws\WithdrawsRepositoryInterface' => 'App\Admin\Repositories\Withdraws\WithdrawsRepository',
        'App\Admin\Repositories\Deposits\DepositsRepositoryInterface' => 'App\Admin\Repositories\Deposits\DepositsRepository',
        'App\Admin\Repositories\TransactionHistory\TransactionHistoryRepositoryInterface' => 'App\Admin\Repositories\TransactionHistory\TransactionHistoryRepository',
        'App\Admin\Repositories\Balances\BalancesRepositoryInterface' => 'App\Admin\Repositories\Balances\BalancesRepository',
        'App\Admin\Repositories\Compensations\CompensationsRepositoryInterface' => 'App\Admin\Repositories\Compensations\CompensationsRepository',
        'App\Admin\Repositories\CommissionHistory\CommissionHistoryRepositoryInterface' => 'App\Admin\Repositories\CommissionHistory\CommissionHistoryRepository',
        'App\Admin\Repositories\Banks\BanksRepositoryInterface' => 'App\Admin\Repositories\Banks\BanksRepository',
        'App\Admin\Repositories\Bookings\BookingsRepositoryInterface' => 'App\Admin\Repositories\Bookings\BookingsRepository',
        'App\Admin\Repositories\FishingSet\FishingSetRepositoryInterface' => 'App\Admin\Repositories\FishingSet\FishingSetRepository',
        'App\Admin\Repositories\BookingLake\BookingLakeRepositoryInterface' => 'App\Admin\Repositories\BookingLake\BookingLakeRepository',
        'App\Admin\Repositories\Notifications\NotificationsRepositoryInterface' => 'App\Admin\Repositories\Notifications\NotificationsRepository',
        'App\Admin\Repositories\Events\EventsRepositoryInterface' => 'App\Admin\Repositories\Events\EventsRepository',
        'App\Admin\Repositories\LakeEvents\LakeEventsRepositoryInterface' => 'App\Admin\Repositories\LakeEvents\LakeEventsRepository',
        'App\Admin\Repositories\UserEvents\UserEventsRepositoryInterface' => 'App\Admin\Repositories\UserEvents\UserEventsRepository',
        'App\Admin\Repositories\UserScores\UserScoresRepositoryInterface' => 'App\Admin\Repositories\UserScores\UserScoresRepository',
        'App\Admin\Repositories\Permission\PermissionRepositoryInterface' => 'App\Admin\Repositories\Permission\PermissionRepository',
        'App\Admin\Repositories\Module\ModuleRepositoryInterface' => 'App\Admin\Repositories\Module\ModuleRepository',
        'App\Admin\Repositories\Role\RoleRepositoryInterface' => 'App\Admin\Repositories\Role\RoleRepository',
        'App\Admin\Repositories\Admin\AdminRepositoryInterface' => 'App\Admin\Repositories\Admin\AdminRepository',
        'App\Admin\Repositories\User\UserRepositoryInterface' => 'App\Admin\Repositories\User\UserRepository',
        'App\Admin\Repositories\Category\CategoryRepositoryInterface' => 'App\Admin\Repositories\Category\CategoryRepository',
        'App\Admin\Repositories\Product\ProductRepositoryInterface' => 'App\Admin\Repositories\Product\ProductRepository',
        'App\Admin\Repositories\Product\ProductAttributeRepositoryInterface' => 'App\Admin\Repositories\Product\ProductAttributeRepository',
        'App\Admin\Repositories\Product\ProductVariationRepositoryInterface' => 'App\Admin\Repositories\Product\ProductVariationRepository',
        'App\Admin\Repositories\Attribute\AttributeRepositoryInterface' => 'App\Admin\Repositories\Attribute\AttributeRepository',
        'App\Admin\Repositories\AttributeVariation\AttributeVariationRepositoryInterface' => 'App\Admin\Repositories\AttributeVariation\AttributeVariationRepository',
        'App\Admin\Repositories\Order\OrderRepositoryInterface' => 'App\Admin\Repositories\Order\OrderRepository',
        'App\Admin\Repositories\Order\OrderDetailRepositoryInterface' => 'App\Admin\Repositories\Order\OrderDetailRepository',
        'App\Admin\Repositories\Slider\SliderRepositoryInterface' => 'App\Admin\Repositories\Slider\SliderRepository',
        'App\Admin\Repositories\Slider\SliderItemRepositoryInterface' => 'App\Admin\Repositories\Slider\SliderItemRepository',
        'App\Admin\Repositories\Setting\SettingRepositoryInterface' => 'App\Admin\Repositories\Setting\SettingRepository',
        'App\Admin\Repositories\Post\PostRepositoryInterface' => 'App\Admin\Repositories\Post\PostRepository',
        'App\Admin\Repositories\PostCategory\PostCategoryRepositoryInterface' => 'App\Admin\Repositories\PostCategory\PostCategoryRepository',
        'App\Admin\Repositories\LakeCluster\LakeClusterRepositoryInterface' => 'App\Admin\Repositories\LakeCluster\LakeClusterRepository',
        'App\Admin\Repositories\LakeOdd\LakeOddRepositoryInterface' => 'App\Admin\Repositories\LakeOdd\LakeOddRepository',
        'App\Admin\Repositories\Provinces\ProvincesRepositoryInterface' => 'App\Admin\Repositories\Provinces\ProvincesRepository',
        'App\Admin\Repositories\CloseLakes\CloseLakesRepositoryInterface' => 'App\Admin\Repositories\CloseLakes\CloseLakesRepository',
        'App\Admin\Repositories\LakeRatings\LakeRatingsRepositoryInterface' => 'App\Admin\Repositories\LakeRatings\LakeRatingsRepository',
        'App\Admin\Repositories\LakeChildRatings\LakeChildRatingsRepositoryInterface' => 'App\Admin\Repositories\LakeChildRatings\LakeChildRatingsRepository',
        'App\Admin\Repositories\Lakechilds\OperatingRepositoryInterface' => 'App\Admin\Repositories\Lakechilds\OperatingRepository',
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
