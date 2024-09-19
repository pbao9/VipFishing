<?php

namespace App\Admin\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    protected $services = [
        'App\Admin\Services\Lakes\LakesServiceInterface' => 'App\Admin\Services\Lakes\LakesService',
        'App\Admin\Services\Lakechilds\LakechildsServiceInterface' => 'App\Admin\Services\Lakechilds\LakechildsService',
        'App\Admin\Services\LakeFishs\LakeFishsServiceInterface' => 'App\Admin\Services\LakeFishs\LakeFishsService',
        'App\Admin\Services\Fishs\FishsServiceInterface' => 'App\Admin\Services\Fishs\FishsService',
        'App\Admin\Services\VariationFishs\VariationFishsServiceInterface' => 'App\Admin\Services\VariationFishs\VariationFishsService',
        'App\Admin\Services\Ratings\RatingsServiceInterface' => 'App\Admin\Services\Ratings\RatingsService',
        'App\Admin\Services\Ranks\RanksServiceInterface' => 'App\Admin\Services\Ranks\RanksService',
        'App\Admin\Services\Withdraws\WithdrawsServiceInterface' => 'App\Admin\Services\Withdraws\WithdrawsService',
        'App\Admin\Services\Deposits\DepositsServiceInterface' => 'App\Admin\Services\Deposits\DepositsService',
        'App\Admin\Services\TransactionHistory\TransactionHistoryServiceInterface' => 'App\Admin\Services\TransactionHistory\TransactionHistoryService',
        'App\Admin\Services\Balances\BalancesServiceInterface' => 'App\Admin\Services\Balances\BalancesService',
        'App\Admin\Services\Compensations\CompensationsServiceInterface' => 'App\Admin\Services\Compensations\CompensationsService',
        'App\Admin\Services\CommissionHistory\CommissionHistoryServiceInterface' => 'App\Admin\Services\CommissionHistory\CommissionHistoryService',
        'App\Admin\Services\Banks\BanksServiceInterface' => 'App\Admin\Services\Banks\BanksService',
        'App\Admin\Services\Bookings\BookingsServiceInterface' => 'App\Admin\Services\Bookings\BookingsService',
        'App\Admin\Services\FishingSet\FishingSetServiceInterface' => 'App\Admin\Services\FishingSet\FishingSetService',
        'App\Admin\Services\BookingLake\BookingLakeServiceInterface' => 'App\Admin\Services\BookingLake\BookingLakeService',
        'App\Admin\Services\Notifications\NotificationsServiceInterface' => 'App\Admin\Services\Notifications\NotificationsService',
        'App\Admin\Services\Events\EventsServiceInterface' => 'App\Admin\Services\Events\EventsService',
        'App\Admin\Services\LakeEvents\LakeEventsServiceInterface' => 'App\Admin\Services\LakeEvents\LakeEventsService',
        'App\Admin\Services\UserEvents\UserEventsServiceInterface' => 'App\Admin\Services\UserEvents\UserEventsService',
        'App\Admin\Services\UserScores\UserScoresServiceInterface' => 'App\Admin\Services\UserScores\UserScoresService',
        'App\Admin\Services\Permission\PermissionServiceInterface' => 'App\Admin\Services\Permission\PermissionService',
        'App\Admin\Services\Module\ModuleServiceInterface' => 'App\Admin\Services\Module\ModuleService',
        'App\Admin\Services\Role\RoleServiceInterface' => 'App\Admin\Services\Role\RoleService',
        'App\Admin\Services\Admin\AdminServiceInterface' => 'App\Admin\Services\Admin\AdminService',
        'App\Admin\Services\User\UserServiceInterface' => 'App\Admin\Services\User\UserService',
        'App\Admin\Services\Category\CategoryServiceInterface' => 'App\Admin\Services\Category\CategoryService',
        'App\Admin\Services\Product\ProductServiceInterface' => 'App\Admin\Services\Product\ProductService',
        'App\Admin\Services\Attribute\AttributeServiceInterface' => 'App\Admin\Services\Attribute\AttributeService',
        'App\Admin\Services\AttributeVariation\AttributeVariationServiceInterface' => 'App\Admin\Services\AttributeVariation\AttributeVariationService',
        'App\Admin\Services\Order\OrderServiceInterface' => 'App\Admin\Services\Order\OrderService',
        'App\Admin\Services\Slider\SliderServiceInterface' => 'App\Admin\Services\Slider\SliderService',
        'App\Admin\Services\Slider\SliderItemServiceInterface' => 'App\Admin\Services\Slider\SliderItemService',
        'App\Admin\Services\Post\PostServiceInterface' => 'App\Admin\Services\Post\PostService',
        'App\Admin\Services\PostCategory\PostCategoryServiceInterface' => 'App\Admin\Services\PostCategory\PostCategoryService',
        'App\Admin\Services\LakeCluster\LakeClusterServiceInterface' => 'App\Admin\Services\LakeCluster\LakeClusterService',
        'App\Admin\Services\LakeOdd\LakeOddServiceInterface' => 'App\Admin\Services\LakeOdd\LakeOddService',
        'App\Admin\Services\Provinces\ProvinceServiceInterface' => 'App\Admin\Services\Provinces\ProvinceService',
        'App\Admin\Services\CloseLakes\CloseLakesServiceInterface' => 'App\Admin\Services\CloseLakes\CloseLakesService',
        'App\Admin\Services\LakeRatings\LakeRatingsServiceInterface' => 'App\Admin\Services\LakeRatings\LakeRatingsService',
        'App\Admin\Services\LakeChildRatings\LakeChildRatingsServiceInterface' => 'App\Admin\Services\LakeChildRatings\LakeChildRatingsService',
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
