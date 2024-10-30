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
    <div class="grid grid-cols-2 gap-6 m-6">

        <!-- @if ($errors)
            {{ var_export($errors) }}
        @endif -->

        <!-- CARD - to dispay the search location bar -->
        <div class="col-start-1 col-span-2 rounded overflow-hidden outline bg-white">
            <div class="px-6 py-6 text-center">
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
        <div class="col-start-1 col-span-1 rounded overflow-hidden outline bg-white">
            <div class="px-6 py-4">
                @if (isset($weatherData))
                    <div class="m-10 text-lg font-bold text-center">
                        The weather in {{ $weatherData['name'] }} is currently
                        {{ $weatherData['weather'][0]['description'] }},
                        with temperatures of {{ $weatherData['main']['temp'] }} °C.
                    </div>
                @endif
            </div>
        </div>




        <!-- CARD - to display the upoming weather -->
        <div class="col-start-2 col-span-1 rounded overflow-hidden outline bg-white">
            <div class="px-6 py-4 text-center">
                @if (isset($futureWeatherData))
                    <div>
                        {{ $futureWeatherData['list'][6]['weather'][0]['description'] }}
                    </div>
                @endif
            </div>
        </div>




        <!-- CARD - to display historical weather data -->
        <div class="col-start-1 col-span-2 rounded overflow-hidden outline bg-white">
            <div class="px-6 py-4 text-center">
                **this will show historical weather data**
            </div>
        </div>
    </div>
</body>

</html>