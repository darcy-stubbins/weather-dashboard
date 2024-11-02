<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Validator;

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

    //get the default weather view (without user inputting location)
    public function getWeather()
    {
        //return the weather data 
        return view('weatherView');
    }

    //post the inputted location from the client and return the view  
    public function postClientLocation(Request $request)
    {
        //validating the user has inputted data 
        Validator::make($request->input(), [
            'location' => 'required',
        ], ['location' => 'my custom location error message'])->validate();

        //location recieved from client
        $foundLocation = $request->location;

        //return the weather data while passing in the client location 
        return view('weatherView', $this->getLocationDetails($foundLocation));
    }

    //get the lat and lon of client inputted location and pase into their respective functions (getCurrentWeatherData and getFutureWeatherData)
    public function getLocationDetails(string $foundLocation)
    {
        //given location 
        $givenLocation = $foundLocation;

        //geocode api to get the location, to provide to the weather API 
        $clientLocation = "http://api.openweathermap.org/geo/1.0/direct?q={$givenLocation}&appid={$this->apiKey}";

        //my GET request to the API 
        $ApiLocationResponse = $this->client->get($clientLocation);

        //get the response body (true returns as array rather than object)
        $locationResponse = json_decode($ApiLocationResponse->getBody(), true);

        if ($locationResponse) {
            //the lattitude and longitude 
            $lat = $locationResponse[0]['lat'];
            $lon = $locationResponse[0]['lon'];

            //parse the lat and lon into the function getCurrentWeatherData
            $currentApiData = $this->getCurrentWeatherData($lat, $lon);

            //parse the lat and lon into the function getFutureWeatherData
            $futureApiData = $this->getFutureWeatherData($lat, $lon);

            //return the weather data 
            return ['weatherData' => $currentApiData, 'futureWeatherData' => $futureApiData];
        }
        return [];
    }

    //get the current weather data from the api 
    private function getCurrentWeatherData(string $lat, string $lon)
    {
        //weather api url with location and metric measurements 
        $apiEndpoint = "https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&units=metric&appid={$this->apiKey}";

        //my GET request to the API 
        $ApiWeatherResponse = $this->client->get($apiEndpoint);

        //get the response body
        return json_decode($ApiWeatherResponse->getBody(), true);
    }

    //get the upcoming weather data from the api 
    private function getFutureWeatherData(string $lat, string $lon)
    {
        //weather api url with location and metric measurements 
        $apiEndpoint = "http://api.openweathermap.org/data/2.5/forecast?lat={$lat}&lon={$lon}&units=metric&appid={$this->apiKey}";

        //my GET request to the API 
        $ApiWeatherResponse = $this->client->get($apiEndpoint);

        //get the response body
        return json_decode($ApiWeatherResponse->getBody(), true);
    }
}
