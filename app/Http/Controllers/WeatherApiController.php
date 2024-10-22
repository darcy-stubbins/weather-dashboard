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

        //given city loaction 
        $givenLocation = 'Derby';



        //geocode api to get the location, to provide to the weather API 
        $clientLocation = "http://api.openweathermap.org/geo/1.0/direct?q={$givenLocation}&appid={$apiKey}";

        //my GET request to the API 
        $ApiLocationResponse = $client->get($clientLocation);

        //get the response body (true returns as array rather than object)
        $locationResponse = json_decode($ApiLocationResponse->getBody(), true);

        //the lattitude and longitude 
        $lat = $locationResponse[0]['lat'];
        $lon = $locationResponse[0]['lon'];



        //weather api url with location and metric measurements 
        $apiEndpoint = "https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&units=metric&appid={$apiKey}";

        //my GET request to the API 
        $ApiWeatherResponse = $client->get($apiEndpoint);

        //get the response body (true returns as array rather than object)
        $apiData = json_decode($ApiWeatherResponse->getBody(), true);

        //return the weather data 
        return view('weatherView', ['weatherData' => $apiData]);
    }
}
