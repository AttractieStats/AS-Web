@extends('layouts.vimexx')
@section('content')
<body class="min-h-screen bg-cover bg-center bg-blue-100" style="background-image: url('https://attractiestats.nl/img/bg.png'); background-attachment: fixed;">

    @include('layouts.navigation')

<div class="max-w-4xl mx-auto p-6 bg-white dark:bg-gray-800 mt-[50px] rounded-xl shadow">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">👥 Mijn Vrienden</h2>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-600 text-white rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-3 bg-red-600 text-white rounded">
            {{ session('error') }}
        </div>
    @endif

    <div class="mb-8">
        <h3 class="text-xl font-semibold mb-3 text-gray-700 dark:text-gray-300">📥 Vriendschapsverzoeken</h3>
        @forelse($requests as $request)
            <div class="flex justify-between items-center bg-gray-100 dark:bg-gray-700 p-4 rounded mb-2">
                <span>{{ $request->sender->name }}</span>
                <div class="flex gap-2">
                    <form method="POST" action="{{ route('friends.accept', $request->sender->id) }}">
                        @csrf
                        <button class="bg-green-500 text-white px-3 py-1 rounded">Accepteren</button>
                    </form>
                    <form method="POST" action="{{ route('friends.reject', $request->sender->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 text-white px-3 py-1 rounded">Weigeren</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-500 dark:text-gray-400">Geen nieuwe verzoeken.</p>
        @endforelse
    </div>

    <div>
        <h3 class="text-xl font-semibold mb-3 text-gray-700 dark:text-gray-300">✅ Vriendenlijst</h3>
        @forelse($friends as $friend)
            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded mb-2">
                {{ $friend->receiver->id === auth()->id() ? $friend->sender->name : $friend->receiver->name }}
            </div>
        @empty
            <p class="text-gray-500 dark:text-gray-400">Je hebt nog geen vrienden.</p>
        @endforelse
    </div>
</div>
@endsection
