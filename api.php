<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\SubscriptionController;


Route::middleware('auth:sanctum')->group(function () {
    // User routes
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    // Weather routes
    Route::get('/weather/forecast', [WeatherController::class, 'getWeatherForecast']);
    
    // Subscription routes
    Route::prefix('subscriptions')->group(function () {
        Route::post('/', [SubscriptionController::class, 'create']);
        Route::delete('/', [SubscriptionController::class, 'cancel']);
        Route::get('/current', [SubscriptionController::class, 'getCurrentSubscription']);
    });
});