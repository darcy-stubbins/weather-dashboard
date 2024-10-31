<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Weather Dashboard</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="h-screen bg-yellow-200">
    <div class="grid grid-cols-10 gap-5 pb-24 pt-24">

        <!-- @if ($errors)
            {{ var_export($errors) }}
        @endif -->

        <!-- CARD - to dispay the search location bar -->
        <div class="col-start-2 col-span-4 rounded overflow-hidden outline bg-white">
            <div class="px-6 py-6 text-center">
                <div class=" m-5 text-lg font-bold text-center">
                    {{  'Welcome!' }} <br />
                    {{ 'The Current Time is '}}{{\Carbon\Carbon::now()->format('h:i A') }}
                </div>
                <form action="{{url('/')}}" method="post">
                    @csrf
                    <label class="block text-black text-lg font-bold mb-2" for="location">
                        Enter Your Location
                    </label>
                    <input class=" appearance-none border rounded py-2 px-3 text-black leading-tight" id="location"
                        required type="text" name="location" placeholder="Location">
                    <button
                        class="bg-transparent hover:bg-black text-black font-semibold hover:text-white py-2 px-3 border border-black hover:border-transparent rounded">
                        Confirm Location
                    </button>
                </form>
            </div>
        </div>

        <!-- CARD - to display the current weather -->
        <div class="col-start-6 col-span-4 rounded overflow-hidden outline bg-white">
            <div class="px-6 py-4">
                @if (isset($weatherData))
                    <div class="m-10 text-lg font-bold text-center">
                        The Current Weather in {{ $weatherData['name'] }}:
                    </div>
                    <div>
                        <img src="https://openweathermap.org/img/wn/{{ $weatherData['weather'][0]['icon'] }}@2x.png">
                    </div>
                    <div class="m-10 text-lg text-left">
                        Description: {{ $weatherData['weather'][0]['description'] }} <br />
                        Temp: {{ $weatherData['main']['temp'] }}°C <br />
                        Feels Like: {{ $weatherData['main']['feels_like'] }}°C <br />
                        Humidity: {{ $weatherData['main']['humidity'] }} <br />
                        Pressure: {{ $weatherData['main']['pressure'] }} <br />
                    </div>
                @endif
            </div>
        </div>

        <!-- CARD 0 - to display the upcoming weather -->
        <div class="col-start-2 col-span-2 rounded overflow-hidden outline bg-white">
            <div class="px-6 py-4 text-center">
                @if (isset($futureWeatherData))
                    <div class="mt-5 text-lg font-bold text-center">
                        <!-- The Weather at {{ $futureWeatherData['list'][0]['dt_txt'] }} will be: -->
                        The Weather at
                        {{ \Carbon\Carbon::parse($futureWeatherData['list'][0]['dt_txt'])->format('h A') }}
                        will be:
                    </div>
                    <div>
                        <img
                            src="https://openweathermap.org/img/wn/{{ $futureWeatherData['list'][0]['weather'][0]['icon'] }}@2x.png">
                    </div>
                    <div class="m-5 text-lg text-left">
                        Description: {{ $futureWeatherData['list'][0]['weather'][0]['description'] }} <br />
                        Temp: {{ $futureWeatherData['list'][0]['main']['temp'] }}°C <br />
                        Feels Like: {{ $futureWeatherData['list'][0]['main']['feels_like'] }}°C <br />
                        Humidity: {{ $futureWeatherData['list'][0]['main']['humidity'] }} <br />
                        Pressure: {{ $futureWeatherData['list'][0]['main']['pressure'] }} <br />
                    </div>
                @endif
            </div>
        </div>

        <!-- CARD 1 - to display the upcoming weather -->
        <div class="col-start-4 col-span-2 rounded overflow-hidden outline bg-white">
            <div class="px-6 py-4 text-center">
                @if (isset($futureWeatherData))
                    <div class="mt-5 text-lg font-bold text-center">
                        <!-- The Weather at {{ $futureWeatherData['list'][0]['dt_txt'] }} will be: -->
                        The Weather at
                        {{ \Carbon\Carbon::parse($futureWeatherData['list'][1]['dt_txt'])->format('g A') }}
                        will be:
                    </div>
                    <div>
                        <img
                            src="https://openweathermap.org/img/wn/{{ $futureWeatherData['list'][1]['weather'][0]['icon'] }}@2x.png">
                    </div>
                    <div class="m-5 text-lg text-left">
                        Description: {{ $futureWeatherData['list'][1]['weather'][0]['description'] }} <br />
                        Temp: {{ $futureWeatherData['list'][1]['main']['temp'] }}°C <br />
                        Feels Like: {{ $futureWeatherData['list'][1]['main']['feels_like'] }}°C <br />
                        Humidity: {{ $futureWeatherData['list'][1]['main']['humidity'] }} <br />
                        Pressure: {{ $futureWeatherData['list'][1]['main']['pressure'] }} <br />
                    </div>
                @endif
            </div>
        </div>

        <!-- CARD 2 - to display the upcoming weather -->
        <div class="col-start-6 col-span-2 rounded overflow-hidden outline bg-white">
            <div class="px-6 py-4 text-center">
                @if (isset($futureWeatherData))
                    <div class="mt-5 text-lg font-bold text-center">
                        The Weather at
                        {{ \Carbon\Carbon::parse($futureWeatherData['list'][2]['dt_txt'])->format('g A') }}
                        will be:
                    </div>
                    <div>
                        <img
                            src="https://openweathermap.org/img/wn/{{ $futureWeatherData['list'][2]['weather'][0]['icon'] }}@2x.png">
                    </div>
                    <div class="m-5 text-lg text-left">
                        Description: {{ $futureWeatherData['list'][2]['weather'][0]['description'] }} <br />
                        Temp: {{ $futureWeatherData['list'][2]['main']['temp'] }}°C <br />
                        Feels Like: {{ $futureWeatherData['list'][2]['main']['feels_like'] }}°C <br />
                        Humidity: {{ $futureWeatherData['list'][2]['main']['humidity'] }} <br />
                        Pressure: {{ $futureWeatherData['list'][2]['main']['pressure'] }} <br />
                    </div>
                @endif
            </div>
        </div>

        <!-- CARD 3 - to display the upcoming weather -->
        <div class="col-start-8 col-span-2 rounded overflow-hidden outline bg-white">
            <div class="px-6 py-4 text-center">
                @if (isset($futureWeatherData))
                    <div class="mt-5 text-lg font-bold text-center">
                        The Weather at
                        {{ \Carbon\Carbon::parse($futureWeatherData['list'][3]['dt_txt'])->format('g A') }}
                        will be:
                    </div>
                    <div>
                        <img
                            src="https://openweathermap.org/img/wn/{{ $futureWeatherData['list'][3]['weather'][0]['icon'] }}@2x.png">
                    </div>
                    <div class="mt-5 text-lg text-left">
                        Description: {{ $futureWeatherData['list'][3]['weather'][0]['description'] }} <br />
                        Temp: {{ $futureWeatherData['list'][3]['main']['temp'] }}°C <br />
                        Feels Like: {{ $futureWeatherData['list'][3]['main']['feels_like'] }}°C <br />
                        Humidity: {{ $futureWeatherData['list'][3]['main']['humidity'] }} <br />
                        Pressure: {{ $futureWeatherData['list'][3]['main']['pressure'] }} <br />
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>

</html>