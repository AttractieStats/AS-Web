@extends('layouts.vimexx')

@section('content')
<body class="h-screen justify-center bg-cover bg-center" style="background-image: url('https://attractiestats.nl/img/bg.png'); background-attachment: fixed;">
    @include('layouts.navigation')

    <div class="container mx-auto p-6" x-data="{ search: '' }">
        <h1 class="text-4xl font-extrabold mb-6 text-center text-white">
            {{ __('parks.title') }}
        </h1>

        <div class="max-w-md mx-auto mb-8">
            <input
                type="text"
                x-model="search"
                placeholder="{{ __('parks.search_placeholder') }}"
                class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
        </div>

        <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($parks as $index => $park)
                @php
                    $doneAttractions = $park->attractions->filter(function ($attraction) {
                        return $attraction->ridecounts->sum('count') > 0;
                    })->count();
                @endphp

                <li
                    class="bg-white p-6 rounded-lg shadow-lg transform transition duration-500 opacity-0 translate-y-4"
                    x-show="{{ json_encode(strtolower($park->name)) }}.includes(search.toLowerCase())"
                    x-init="setTimeout(() => { $el.classList.remove('opacity-0'); $el.classList.remove('translate-y-4'); }, {{ $index * 75 }})"
                >
                    <a href="{{ route('parks.show', $park) }}" class="text-blue-600 font-bold text-xl hover:underline">
                        {{ $park->name }}
                    </a>
                    <p class="mt-2 text-gray-600">
                        {{ __('parks.location') }} {{ $park->location ?? __('parks.unknown') }}
                    </p>
                    <p class="mt-1 text-gray-800 font-semibold">
                        {{ __('parks.ride_count', ['done' => $doneAttractions, 'total' => $park->attractions_count]) }}
                    </p>
                </li>
            @endforeach
        </ul>
    </div>
</body>
@endsection
