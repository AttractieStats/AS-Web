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

<div class="max-w-xl mx-auto p-4 bg-white dark:bg-gray-800 shadow rounded">
    <h2 class="text-2xl font-bold mb-4">Suggestie Bewerken</h2>

    <form action="{{ route('admin.suggestions.update', $suggestion->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1 font-semibold" for="name">Naam</label>
            <input type="text" name="name" value="{{ $suggestion->name }}" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold" for="type_id">Type</label>
            <select name="type_id" class="w-full p-2 border rounded" required>
                @foreach($types as $type)
                    <option value="{{ $type->id }}" {{ $suggestion->type_id == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold" for="park">Park</label>
            <input type="text" name="park" value="{{ $suggestion->park }}" class="w-full p-2 border rounded" required>
        </div>

        <div class="flex justify-between">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Opslaan
            </button>
            <form action="{{ route('admin.suggestions.approve', $suggestion->id) }}" method="POST">
                @csrf
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Goedkeuren
                </button>
            </form>
        </div>
    </form>
</div>
