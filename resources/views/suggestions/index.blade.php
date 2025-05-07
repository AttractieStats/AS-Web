@extends('layouts.vimexx')
@section('content')
<body class="min-h-screen bg-cover bg-center bg-blue-100" style="background-image: url('https://attractiestats.nl/img/bg.png'); background-attachment: fixed;">

    @include('layouts.navigation')

<div class="max-w-4xl mx-auto p-4 bg-white dark:bg-gray-800 shadow rounded">
    <h2 class="text-2xl font-bold mb-4">Attractie Suggesties</h2>

    @foreach($suggestions as $suggestion)
        <div class="border-b border-gray-300 py-4 flex justify-between items-center">
            <div>
                <p><strong>Naam:</strong> {{ $suggestion->name }}</p>
                <p><strong>Park:</strong> {{ $suggestion->park }}</p>
                <p><strong>Type:</strong> {{ $suggestion->type->name }}</p>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('admin.suggestions.edit', $suggestion->id) }}" class="text-blue-600 hover:underline">Bewerken</a>
                <form action="{{ route('admin.suggestions.approve', $suggestion->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="text-green-600 hover:underline">Goedkeuren</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection
