<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(App\Http\Controllers\Auth\ResetPasswordController::class)
    ->prefix('/reset-password')
    ->as('password.reset.')
    ->group(function () {
        Route::get('/edit', 'edit')->name('edit')->middleware('signed');
        Route::put('/update', 'update')->name('update');
        Route::get('/success', 'success')->name('success');
    });


Route::get('/', [App\Admin\Http\Controllers\Home\HomeController::class, 'index']);