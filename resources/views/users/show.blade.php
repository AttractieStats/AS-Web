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

<div class="max-w-3xl mx-auto p-6 bg-white dark:bg-gray-800 shadow-xl mt-[50px] rounded-xl">
    <div class="flex items-center gap-6 mb-6">
        @if($user->profile_photo)
            <img src="{{ asset('storage/' . $user->profile_photo) }}" class="w-24 h-24 rounded-full object-cover">
        @else
            <div class="w-24 h-24 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center text-gray-500 text-3xl">
                ?
            </div>
        @endif

        <div>
            <h2 class="text-3xl font-bold flex items-center gap-2 text-gray-800 dark:text-white">
    {{ $user->name }}
    @if($user->role_id === 1)
        <span class="px-2 py-1 text-xs font-semibold bg-red-600 text-white rounded-full">👑 Admin</span>
    @elseif($user->role_id === 3)
        <span class="px-2 py-1 text-xs font-semibold bg-[#bab373] text-black rounded-full">⭐ Contributor</span>
    @endif
</h2>

            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $user->country ?? 'Geen land opgegeven' }}</p>
@if($user->favoritePark)
    <p class="mt-2 text-sm text-blue-500">🎢 Favoriet park: {{ $user->favoritePark->name }}</p>
@endif

            <p class="text-sm mt-1 text-gray-700 dark:text-gray-300">🧑‍🤝‍🧑 Vrienden: {{ $user->friends()->count() }}</p>
        </div>
    </div>

    <div class="mt-4">
@php
    $authUserId = auth()->id();

    $existingFriendship = \App\Models\Friend::where(function ($query) use ($authUserId, $user) {
        $query->where('user_id', $authUserId)
              ->where('friend_id', $user->id);
    })->orWhere(function ($query) use ($authUserId, $user) {
        $query->where('user_id', $user->id)
              ->where('friend_id', $authUserId);
    })->first();
@endphp

@if($existingFriendship && $existingFriendship->accepted == 1)
    <p class="text-green-600 font-semibold mt-2">✅ Jullie zijn vrienden</p>
@elseif($existingFriendship && $existingFriendship->accepted == 0)
    <p class="text-yellow-500 font-semibold mt-2">⏳ Vriendschapsverzoek verstuurd</p>
@elseif(auth()->id() !== $user->id)
    <form action="{{ route('friends.sendRequest', $user) }}" method="POST" class="mt-2">
        @csrf
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            ➕ Vriend toevoegen
        </button>
    </form>
@endif


    </div>

    <div class="mt-6">
        <h3 class="text-xl font-semibold mb-3 text-gray-700 dark:text-gray-300">📄 Over</h3>
        <p class="text-gray-800 dark:text-gray-200">{{ $user->bio ?? 'Geen bio ingevuld.' }}</p>
    </div>
</div>
