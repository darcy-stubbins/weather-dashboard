<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WeatherApiController extends Controller
{
    //get weather method 
    public function getWeather()
    {
        //my api key 
        $apiKey = env('WEATHER_API_KEY');

        //new guzzle client instance 
        $client = new Client;

        //api url with location and metric measurements 
        $apiEndpoint = "https://api.openweathermap.org/data/2.5/weather?lat=44.34&lon=10.99&appid={$apiKey}";

        //my GET request to the API 
        $response = $client->get($apiEndpoint);

        //get the response body (true returns as array rather than object)
        $apiData = json_decode($response->getBody(), true);

        // dd($apiData);

        //return the weather data 
        return view('weatherView', ['weatherData' => $apiData]);
    }
}
