<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\UserManagement\UserManagementController;
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

Route::prefix('v1')
    ->group(function () {
        Route::controller(AuthController::class)->group(function () {
            Route::post('login', 'login');
            Route::post('register', 'register');
            Route::get('logout', 'logout');
        });
    })
    ->controller(UserManagementController::class)
    ->group(function (){
        Route::get('get-users', 'index');
        Route::post('store', 'store');
        Route::put('update/{id}', 'update');
        Route::delete('delete/{id}', 'destroy');
    });;
