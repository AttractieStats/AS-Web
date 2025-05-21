<div>
    <body class="h-screen justify-center bg-cover bg-center" style="background-image: url('https://attractiestats.nl/img/bg.png'); background-attachment: fixed;">
    @include('layouts.navigation')

    <div class="container mx-auto p-6">
        <!-- Titel + knop naast elkaar -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
            <h1 class="text-3xl font-bold text-white">
                {{ __('park.attractions_title', ['park' => $park->name]) }}
            </h1>

            <a href="{{ route('suggestions.create', ['park_id' => $park->id]) }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition whitespace-nowrap">
                {{ __('park.suggestion') }}
            </a>
        </div>

        <!-- Zoekveld -->
        <div class="mt-6 flex justify-center">
            <input type="text" id="search"
                   placeholder="{{ __('park.search_placeholder') }}"
                   class="w-full max-w-md p-3 border border-gray-700 bg-[#2A2A2A] text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   onkeyup="filterAttractions()">
        </div><br>

        <!-- Attractielijst als moderne lijst -->
        <div id="attractions-list" class="space-y-5 mt-6">
            @foreach ($attractions->sortBy('name') as $attraction)
                <div class="flex flex-col md:flex-row items-center bg-[#1E1E1E] rounded-xl shadow-md hover:shadow-lg transition p-4 gap-4">
                    <!-- Afbeelding -->
                    <div class="w-full md:w-[120px] h-[120px] bg-cover bg-center rounded-xl shrink-0"
                         style="background-image: url('{{ $attraction->image_path ? asset('storage/' . $attraction->image_path) : 'https://attractiestats.nl/img/geenfoto.jpg' }}');">
                    </div>

                    <!-- Info & actie -->
                    <div class="flex-1 flex flex-col md:flex-row justify-between w-full gap-4">
                        <a href="{{ route('admin.attractions.show', $attraction) }}" class="flex-1">
                            <h2 class="text-xl font-semibold text-white">{{ $attraction->name }}</h2>
                            <p class="text-gray-400">{{ $attraction->type }}</p>
                        </a>

                        <div class="flex items-center gap-4">
                            <span id="count-{{ $attraction->id }}" class="text-white text-lg font-bold">
                                {{ $counts[$attraction->id] ?? 0 }}
                            </span>
                            <button wire:click="incrementRidecount({{ $attraction->id }})"
                                    class="px-4 py-2 bg-[#BB86FC] text-white rounded-lg hover:bg-[#7855a3] transition">
                                +
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    </body>
</div>
