@extends('layouts.vimexx')
@section('content')
<body class="min-h-screen bg-cover bg-center bg-blue-100" style="background-image: url('https://attractiestats.nl/img/bg.png'); background-attachment: fixed;">

    @include('layouts.navigation')

    <div class="max-w-6xl mx-auto p-6">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-6">🛠️ Ingediende Attractie Suggesties</h2>

        @if(session('success'))
            <div class="bg-green-700 text-white px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-600 text-white px-4 py-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if($suggestions->isEmpty())
            <div class="text-center text-gray-600 dark:text-gray-300">
                Er zijn momenteel geen suggesties.
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($suggestions as $suggestion)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4 flex flex-col justify-between h-full border border-gray-200 dark:border-gray-700">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-1">
                                {{ $suggestion->name }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mb-1">
                                <strong>Park:</strong> {{ $suggestion->park->name ?? 'Onbekend' }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mb-1">
                                <strong>Type:</strong> {{ $suggestion->type->name }}
                            </p>

                            @if($suggestion->photo_path)
                                <img src="{{ asset('storage/' . $suggestion->photo_path) }}"
                                     alt="Foto van {{ $suggestion->name }}"
                                     class="mt-3 rounded w-full h-40 object-cover border border-gray-300 dark:border-gray-600">
                            @endif
                        </div>

                        <div class="mt-4 flex justify-between gap-4 items-center">
                            <a href="{{ route('admin.suggestions.edit', $suggestion->id) }}"
                               class="text-blue-600 dark:text-blue-400 font-medium hover:underline">
                                ✏️ Bewerken
                            </a>

                            <form action="{{ route('admin.suggestions.approve', $suggestion->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 transition">
                                    ✅
                                </button>
                            </form>

                            <form action="{{ route('admin.suggestions.reject', $suggestion->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition">
                                    ❌
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
@endsection
