<?php

use App\Http\Controllers\WeatherApiController;
use Illuminate\Support\Facades\Route;

//route for the weather view 
Route::get('/', [WeatherApiController::class, 'getWeather']);

//route for posting the form from view that contains the clients location 
Route::post('/', [WeatherApiController::class, 'postClientLocation']);