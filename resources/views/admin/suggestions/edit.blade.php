<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suggestie Bewerken - AttractieStats</title>
    <link rel="preload" as="image" href="https://attractiestats.nl/img/bg.png">
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-cover bg-center bg-blue-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100"
      style="background-image: url('https://attractiestats.nl/img/bg.png'); background-attachment: fixed;">

    @include('layouts.navigation')

    <div class="max-w-xl mx-auto p-4 bg-white dark:bg-gray-800 shadow rounded mt-10">
        <h2 class="text-2xl font-bold mb-4">Suggestie Bewerken</h2>

        {{-- Validatie errors --}}
        @if ($errors->any())
            <div class="bg-red-600 text-white p-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.suggestions.update', $suggestion->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block mb-1 font-semibold">Naam</label>
                <input type="text" name="name" value="{{ old('name', $suggestion->name) }}"
                       class="w-full p-2 border rounded bg-gray-50 dark:bg-gray-700 text-black dark:text-white" required>
            </div>

            <div>
                <label for="type_id" class="block mb-1 font-semibold">Type</label>
                <select name="type_id" class="w-full p-2 border rounded bg-gray-50 dark:bg-gray-700 text-black dark:text-white" required>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}" {{ $suggestion->type_id == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="park_id" class="block mb-1 font-semibold">Park</label>
                <select name="park_id" class="w-full p-2 border rounded bg-gray-50 dark:bg-gray-700 text-black dark:text-white" required>
                    @foreach($parks as $park)
                        <option value="{{ $park->id }}" {{ $suggestion->park_id == $park->id ? 'selected' : '' }}>
                            {{ $park->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-between gap-4 mt-6">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    💾 Opslaan
                </button>

                <form action="{{ route('admin.suggestions.approve', $suggestion->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                        ✅ Goedkeuren
                    </button>
                </form>
            </div>
        </form>
    </div>
</body>
</html>
