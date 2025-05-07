<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-cover bg-center bg-blue-100" style="background-image: url('https://attractiestats.nl/img/bg.png'); background-attachment: fixed;">
    @include('layouts.navigation')

    <div class="container mx-auto mt-6 p-6 bg-[#1E1E1E] shadow-md rounded-lg">
        <h1 class="text-3xl font-bold mb-6 text-white text-center">{{ $attraction->name }}</h1>

        <div class="flex flex-col md:flex-row gap-8 items-center md:items-start">
            <!-- Afbeelding -->
            <div class="flex-shrink-0">
                @if($attraction->image_path)
                    <div class="w-72 h-72 rounded-3xl bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $attraction->image_path) }}');"></div>
                @else
                    <div class="w-72 h-72 rounded-3xl bg-gray-700 flex items-center justify-center text-gray-400">
                        Geen afbeelding
                    </div>
                @endif
            </div>

            <!-- Informatie -->
            <div class="text-white space-y-4 text-center md:text-left">
                <p><strong>Type:</strong> {{ $attraction->type }}</p>
                <p><strong>Park:</strong> {{ $attraction->park->name }}</p>
                <p><strong>Locatie:</strong> {{ $attraction->park->location }}</p>
                @if($attraction->type == 'Show')
                    <p><strong>Aantal shows bekeken:</strong> {{ $attraction->rideCounts->where('user_id', auth()->id())->first()->count ?? 0 }}</p>
                @else
                    <p><strong>Aantal ritjes:</strong> {{ $attraction->rideCounts->where('user_id', auth()->id())->first()->count ?? 0 }}</p>
                @endif
            </div>
        </div>

        <div class="flex justify-center md:justify-start mt-8">
            <a href="{{ url()->previous() }}" class="inline-block px-6 py-3 text-white bg-blue-500 rounded-lg hover:bg-blue-600 transition">
                ← Terug naar vorige pagina
            </a>
        </div>
    </div>

</body>
</html>
