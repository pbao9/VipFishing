<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Admin\Http\Controllers\Home\HomeController::class, 'index']);

// login
Route::controller(App\Admin\Http\Controllers\Auth\LoginController::class)
    ->middleware('guest:admin')
    ->prefix('/login')
    ->as('login.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'login')->name('post');
    });

Route::group(['middleware' => 'admin.auth.admin:admin'], function () {
    // ***** -- Lakes -- ******* //
    Route::prefix('/lakes')->as('lakes.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\Lakechilds\LakechildsController::class)
            ->as('item.')
            ->group(function () {
                Route::group(['middleware' => ['permission:createLakechilds', 'auth:admin']], function () {
                    Route::get('/{lake_id}/item/them', 'create')->name('create');
                    Route::post('/item/them', 'store')->name('store');
                });
                Route::group(['middleware' => ['permission:viewLakechilds', 'auth:admin']], function () {
                    Route::get('/{lake_id}/item', 'index')->name('index');
                    Route::get('/item/sua/{id}', 'edit')->name('edit');
                });
                Route::group(['middleware' => ['permission:updateLakechilds', 'auth:admin']], function () {
                    Route::put('/item/sua', 'update')->name('update');
                });
                Route::group(['middleware' => ['permission:deleteLakechilds', 'auth:admin']], function () {
                    Route::delete('/{lake_id}/item/xoa/{id}', 'delete')->name('delete');
                });
                Route::delete('/{lake_id}/item/xoa/{id}', 'delete')->name('delete');
            });
        Route::controller(App\Admin\Http\Controllers\LakeRatings\LakeRatingsController::class)
            ->as('rating.')
            ->group(function () {
                Route::group(['middleware' => ['permission:createRatings', 'auth:admin']], function () {
                    Route::get('/{lake_id}/rating/them', 'create')->name('create');
                    Route::post('/rating/them', 'store')->name('store');
                });
                Route::group(['middleware' => ['permission:viewRatings', 'auth:admin']], function () {
                    Route::get('/{lake_id}/rating', 'index')->name('index');
                    Route::get('/rating/sua/{id}', 'edit')->name('edit');
                });
                Route::group(['middleware' => ['permission:updateRatings', 'auth:admin']], function () {
                    Route::put('/rating/sua', 'update')->name('update');
                });
                Route::group(['middleware' => ['permission:deleteRatings', 'auth:admin']], function () {
                    Route::delete('/{lake_id}/rating/xoa/{id}', 'delete')->name('delete');
                });
                Route::delete('/{lake_id}/rating/xoa/{id}', 'delete')->name('delete');
            });
        Route::controller(App\Admin\Http\Controllers\LakeChildRatings\LakeChildRatingsController::class)
            ->as('item.rating.')
            ->group(function () {
                Route::group(['middleware' => ['permission:createRatings', 'auth:admin']], function () {
                    Route::get('/{lake_id}/item/{lakechild_id}/rating/them', 'create')->name('create');
                    Route::post('/{lake_id}/item/{lakechild_id}/rating/them', 'store')->name('store');
                });
                Route::group(['middleware' => ['permission:viewRatings', 'auth:admin']], function () {
                    Route::get('/item/{lakechild_id}/rating', 'index')->name('index');
                    Route::get('/item/{lakechild_id}/rating/sua/{id}', 'edit')->name('edit');
                });
                Route::group(['middleware' => ['permission:updateRatings', 'auth:admin']], function () {
                    Route::put('/{lake_id}/item/{lakechild_id}/rating/sua', 'update')->name('update');
                });
                Route::group(['middleware' => ['permission:deleteRatings', 'auth:admin']], function () {
                    Route::delete('/{lake_id}/item/{lakechild_id}/rating/xoa/{id}', 'delete')->name('delete');
                });
            });
        Route::controller(App\Admin\Http\Controllers\Lakes\LakesController::class)
            ->group(function () {
                Route::group(['middleware' => ['permission:createLakes', 'auth:admin']], function () {
                    Route::get('/them', 'create')->name('create');
                    Route::post('/them', 'store')->name('store');
                });
                Route::group(['middleware' => ['permission:viewLakes', 'auth:admin']], function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/sua/{id}', 'edit')->name('edit');
                });

                Route::group(['middleware' => ['permission:updateLakes', 'auth:admin']], function () {
                    Route::put('/sua', 'update')->name('update');
                });

                Route::group(['middleware' => ['permission:deleteLakes', 'auth:admin']], function () {
                    Route::delete('/xoa/{id}', 'delete')->name('delete');
                });
            });
    });

    //***** -- Fishs -- ******* //
    Route::prefix('/fishs')->as('fishs.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\VariationFishs\VariationFishsController::class)
            ->as('item.')
            ->group(function () {
                Route::group(['middleware' => ['permission:createVariationFishs', 'auth:admin']], function () {
                    Route::get('/{fish_id}/item/them', 'create')->name('create');
                    Route::post('/item/them', 'store')->name('store');
                    // Route::get('/them/{fish_id}', 'create')->name('create.withFishID');
                });
                Route::group(['middleware' => ['permission:viewVariationFishs', 'auth:admin']], function () {
                    // Route::get('/', 'index')->name('index');
                    // Route::get('/{fish_id}/item', 'index')->name('index.withId');
                    Route::get('/{fish_id}/item', 'index')->name('index');
                    Route::get('/item/sua/{id}', 'edit')->name('edit');
                });

                Route::group(['middleware' => ['permission:updateVariationFishs', 'auth:admin']], function () {
                    Route::put('/item/sua', 'update')->name('update');
                });

                Route::group(['middleware' => ['permission:deleteVariationFishs', 'auth:admin']], function () {
                    Route::delete('/{fish_id}/item/xoa/{id}', 'delete')->name('delete');
                });
            });
        Route::controller(App\Admin\Http\Controllers\Fishs\FishsController::class)->group(function () {
            Route::group(['middleware' => ['permission:createFishs', 'auth:admin']], function () {
                Route::get('/them', 'create')->name('create');
                Route::post('/them', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewFishs', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updateFishs', 'auth:admin']], function () {
                Route::put('/sua', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deleteFishs', 'auth:admin']], function () {
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
        });
    });

    //***** -- Ratings -- ******* //
    Route::prefix('/ratings')->as('ratings.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\Ratings\RatingsController::class)->group(function () {
            Route::group(['middleware' => ['permission:createRatings', 'auth:admin']], function () {
                Route::get('/them', 'create')->name('create');
                Route::post('/them', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewRatings', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updateRatings', 'auth:admin']], function () {
                Route::put('/sua', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deleteRatings', 'auth:admin']], function () {
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
        });
    });
    //***** -- Ratings -- ******* //

    //***** -- Ranks -- ******* //
    Route::prefix('/ranks')->as('ranks.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\Ranks\RanksController::class)->group(function () {
            Route::group(['middleware' => ['permission:viewRanks', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updateRanks', 'auth:admin']], function () {
                Route::put('/sua', 'update')->name('update');
            });
        });
    });
    //***** -- Ranks -- ******* //

    //***** -- Withdraws -- ******* //
    Route::prefix('/withdraws')->as('withdraws.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\Withdraws\WithdrawsController::class)->group(function () {
            Route::group(['middleware' => ['permission:createWithdraws', 'auth:admin']], function () {
                Route::get('/them', 'create')->name('create');
                Route::post('/them', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewWithdraws', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updateWithdraws', 'auth:admin']], function () {
                Route::put('/sua', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deleteWithdraws', 'auth:admin']], function () {
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
        });
    });
    //***** -- Withdraws -- ******* //

    //***** -- Deposits -- ******* //
    Route::prefix('/deposits')->as('deposits.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\Deposits\DepositsController::class)->group(function () {
            Route::group(['middleware' => ['permission:createDeposits', 'auth:admin']], function () {
                Route::get('/them', 'create')->name('create');
                Route::post('/them', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewDeposits', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updateDeposits', 'auth:admin']], function () {
                Route::put('/sua', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deleteDeposits', 'auth:admin']], function () {
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
        });
    });
    //***** -- Deposits -- ******* //

    //***** -- TransactionHistory -- ******* //
    Route::prefix('/transactionHistory')->as('transactionHistory.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\TransactionHistory\TransactionHistoryController::class)->group(function () {
            Route::group(['middleware' => ['permission:createTransactionHistory', 'auth:admin']], function () {
                Route::get('/them', 'create')->name('create');
                Route::post('/them', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewTransactionHistory', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updateTransactionHistory', 'auth:admin']], function () {
                Route::put('/sua', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deleteTransactionHistory', 'auth:admin']], function () {
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
        });
    });
    //***** -- TransactionHistory -- ******* //

    //***** -- Balances -- ******* //
    Route::prefix('/balances')->as('balances.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\Balances\BalancesController::class)->group(function () {
            Route::group(['middleware' => ['permission:createBalances', 'auth:admin']], function () {
                Route::get('/them', 'create')->name('create');
                Route::post('/them', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewBalances', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updateBalances', 'auth:admin']], function () {
                Route::put('/sua', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deleteBalances', 'auth:admin']], function () {
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
        });
    });
    //***** -- Balances -- ******* //

    //***** -- Compensations -- ******* //
    Route::prefix('/compensations')->as('compensations.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\Compensations\CompensationsController::class)->group(function () {
            Route::group(['middleware' => ['permission:createCompensations', 'auth:admin']], function () {
                Route::get('/them', 'create')->name('create');
                Route::post('/them', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewCompensations', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updateCompensations', 'auth:admin']], function () {
                Route::put('/sua', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deleteCompensations', 'auth:admin']], function () {
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
        });
    });
    //***** -- Compensations -- ******* //

    //***** -- CommissionHistory -- ******* //
    Route::prefix('/commissionHistory')->as('commissionHistory.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\CommissionHistory\CommissionHistoryController::class)->group(function () {
            Route::group(['middleware' => ['permission:createCommissionHistory', 'auth:admin']], function () {
                Route::get('/them', 'create')->name('create');
                Route::post('/them', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewCommissionHistory', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updateCommissionHistory', 'auth:admin']], function () {
                Route::put('/sua', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deleteCommissionHistory', 'auth:admin']], function () {
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
        });
    });
    //***** -- CommissionHistory -- ******* //

    //***** -- Banks -- ******* //
    Route::prefix('/banks')->as('banks.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\Banks\BanksController::class)->group(function () {
            Route::group(['middleware' => ['permission:createBanks', 'auth:admin']], function () {
                Route::get('/them', 'create')->name('create');
                Route::post('/them', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewBanks', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updateBanks', 'auth:admin']], function () {
                Route::put('/sua', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deleteBanks', 'auth:admin']], function () {
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
        });
    });
    //***** -- Banks -- ******* //

    //***** -- Bookings -- ******* //
    Route::prefix('/bookings')->as('bookings.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\Bookings\BookingsController::class)->group(function () {
            Route::group(['middleware' => ['permission:createBookings', 'auth:admin']], function () {
                Route::get('/them', 'create')->name('create');
                Route::post('/them', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewBookings', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updateBookings', 'auth:admin']], function () {
                Route::put('/sua', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deleteBookings', 'auth:admin']], function () {
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
            // Add the route for getActivityDates
            Route::get('/activity-dates', 'getActivityDates')->name('activityDates');
        });
    });
    //***** -- Bookings -- ******* //

    //***** -- CloseLake -- ******* //
    Route::prefix('/closeLakes')->as('closeLakes.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\CloseLakes\CloseLakesController::class)->group(function () {
            Route::group(['middleware' => ['permission:createCloseLake', 'auth:admin']], function () {
                Route::get('/them', 'create')->name('create');
                Route::post('/them', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewCloseLake', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updateCloseLake', 'auth:admin']], function () {
                Route::put('/sua', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deleteCloseLake', 'auth:admin']], function () {
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
        });
    });
    //***** -- CloseLake -- ******* //

    //***** -- FishingSet -- ******* //
    Route::prefix('/fishingSet')->as('fishingSet.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\FishingSet\FishingSetController::class)->group(function () {
            Route::group(['middleware' => ['permission:createFishingSet', 'auth:admin']], function () {
                Route::get('/them', 'create')->name('create');
                Route::post('/them', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewFishingSet', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updateFishingSet', 'auth:admin']], function () {
                Route::put('/sua', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deleteFishingSet', 'auth:admin']], function () {
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
        });
    });
    //***** -- FishingSet -- ******* //

    //***** -- BookingLake -- ******* //
    Route::prefix('/bookingLake')->as('bookingLake.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\BookingLake\BookingLakeController::class)->group(function () {
            // Route::group(['middleware' => ['permission:createBookingLake', 'auth:admin']], function () {
            // 	Route::get('/them', 'create')->name('create');
            // 	Route::post('/them', 'store')->name('store');
            // });
            Route::group(['middleware' => ['permission:viewBookingLake', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                // Route::get('/sua/{id}', 'edit')->name('edit');
            });

            // Route::group(['middleware' => ['permission:updateBookingLake', 'auth:admin']], function () {
            // 	Route::put('/sua', 'update')->name('update');
            // });

            // Route::group(['middleware' => ['permission:deleteBookingLake', 'auth:admin']], function () {
            // 	Route::delete('/xoa/{id}', 'delete')->name('delete');
            // });
        });
    });
    //***** -- BookingLake -- ******* //

    //***** -- Notifications -- ******* //
    Route::prefix('/notifications')->as('notifications.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\Notifications\NotificationsController::class)->group(function () {
            Route::group(['middleware' => ['permission:createNotifications', 'auth:admin']], function () {
                Route::get('/them', 'create')->name('create');
                Route::post('/them', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewNotifications', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updateNotifications', 'auth:admin']], function () {
                Route::put('/sua', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deleteNotifications', 'auth:admin']], function () {
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
        });
    });
    //***** -- Notifications -- ******* //

    //***** -- Events -- ******* //
    Route::prefix('/events')->as('events.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\Events\EventsController::class)->group(function () {
            Route::group(['middleware' => ['permission:createEvents', 'auth:admin']], function () {
                Route::get('/them', 'create')->name('create');
                Route::post('/them', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewEvents', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updateEvents', 'auth:admin']], function () {
                Route::put('/sua', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deleteEvents', 'auth:admin']], function () {
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
        });
    });
    //***** -- Events -- ******* //

    //***** -- LakeEvents -- ******* //
    // Route::prefix('/lakeEvents')->as('lakeEvents.')->group(function () {
    // 	Route::controller(App\Admin\Http\Controllers\LakeEvents\LakeEventsController::class)->group(function () {
    // 		Route::group(['middleware' => ['permission:createLakeEvents', 'auth:admin']], function () {
    // 			Route::get('/them', 'create')->name('create');
    // 			Route::post('/them', 'store')->name('store');
    // 		});
    // 		Route::group(['middleware' => ['permission:viewLakeEvents', 'auth:admin']], function () {
    // 			Route::get('/', 'index')->name('index');
    // 			Route::get('/sua/{id}', 'edit')->name('edit');
    // 		});

    // 		Route::group(['middleware' => ['permission:updateLakeEvents', 'auth:admin']], function () {
    // 			Route::put('/sua', 'update')->name('update');
    // 		});

    // 		Route::group(['middleware' => ['permission:deleteLakeEvents', 'auth:admin']], function () {
    // 			Route::delete('/xoa/{id}', 'delete')->name('delete');
    // 		});
    // 	});
    // });
    //***** -- LakeEvents -- ******* //

    //***** -- UserEvents -- ******* //
    Route::prefix('/userEvents')->as('userEvents.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\UserEvents\UserEventsController::class)->group(function () {
            // Route::group(['middleware' => ['permission:createUserEvents', 'auth:admin']], function () {
            // 	Route::get('/them', 'create')->name('create');
            // 	Route::post('/them', 'store')->name('store');
            // });
            Route::group(['middleware' => ['permission:viewUserEvents', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{event_id}', 'index')->name('event.index');
                // Route::get('/sua/{id}', 'edit')->name('edit');
            });

            // Route::group(['middleware' => ['permission:updateUserEvents', 'auth:admin']], function () {
            // 	Route::put('/sua', 'update')->name('update');
            // });

            // Route::group(['middleware' => ['permission:deleteUserEvents', 'auth:admin']], function () {
            // 	Route::delete('/xoa/{id}', 'delete')->name('delete');
            // });
        });
    });
    //***** -- UserEvents -- ******* //

    //***** -- UserScores -- ******* //
    Route::prefix('/userScores')->as('userScores.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\UserScores\UserScoresController::class)->group(function () {
            Route::group(['middleware' => ['permission:createUserScores', 'auth:admin']], function () {
                Route::get('/them', 'create')->name('create');
                Route::post('/them', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewUserScores', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updateUserScores', 'auth:admin']], function () {
                Route::put('/sua', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deleteUserScores', 'auth:admin']], function () {
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
        });
    });
    //***** -- UserScores -- ******* //


    //***** -- Module -- ******* //
    Route::prefix('/module')->as('module.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\Module\ModuleController::class)->group(function () {
            Route::get('/them', 'create')->name('create');
            Route::get('/', 'index')->name('index');
            Route::get('/summary', 'summary')->name('summary');
            Route::get('/sua/{id}', 'edit')->name('edit');
            Route::put('/sua', 'update')->name('update');
            Route::post('/them', 'store')->name('store');
            Route::delete('/xoa/{id}', 'delete')->name('delete');
        });
    });
    //***** -- Module -- ******* //

    //***** -- Permission -- ******* //
    Route::prefix('/permission')->as('permission.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\Permission\PermissionController::class)->group(function () {
            Route::get('/them', 'create')->name('create');
            Route::get('/', 'index')->name('index');
            Route::get('/sua/{id}', 'edit')->name('edit');
            Route::put('/sua', 'update')->name('update');
            Route::post('/them', 'store')->name('store');
            Route::delete('/xoa/{id}', 'delete')->name('delete');
        });
    });
    //***** -- Permission -- ******* //

    //***** -- Role -- ******* //
    Route::prefix('/role')->as('role.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\Role\RoleController::class)->group(function () {

            Route::group(['middleware' => ['permission:createRole', 'auth:admin']], function () {
                Route::get('/them', 'create')->name('create');
                Route::post('/them', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewRole', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updateRole', 'auth:admin']], function () {
                Route::put('/sua', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deleteRole', 'auth:admin']], function () {
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
        });
    });
    //***** -- Role -- ******* //


    //Post
    Route::prefix('/posts')->as('post.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\Post\PostController::class)->group(function () {

            Route::group(['middleware' => ['permission:createPost', 'auth:admin']], function () {
                Route::get('/them', 'create')->name('create');
                Route::post('/them', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewPost', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updatePost', 'auth:admin']], function () {
                Route::put('/sua', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deletePost', 'auth:admin']], function () {
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
        });
    });


    //Post category
    Route::prefix('/posts-categories')->as('post_category.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\PostCategory\PostCategoryController::class)->group(function () {
            Route::group(['middleware' => ['permission:createPostCategory', 'auth:admin']], function () {
                Route::get('/them', 'create')->name('create');
                Route::post('/them', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewPostCategory', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updatePostCategory', 'auth:admin']], function () {
                Route::put('/sua', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deletePostCategory', 'auth:admin']], function () {
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
        });
    });

    //Settings
    Route::controller(App\Admin\Http\Controllers\Setting\SettingController::class)
        ->prefix('/settings')
        ->as('setting.')
        ->group(function () {
            Route::group(['middleware' => ['permission:settingGeneral', 'auth:admin']], function () {
                Route::get('/general', 'general')->name('general');
            });

            Route::get('/user-shopping', 'userShopping')->name('user_shopping');
            Route::put('/update', 'update')->name('update');
        });

    //sliders
    Route::prefix('/sliders')->as('slider.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\Slider\SliderItemController::class)
            ->as('item.')
            ->group(function () {
                Route::get('/{slider_id}/item/them', 'create')->name('create');
                Route::get('/{slider_id}/item', 'index')->name('index');
                Route::get('/item/sua/{id}', 'edit')->name('edit');
                Route::put('/item/sua', 'update')->name('update');
                Route::post('/item/them', 'store')->name('store');
                Route::delete('/{slider_id}/item/xoa/{id}', 'delete')->name('delete');
            });
        Route::controller(App\Admin\Http\Controllers\Slider\SliderController::class)->group(function () {
            Route::group(['middleware' => ['permission:createSlider', 'auth:admin']], function () {
                Route::get('/them', 'create')->name('create');
                Route::post('/them', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewSlider', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updateSlider', 'auth:admin']], function () {
                Route::put('/sua', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deleteSlider', 'auth:admin']], function () {
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
        });
    });

    //Order detail
    Route::controller(App\Admin\Http\Controllers\Order\OrderDetailController::class)
        ->prefix('order-detail')
        ->as('order_detail.')
        ->group(function () {
            Route::delete('/delete/{id?}', 'delete')->name('delete');
        });

    //Order
    Route::prefix('/orders')->as('order.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\Order\OrderController::class)->group(function () {
            Route::group(['middleware' => ['permission:createOrder', 'auth:admin']], function () {
                Route::get('/them', 'create')->name('create');
                Route::post('/them', 'store')->name('store');
            });

            Route::group(['middleware' => ['permission:viewOrder', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
            });


            Route::group(['middleware' => ['permission:updateOrder', 'auth:admin']], function () {
                Route::put('/sua', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deleteOrder', 'auth:admin']], function () {
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });

            Route::get('/render-info-shipping', 'renderInfoShipping')->name('render_info_shipping');
            Route::get('/add-product', 'addProduct')->name('add_product');
            Route::get('/calculate-total-before-save-order', 'calculateTotalBeforeSaveOrder')->name('calculate_total_before_save_order');
        });
    });
    //attributes
    Route::prefix('/attributes')->as('attribute.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\AttributeVariation\AttributeVariationController::class)
            ->as('variation.')
            ->group(function () {
                Route::get('/{attribute_id}/variations/them', 'create')->name('create');
                Route::get('/{attribute_id}/variations', 'index')->name('index');
                Route::get('/variations/sua/{id}', 'edit')->name('edit');
                Route::put('/variations/sua', 'update')->name('update');
                Route::post('/variations/them', 'store')->name('store');
                Route::delete('/{attribute_id}/variations/xoa/{id}', 'delete')->name('delete');
            });
        Route::controller(App\Admin\Http\Controllers\Attribute\AttributeController::class)->group(function () {
            Route::group(['middleware' => ['permission:createProductAttribute', 'auth:admin']], function () {
                Route::get('/them', 'create')->name('create');
                Route::post('/them', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewProductAttribute', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updateProductAttribute', 'auth:admin']], function () {
                Route::put('/sua', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deleteProductAttribute', 'auth:admin']], function () {
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
        });
    });

    //Product
    Route::prefix('/products')->as('product.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\Product\ProductController::class)->group(function () {
            Route::group(['middleware' => ['permission:createProduct', 'auth:admin']], function () {
                Route::get('/them', 'create')->name('create');
                Route::post('/them', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewProduct', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updateProduct', 'auth:admin']], function () {
                Route::put('/sua', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deleteProduct', 'auth:admin']], function () {
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
        });
        Route::controller(App\Admin\Http\Controllers\Product\ProductAttributeController::class)
            ->prefix('/attributes')
            ->as('attribute.')
            ->group(function () {
                Route::get('/them', 'create')->name('create');
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
                Route::put('/sua', 'update')->name('update');
                Route::post('/them', 'store')->name('store');
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
        Route::controller(App\Admin\Http\Controllers\Product\ProductVariationController::class)
            ->prefix('/variations')
            ->as('variation.')
            ->group(function () {
                Route::get('/check', 'check')->name('check');
                Route::get('/them', 'create')->name('create');
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
                Route::put('/sua', 'update')->name('update');
                Route::post('/them', 'store')->name('store');
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
    });

    //Category
    Route::prefix('/categories')->as('category.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\Category\CategoryController::class)->group(function () {
            Route::group(['middleware' => ['permission:createProductCategory', 'auth:admin']], function () {
                Route::get('/them', 'create')->name('create');
                Route::post('/them', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewProductCategory', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updateProductCategory', 'auth:admin']], function () {
                Route::put('/sua', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deleteProductCategory', 'auth:admin']], function () {
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
        });
    });

    //user
    Route::prefix('/users')->as('user.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\User\UserController::class)->group(function () {
            Route::group(['middleware' => ['permission:createUser', 'auth:admin']], function () {
                Route::get('/them', 'create')->name('create');
                Route::post('/them', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewUser', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updateUser', 'auth:admin']], function () {
                Route::put('/sua', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deleteUser', 'auth:admin']], function () {
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
        });
    });
    //admin
    Route::prefix('/admins')->as('admin.')->group(function () {
        Route::controller(App\Admin\Http\Controllers\Admin\AdminController::class)->group(function () {
            Route::group(['middleware' => ['permission:createAdmin', 'auth:admin']], function () {
                Route::get('/them', 'create')->name('create');
                Route::post('/them', 'store')->name('store');
            });
            Route::group(['middleware' => ['permission:viewAdmin', 'auth:admin']], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/sua/{id}', 'edit')->name('edit');
            });

            Route::group(['middleware' => ['permission:updateAdmin', 'auth:admin']], function () {
                Route::put('/sua', 'update')->name('update');
            });

            Route::group(['middleware' => ['permission:deleteAdmin', 'auth:admin']], function () {
                Route::delete('/xoa/{id}', 'delete')->name('delete');
            });
        });
        // Route::get('/select-search', [AdminSearchController::class, 'selectSearch'])->name('selectsearch');
    });

    //ckfinder
    Route::prefix('/quan-ly-file')->as('ckfinder.')->group(function () {
        Route::any('/ket-noi', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
            ->name('connector');
        Route::any('/duyet', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
            ->name('browser');
    });
    Route::get('/dashboard', [App\Admin\Http\Controllers\Dashboard\DashboardController::class, 'index'])->name('dashboard');

    //auth
    Route::controller(App\Admin\Http\Controllers\Auth\ProfileController::class)
        ->prefix('/profile')
        ->as('profile.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::put('/', 'update')->name('update');
        });

    Route::controller(App\Admin\Http\Controllers\Auth\ChangePasswordController::class)
        ->prefix('/password')
        ->as('password.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::put('/', 'update')->name('update');
        });
    Route::prefix('/search')->as('search.')->group(function () {
        Route::prefix('/select')->as('select.')->group(function () {
            Route::get('/user', [App\Admin\Http\Controllers\User\UserSearchSelectController::class, 'selectSearch'])->name('user');
            Route::get('/admin', [App\Admin\Http\Controllers\Admin\AdminSearchSelectController::class, 'selectSearch'])->name('admin');
            Route::get('/bank', [App\Admin\Http\Controllers\Banks\BankSearchSelectController::class, 'selectSearch'])->name('bank');
            Route::get('/rank', [App\Admin\Http\Controllers\Ranks\RankSearchSelectController::class, 'selectSearch'])->name('rank');
            Route::get('/booking', [App\Admin\Http\Controllers\Bookings\BookingSearchSelectController::class, 'selectSearch'])->name('booking');
            Route::get('/lakechild', [App\Admin\Http\Controllers\Lakechilds\LakechildsSearchSelectController::class, 'selectSearch'])->name('lakechild');
            Route::get('/fishingset', [App\Admin\Http\Controllers\FishingSet\FishingSetSearchSelectController::class, 'selectSearch'])->name('fishingset');
            Route::get('/fishs', [App\Admin\Http\Controllers\Fishs\FishSearchSelectController::class, 'selectSearch'])->name('fishs');
            Route::get('/provinces', [App\Admin\Http\Controllers\Provinces\ProvincesSearchSelectController::class, 'selectSearch'])->name('provinces');
            Route::get('/lakechilds', [App\Admin\Http\Controllers\Lakechilds\LakechildsSearchSelectController::class, 'selectSearch'])->name('lakechilds');
            Route::get('/lakes', [App\Admin\Http\Controllers\Lakes\LakeSearchSelectController::class, 'selectSearch'])->name('lakes');
            Route::get('/activity-dates', [App\Admin\Http\Controllers\Lakechilds\ActivityDaySearchSelectController::class, 'selectSearch'])->name('activityDate');
        });
        Route::get('/render-product-and-variation', [App\Admin\Http\Controllers\Product\ProductController::class, 'searchRenderProductAndVariation'])->name('render_product_and_variation');
    });
    Route::post('/logout', [App\Admin\Http\Controllers\Auth\LogoutController::class, 'logout'])->name('logout');
});
