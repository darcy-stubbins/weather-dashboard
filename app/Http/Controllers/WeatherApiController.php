<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WeatherApiController extends Controller
{
    //my api key 
    private string $apiKey;

    //new guzzle client instance 
    private Client $client;

    //constructor 
    public function __construct()
    {
        $this->apiKey = env('WEATHER_API_KEY');
        $this->client = new Client();
    }

    //get the weather data from the api 
    private function getApiWeatherData(string $foundLocation)
    {
        //given city loaction 
        $givenLocation = $foundLocation;

        //geocode api to get the location, to provide to the weather API 
        $clientLocation = "http://api.openweathermap.org/geo/1.0/direct?q={$givenLocation}&appid={$this->apiKey}";

        //my GET request to the API 
        $ApiLocationResponse = $this->client->get($clientLocation);

        //get the response body (true returns as array rather than object)
        $locationResponse = json_decode($ApiLocationResponse->getBody(), true);

        //the lattitude and longitude 
        $lat = $locationResponse[0]['lat'];
        $lon = $locationResponse[0]['lon'];

        //weather api url with location and metric measurements 
        $apiEndpoint = "https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&units=metric&appid={$this->apiKey}";

        //my GET request to the API 
        $ApiWeatherResponse = $this->client->get($apiEndpoint);

        //get the response body (true returns as array rather than object)
        return json_decode($ApiWeatherResponse->getBody(), true);
    }

    //post the inputted location from the client 
    public function postClientLocation(Request $request)
    {
        //location recieved from client
        $foundLocation = $request->location;

        //parse the found location into the function getApiweatherData
        $apiData = $this->getApiWeatherData($foundLocation);

        //return the weather data 
        return view('weatherView', ['weatherData' => $apiData]);
    }

    //get the default weather view (without user inputting location)
    public function getWeather()
    {
        //return the weather data 
        return view('weatherView');
    }
}
