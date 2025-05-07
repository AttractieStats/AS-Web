<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('suggestion.title') }} - AttractieStats</title>
    <link rel="preload" as="image" href="https://attractiestats.nl/img/bg.png">
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-cover bg-center bg-blue-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100"
      style="background-image: url('https://attractiestats.nl/img/bg.png'); background-attachment: fixed;">

    @include('layouts.navigation')

    <div class="max-w-2xl mx-auto p-6 mt-10 bg-white dark:bg-gray-800 shadow-lg rounded-2xl backdrop-blur-sm bg-opacity-90 dark:bg-opacity-90">
        <h2 class="text-3xl font-bold mb-6 text-gray-800 dark:text-white">🎢 {{ __('suggestion.title') }}</h2>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-600 text-white rounded">
                {{ session('success') }}
            </div>
            <script>
                window.onload = () => {
                    const lastSelected = "{{ session('last_park_id') }}";
                    if (lastSelected) {
                        window.location.href = "{{ route('suggestions.create') }}?park_id=" + lastSelected;
                    }
                };
            </script>
        @endif

        @if($errors->any())
            <div class="mb-4 p-4 bg-red-600 text-white rounded">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('suggestions.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block mb-1 font-semibold">{{ __('suggestion.name') }}</label>
                <input type="text" name="name" id="name"
                       value="{{ old('name') }}"
                       class="w-full p-3 border border-gray-300 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-700 text-black dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
            </div>

            <div>
                <label for="type_id" class="block mb-1 font-semibold">{{ __('suggestion.type') }}</label>
                <select name="type_id" id="type_id"
                        class="w-full p-3 border border-gray-300 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-700 text-black dark:text-white"
                        required>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}"
                            {{ old('type_id') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="park_id" class="block mb-1 font-semibold">{{ __('suggestion.park') }}</label>
                <select name="park_id" id="park_id"
                        class="w-full p-3 border border-gray-300 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-700 text-black dark:text-white"
                        required>
                    <option value="">{{ __('suggestion.choose_park') }}</option>
                    @foreach($parks as $park)
                        <option value="{{ $park->id }}"
                            {{ old('park_id', $selectedParkId ?? '') == $park->id ? 'selected' : '' }}>
                            {{ $park->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="photo" class="block mb-1 font-semibold">{{ __('suggestion.photo') }}
                    <span class="text-sm text-gray-400">({{ __('suggestion.optional') }})</span></label>
                <input type="file" name="photo" id="photo"
                       class="w-full p-3 border border-gray-300 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-700 text-black dark:text-white">
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition">
                {{ __('suggestion.submit') }}
            </button>
        </form>
    </div>
</body>
</html>
