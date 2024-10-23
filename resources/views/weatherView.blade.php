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

<body>
    <div class="flex justify-center align-middle m-10 mt-20">
        <!-- card -->
        <div class="rounded overflow-hidden outline">
            <div class="px-6 py-4">
                <form action="{{url('/')}}" method="post">
                    @csrf
                    <label class="block text-black text-lg font-bold mb-2" for="location">
                        Enter Your Location
                    </label>
                    <input class=" appearance-none border rounded py-2 px-3 text-black leading-tight" id="location"
                        type="text" name="location" placeholder="location">
                    <button
                        class="bg-transparent hover:bg-black text-black font-semibold hover:text-white py-2 px-3 border border-black hover:border-transparent rounded">
                        Confirm Location
                    </button>
                </form>
                @if (isset($weatherData))
                    <div class="m-10 text-lg font-bold">
                        The weather in {{ $weatherData['name'] }} is currently
                        {{ $weatherData['weather'][0]['description'] }},
                        with temperatures of {{ $weatherData['main']['temp'] }} °C.
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>

</html>