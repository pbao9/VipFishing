<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//auth
Route::controller(App\Api\V1\Http\Controllers\Auth\AuthController::class)
    ->group(function () {
        Route::middleware('auth:api')->prefix('/auth')->as('auth.')->group(function () {
            Route::get('/', 'show')->name('show');
            Route::post('/', 'update')->name('update');
            Route::put('/update-password', 'updatePassword')->name('update_password');
        });
        Route::post('/register', 'register')->name('register');
        Route::post('/login', 'login')->name('login');
    });

Route::middleware("auth:api")->group(function () {
    //***** -- Lakes -- ******* //
    Route::controller(App\Api\V1\Http\Controllers\Lakes\LakesController::class)
        ->prefix('/lakes')
        ->as('lakes.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/show/{id}', 'show')->name('show');
            Route::get('/search', 'search')->name('search');
        });
    //***** -- Lakes -- ******* //
    //***** -- Ratings -- ******* //
    Route::controller(App\Api\V1\Http\Controllers\Ratings\RatingsController::class)
        ->prefix('/ratings')
        ->as('ratings.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/show/{id}', 'show')->name('show');
            Route::get('/find/{lake_id}', 'find')->name('find');
            Route::delete('/delete', 'delete')->name('delete');
            Route::post('/add', 'add')->name('add');
            Route::put('/edit', 'edit')->name('edit');
        });
    //***** -- Ratings -- ******* //
    //***** -- Withdraws -- ******* //
    Route::controller(App\Api\V1\Http\Controllers\Withdraws\WithdrawsController::class)
        ->middleware('auth:api')
        ->prefix('/withdraws')
        ->as('withdraws.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/show/{id}', 'show')->name('show');
            Route::post('/add', 'add')->name('add');
        });
    //***** -- Withdraws -- ******* //

    //***** -- Deposits -- ******* //
    Route::controller(App\Api\V1\Http\Controllers\Deposits\DepositsController::class)
        ->group(function () {
            Route::middleware('auth:api')->prefix('/deposits')->as('deposits.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/show/{id}', 'show')->name('show');
                Route::post('/add', 'add')->name('add');
            });
        });
    //***** -- Deposits -- ******* //
    //***** -- TransactionHistory -- ******* //
    Route::controller(App\Api\V1\Http\Controllers\TransactionHistory\TransactionHistoryController::class)
        ->middleware('auth:api')
        ->prefix('/transactionHistories')
        ->as('transactionHistory.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/show/{id}', 'show')->name('show');
        });
    //***** -- TransactionHistory -- ******* //

    //***** -- Compensations -- ******* //
    Route::controller(App\Api\V1\Http\Controllers\Compensations\CompensationsController::class)
        ->prefix('/compensations')
        ->as('compensations.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/show/{id}', 'show')->name('show');
        });
    //***** -- Compensations -- ******* //

    //***** -- CommissionHistory -- ******* //
    Route::controller(App\Api\V1\Http\Controllers\CommissionHistory\CommissionHistoryController::class)
        ->prefix('/commissionHistories')
        ->as('commissionHistory.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/show/{id}', 'show')->name('show');
        });
    //***** -- CommissionHistory -- ******* //

    //***** -- Banks -- ******* //
    Route::controller(App\Api\V1\Http\Controllers\Banks\BanksController::class)
        ->prefix('/banks')
        ->as('banks.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
        });
    //***** -- Banks -- ******* //

    //***** -- Bookings -- ******* //
    Route::controller(App\Api\V1\Http\Controllers\Bookings\BookingsController::class)
        ->prefix('/bookings')
        ->as('bookings.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{id}', 'show')->name('show');
            Route::post('/add', 'add')->name('add');
            Route::put('/payment', 'payment')->name('payment');
            Route::put('/delete', 'delete')->name('delete');
        });
    //***** -- Bookings -- ******* //
    //***** -- Notifications -- ******* //
    Route::controller(App\Api\V1\Http\Controllers\Notifications\NotificationsController::class)
        ->prefix('/notifications')
        ->as('notifications.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/show/{id}', 'show')->name('show');
            // Route::delete('/delete', 'delete')->name('delete');
            // Route::post('/add', 'add')->name('add');
            // Route::put('/edit', 'edit')->name('edit');
        });
    //***** -- Notifications -- ******* //

    //***** -- Events -- ******* //
    Route::controller(App\Api\V1\Http\Controllers\Events\EventsController::class)
        ->prefix('/events')
        ->as('events.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/show/{id}', 'show')->name('show');
            Route::delete('/delete', 'delete')->name('delete');
            Route::post('/add', 'add')->name('add');
            Route::put('/edit', 'edit')->name('edit');
        });
    //***** -- Events -- ******* //


    //***** -- UserEvents -- ******* //
    Route::controller(App\Api\V1\Http\Controllers\UserEvents\UserEventsController::class)
        ->prefix('/userEvents')
        ->as('userEvents.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/show/{id}', 'show')->name('show');
            Route::delete('/delete', 'delete')->name('delete');
            Route::post('/add', 'add')->name('add');
            Route::post('/joinEvent', 'joinEvent')->name('joinEvent');
            Route::put('/edit', 'edit')->name('edit');
        });
    //***** -- UserEvents -- ******* //


});


