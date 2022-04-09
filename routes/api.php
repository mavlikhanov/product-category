<?php

use App\Http\Controllers\Authorization\LoginController;
use App\Http\Controllers\Authorization\LogoutController;
use App\Http\Controllers\Authorization\RegistrationController;
use App\Http\Controllers\Authorization\TokenRefreshController;
use App\Http\Controllers\Catalog\CategoryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'authorization'], function () {
    Route::post('registration', [RegistrationController::class, 'register']);
    Route::post('login', [LoginController::class, 'login']);
    Route::post('token_refresh', [TokenRefreshController::class, 'tokenRefresh']);
    Route::middleware('auth:api')->group(function () {
        Route::post('test', function () {
            return 'test';
        });
        Route::post('logout', [LogoutController::class, 'logout']);
    });
});

Route::group(['prefix' => 'catalog', 'middleware' => 'auth:api'], function () {
    Route::apiResource('category', CategoryController::class);
});