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
            @foreach ($parks as $park)
                @php
                    $doneAttractions = $park->attractions->filter(function ($attraction) {
                        return $attraction->ridecounts->sum('count') > 0;
                    });
                @endphp

                <li 
                    x-show="{{ json_encode(Str::lower($park->name)) }}.includes(search.toLowerCase())"
                >
                    <a href="{{ route('parks.show', $park) }}"
                       class="block bg-white bg-opacity-90 p-6 rounded-lg shadow-lg hover:shadow-xl hover:bg-opacity-100 transition duration-300 ease-in-out transform hover:-translate-y-1"
                    >
                        <h2 class="text-xl font-bold mb-2 text-gray-800">
                            {{ $park->name }}
                        </h2>
                        <p class="text-gray-600 mb-1">
                            Aantal attracties: {{ $park->attractions->count() }}
                        </p>
                        <p class="text-gray-600">
                            Actieve attracties (met ritten): {{ $doneAttractions->count() }}
                        </p>
                    </a>
                </li>
            @endforeach
        </ul>

        @if ($parks->isEmpty())
            <p class="text-center text-white mt-10">Er zijn momenteel geen parken beschikbaar.</p>
        @endif
    </div>
</body>
@endsection
