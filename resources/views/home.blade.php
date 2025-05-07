<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - AttractieStats</title>
    <link rel="preload" as="image" href="https://attractiestats.nl/img/bg.png">
@vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-cover bg-center bg-blue-100" style="background-image: url('https://attractiestats.nl/img/bg.png'); background-attachment: fixed;">
    
    @include('layouts.navigation')

<div class="flex justify-center mt-[50px] mx-[20px]">
    <div class="bg-white bg-opacity-80 p-8 rounded-xl shadow-lg max-w-2xl w-full text-center">
        <h1 class="text-4xl font-bold text-blue-600 mb-6">{{ __('home.title') }}</h1>

<div class="flex flex-col md:flex-row justify-center gap-6 mb-10">
    <a href="http://discord.com/invite/WS4EM9ZakN" target="_blank" class="px-6 py-3 bg-purple-600 text-white rounded-lg font-semibold hover:bg-purple-700 transition">
        {{ __('home.discord') }}
    </a>
    <a href="{{ route('parks.index') }}" class="px-6 py-3 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-600 transition">
        {{ __('home.parks') }}
    </a>
</div>

<h2 class="text-2xl font-bold text-gray-800 mb-6">{{ __('home.future') }}</h2>
<ul class="text-left space-y-3">
    @foreach(__('home.features') as $feature)
        <li class="flex items-center gap-3">
            <span class="w-3 h-3 rounded-full bg-yellow-400 flex-shrink-0"></span>
            <span>{{ $feature }}</span>
        </li>
    @endforeach
</ul>



    </div>

</body>
</html>
