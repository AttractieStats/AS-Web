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
                       class="w-full max-w-md p-2 border border-gray-300 bg-[#1F1F1F] text-white rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                       onkeyup="filterAttractions()">
            </div><br>

            <!-- Attractielijst -->
            <ul id="attractions-list" class="space-y-4">
                @foreach ($attractions->sortBy('name') as $attraction)
                    <li class="bg-[#1E1E1E] p-4 rounded-lg shadow-md flex justify-between items-center">
                        <div class="flex items-center space-x-4">
                            @if($attraction->image_path)
                                <div class="max-w-[100px] min-w-[100px] max-h-[100px] min-h-[100px] rounded-[30px] bg-cover bg-center"
                                     style="background-image: url('{{ asset('storage/' . $attraction->image_path) }}');"></div>
                            @else
                                <div class="max-w-[100px] min-w-[100px] max-h-[100px] min-h-[100px] rounded-[30px] bg-cover bg-center"
                                     style="background-image: url('https://attractiestats.nl/img/geenfoto.jpg');"></div>
                            @endif
                            <a href="{{ route('admin.attractions.show', $attraction) }}">
                                <div class="flex flex-col">
                                    <p class="font-bold text-white">{{ $attraction->name }}</p>
                                    <p class="text-sm text-gray-300">{{ $attraction->type }}</p>
                                </div>
                            </a>
                        </div>

                        <div class="flex items-center space-x-4">
                            <!-- Ride count -->
                            @php
                                $rideCount = \App\Models\RideCount::where('attraction_id', $attraction->id)
                                   ->where('user_id', \Illuminate\Support\Facades\Auth::id())
                                   ->first();
                            @endphp
                            <span id="count-{{ $attraction->id }}" class="text-xl font-bold text-white" wire:poll="1s">
                                {{ $counts[$attraction->id] ?? 0 }}
                            </span>
                            <!-- + knop -->
                            <button wire:click="incrementRidecount( {{$attraction->id}} )"
                                    class="px-4 py-2 bg-[#BB86FC] text-white rounded-md hover:bg-[#7855a3]">
                                +
                            </button>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        </body>
</div>
