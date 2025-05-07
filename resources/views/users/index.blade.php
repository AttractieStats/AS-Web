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

<div class="max-w-5xl mx-auto p-6 bg-white dark:bg-gray-800 mt-[50px] shadow-xl rounded-xl">
    <h2 class="text-3xl font-bold mb-6 text-gray-800 dark:text-white">👥 Gebruikers</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($users as $user)
            <a href="{{ route('users.show', $user) }}" class="block bg-gray-100 dark:bg-gray-700 p-4 rounded-lg hover:shadow-md transition">
                <div class="flex items-center gap-4">
                    @if($user->profile_photo)
                        <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}" class="w-14 h-14 rounded-full object-cover">
                    @else
                        <div class="w-14 h-14 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center text-gray-500">
                            ?
                        </div>
                    @endif
                    <div>
                        <p class="font-bold text-lg text-gray-800 dark:text-white">{{ $user->name }}</p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>
