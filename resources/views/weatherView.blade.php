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

<body class="h-screen">
    <div class="grid grid-cols-10 gap-3 pb-16 pt-16">

        <!-- @if ($errors)
            {{ var_export($errors) }}
        @endif -->

        <!-- OUTER CARD - to dispay the search location bar -->
        @if (!isset($weatherData))
            <div class="mt-20 col-start-2 col-span-8 rounded overflow-hidden bg-white shadow-lg pb-6">
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
                        <div class="w-full px-16 pt-2">
                            <div class="relative">
                                <input id="location" required type="text" name="location" placeholder="Location"
                                    class="w-full bg-transparent placeholder:text-slate-400 text-lg border border-slate-200 rounded pl-3 pr-16 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                    placeholder="Location" />
                                <button
                                    class="absolute right-1 top-1 rounded bg-black py-1 px-2.5 border border-transparent text-center text-lg text-white transition-all shadow-sm hover:shadow focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-800 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="submit">
                                    Confirm Location
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif

        <!-- INNER CARD - to dispay the search location bar -->
        @if (isset($weatherData))
            <div class="col-start-2 col-span-4 rounded overflow-hidden bg-white shadow-lg">
                <div class="px-6 py-6 text-center">
                    <div class=" m-5 text-xl font-bold text-center">
                        {{  'Welcome!' }} <br />
                        {{ 'The Current Time is '}}{{\Carbon\Carbon::now()->format('h:i A') }}
                    </div>
                    <form action="{{url('/')}}" method="post">
                        @csrf
                        <label class="block text-black text-xl font-bold mb-2" for="location">
                            Enter Your Location
                        </label>
                        <div class="w-full px-8 pt-2">
                            <div class="relative">
                                <input id="location" required type="text" name="location" placeholder="Location"
                                    class="w-full bg-transparent placeholder:text-slate-400 text-lg border border-slate-200 rounded pl-3 pr-16 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                    placeholder="Location" />
                                <button
                                    class="absolute right-1 top-1 rounded bg-black py-1 px-2.5 border border-transparent text-center text-lg text-white transition-all shadow-sm hover:shadow focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-800 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="submit">
                                    Confirm Location
                                </button>
                            </div>
                        </div>
                        <div class="flex items-center justify-center p-10 text-lg font-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                            {{ $weatherData['name'] }}
                        </div>
                    </form>
                </div>
            </div>
        @endif

        <!-- CARD - to display the current weather -->
        @if (isset($weatherData))
            <div class="col-start-6 col-span-4 rounded overflow-hidden bg-white shadow-lg">
                <div class="grid grid-cols-3 gap-1 px-6 py-4">
                    <div class="col-start-1 col-span-2 mt-10 pl-5 text-2xl font-bold">
                        Current Weather in {{ $weatherData['name'] }}:
                    </div>
                    <div class="col-start-3 col-span-1">
                        <img src="https://openweathermap.org/img/wn/{{ $weatherData['weather'][0]['icon'] }}@2x.png">
                    </div>
                    <div class="col-start-1 col-span-3 text-xl pb-10 pl-5">
                        {{ $weatherData['weather'][0]['description'] }} <br />
                        <hr class="mt-2 w-60 h-0.5 bg-gray-100 border-0 rounded dark:bg-gray-700">
                        <div class="text-right pr-5">
                            {{ round($weatherData['main']['temp']) }}°C <br />
                            Feels like {{ round($weatherData['main']['feels_like']) }}°C <br />
                        </div>
                        <div class="flex items-center justify-left">
                            <svg class="h-8 w-8 text-black" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <path d="M12 3l5 5a7 7 0 1 1 -10 0l5 -5" />
                            </svg>
                            {{ $weatherData['main']['humidity'] }}%
                        </div>
                        <div class="flex items-center justify-left">
                            <svg class="h-8 w-8 text-black" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <path d="M5 8h8.5a2.5 2.5 0 1 0 -2.34 -3.24" />
                                <path d="M3 12h15.5a2.5 2.5 0 1 1 -2.34 3.24" />
                                <path d="M4 16h5.5a2.5 2.5 0 1 1 -2.34 3.24" />
                            </svg>
                            {{ $weatherData['wind']['speed'] }}m/s
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- CARD 0 - to display the upcoming weather -->
        @if (isset($futureWeatherData))
            <div class="col-start-2 col-span-2 rounded overflow-hidden bg-white shadow-lg">
                <div class="px-6 py-4 text-center">
                    <div class="mt-5 text-2xl font-bold text-center">
                        {{ \Carbon\Carbon::parse($futureWeatherData['list'][0]['dt_txt'])->format('g A') }}
                    </div>
                    <div>
                        <img class="h-auto max-w-lg mx-auto"
                            src="https://openweathermap.org/img/wn/{{ $futureWeatherData['list'][0]['weather'][0]['icon'] }}@2x.png">
                    </div>
                    <div class="text-xl text-center">
                        {{ $futureWeatherData['list'][0]['weather'][0]['description'] }} <br />
                        {{ round($futureWeatherData['list'][0]['main']['temp']) }}°C <br />
                    </div>
                </div>
            </div>

            <!-- CARD 1 - to display the upcoming weather -->
            <div class="col-start-4 col-span-2 rounded overflow-hidden bg-white shadow-lg">
                <div class="py-6 text-center">
                    <div class="mt-5 text-2xl font-bold text-center">
                        {{ \Carbon\Carbon::parse($futureWeatherData['list'][1]['dt_txt'])->format('g A') }}
                    </div>
                    <div>
                        <img class="h-auto max-w-lg mx-auto"
                            src="https://openweathermap.org/img/wn/{{ $futureWeatherData['list'][1]['weather'][0]['icon'] }}@2x.png">
                    </div>
                    <div class="text-xl text-center">
                        {{ $futureWeatherData['list'][1]['weather'][0]['description'] }} <br />
                        {{ round($futureWeatherData['list'][1]['main']['temp']) }}°C <br />
                    </div>
                </div>
            </div>

            <!-- CARD 2 - to display the upcoming weather -->
            <div class="col-start-6 col-span-2 rounded overflow-hidden bg-white shadow-lg">
                <div class="px-6 py-4 text-center">
                    <div class="mt-5 text-2xl font-bold text-center">
                        {{ \Carbon\Carbon::parse($futureWeatherData['list'][2]['dt_txt'])->format('g A') }}
                    </div>
                    <div>
                        <img class="h-auto max-w-lg mx-auto"
                            src="https://openweathermap.org/img/wn/{{ $futureWeatherData['list'][2]['weather'][0]['icon'] }}@2x.png">
                    </div>
                    <div class="text-xl text-center">
                        {{ $futureWeatherData['list'][2]['weather'][0]['description'] }} <br />
                        {{ round($futureWeatherData['list'][2]['main']['temp']) }}°C <br />
                    </div>
                </div>
            </div>

            <!-- CARD 3 - to display the upcoming weather -->
            <div class="col-start-8 col-span-2 rounded overflow-hidden bg-white shadow-lg">
                <div class="px-6 py-4 text-center">
                    <div class="mt-5 text-2xl font-bold text-center">
                        {{ \Carbon\Carbon::parse($futureWeatherData['list'][3]['dt_txt'])->format('g A') }}
                    </div>
                    <div>
                        <img class="h-auto max-w-lg mx-auto"
                            src="https://openweathermap.org/img/wn/{{ $futureWeatherData['list'][3]['weather'][0]['icon'] }}@2x.png">
                    </div>
                    <div class="text-xl text-center">
                        {{ $futureWeatherData['list'][3]['weather'][0]['description'] }} <br />
                        {{ round($futureWeatherData['list'][3]['main']['temp']) }}°C <br />
                    </div>
                </div>
            </div>
        @endif
    </div>
</body>

</html>