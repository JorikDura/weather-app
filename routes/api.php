<?php

use App\Http\Controllers\Api\V1\History\IndexHistoryController;
use App\Http\Controllers\Api\V1\Weather\ShowWeatherController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/weather', ShowWeatherController::class);
    Route::get('/history', IndexHistoryController::class);
});
