<?php

use App\Http\Controllers\WeatherApiController;
use Illuminate\Support\Facades\Route;

//route for the weather view 
Route::get('/', [WeatherApiController::class, 'getWeather']);