//***** -- Fishs -- ******* //
Route::controller(App\Api\V1\Http\Controllers\Fishs\FishsController::class)
    ->prefix('/fishs')
    ->as('fishs.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{id}', 'show')->name('show');
    });
//***** -- Fishs -- ******* //

//***** -- Province -- ******* //
Route::controller(App\Api\V1\Http\Controllers\Provinces\ProvinceController::class)
    ->prefix('/provinces')
    ->as('provinces.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
    });
//***** -- Province -- ******* //


//***** -- Ranks -- ******* //
Route::controller(App\Api\V1\Http\Controllers\Ranks\RanksController::class)
    ->prefix('/rankss')
    ->as('ranks.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/show/{id}', 'show')->name('show');
    });
//***** -- Ranks -- ******* //


//***** -- Banks -- ******* //
Route::controller(App\Api\V1\Http\Controllers\Banks\BanksController::class)
    ->prefix('/banks')
    ->as('banks.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
    });
//***** -- Banks -- ******* //



//***** -- BookingLake -- ******* //
Route::controller(App\Api\V1\Http\Controllers\BookingLake\BookingLakeController::class)
    ->prefix('/bookingLakes')
    ->as('bookingLake.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/show/{id}', 'show')->name('show');
    });
//***** -- BookingLake -- ******* //




//post category
Route::controller(App\Api\V1\Http\Controllers\PostCategory\PostCategoryController::class)
    ->prefix('/posts-categories')
    ->as('post_catogery.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/show/{id}', 'show')->name('show');
    });

//posts
Route::controller(App\Api\V1\Http\Controllers\Post\PostController::class)
    ->prefix('/posts')
    ->as('post.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/featured', 'featured')->name('featured');
        Route::get('/show/{id}', 'show')->name('show');
        Route::get('/related/{id}', 'related')->name('related');
    });

//settings
Route::controller(App\Api\V1\Http\Controllers\Settings\SettingController::class)
    ->prefix('/settings')
    ->as('settings.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
    });

//slider
Route::controller(App\Api\V1\Http\Controllers\Slider\SliderController::class)
    ->prefix('/slider')
    ->as('slider.')
    ->group(function () {
        Route::get('/show/{key}', 'show')->name('show');
    });

Route::controller(App\Api\V1\Http\Controllers\Auth\ResetPasswordController::class)
    ->prefix('/reset-password')
    ->as('reset_password.')
    ->group(function () {
        Route::post('/', 'checkAndSendMail')->name('check_and_send_mail');
    });

Route::fallback(function () {
    return response()->json([
        'status' => 404,
        'message' => __('Không tìm thấy đường dẫn.')
    ], 404);
});
