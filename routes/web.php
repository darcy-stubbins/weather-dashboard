<?php

use App\Http\Controllers\WeatherApiController;
use Illuminate\Support\Facades\Route;

//posting the form that contains the clients location 
Route::post('/', [WeatherApiController::class, 'postClientLocation']);

//weather route  
Route::get('/', [WeatherApiController::class, 'getWeather']);
