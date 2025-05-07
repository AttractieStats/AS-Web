@extends('layouts.vimexx')
@section('content')
<body class="min-h-screen bg-gradient-to-br from-blue-100 to-purple-100 dark:from-gray-900 dark:to-gray-800 text-gray-900 dark:text-gray-100">
    @include('layouts.navigation')

    <div class="max-w-5xl mx-auto p-6 mt-10 bg-white dark:bg-gray-800 shadow-2xl rounded-2xl">
        <h2 class="text-4xl font-extrabold mb-8 text-center">👤 {{ __('profile.my_profile') }}</h2>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-600 text-white rounded-lg text-center">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-4 bg-red-600 text-white rounded-lg">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Profiel Preview -->
        <div class="mb-10 p-6 rounded-xl bg-gray-100 dark:bg-gray-700 shadow-inner flex flex-col md:flex-row items-center md:items-start gap-6">
            <div class="flex flex-col items-center">
                @if(auth()->user()->profile_photo)
                    <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" class="w-28 h-28 rounded-full object-cover border-4 border-blue-400">
                @else
                    <div class="w-28 h-28 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center text-gray-500 font-bold">
                        {{ __('profile.no_photo') }}
                    </div>
                @endif
            </div>

            <div class="flex-1 text-center md:text-left">
                <h3 class="text-2xl font-bold flex items-center gap-2">
                    {{ auth()->user()->name }}
                    @if(auth()->user()->role_id === 1)
                        <span class="px-2 py-1 text-xs font-semibold bg-red-600 text-white rounded-full">👑 Admin</span>
                    @elseif(auth()->user()->role_id === 2)
                        <span class="px-2 py-1 text-xs font-semibold bg-blue-600 text-white rounded-full">👤 {{ __('roles.user') }}</span>
                    @elseif(auth()->user()->role_id === 3)
                        <span class="px-2 py-1 text-xs font-semibold bg-[#bab373] text-black rounded-full">⭐ {{ __('roles.contributor') }}</span>
                    @endif
                </h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ auth()->user()->country ?? __('profile.no_country') }}</p>
                <p class="mt-2 text-sm italic text-gray-700 dark:text-gray-300">{{ auth()->user()->bio ?? __('profile.no_bio') }}</p>
                @if(auth()->user()->favorite_park_id)
                    <p class="mt-2 text-sm text-blue-500">🎢 {{ __('profile.favorite_park') }}: {{ $parks->firstWhere('id', auth()->user()->favorite_park_id)?->name }}</p>
                @endif
            </div>

            <!-- Achievements venster -->
            <div class="w-full md:w-40 mt-6 md:mt-0">
                <div class="p-4 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-800 text-center">
                    <h4 class="font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">🏅 {{ __('profile.medals') }}</h4>
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('profile.coming_soon') }}</p>
                </div>
            </div>
        </div>

        <!-- Formulier -->
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="language" class="block font-semibold mb-2">{{ __('profile.language') }}</label>
                    <select name="language" id="language" class="w-full p-3 rounded-lg border border-gray-300 bg-gray-50 dark:bg-gray-700">
                        <option value="nl" {{ auth()->user()->language == 'nl' ? 'selected' : '' }}>🇳🇱 Nederlands</option>
                        <option value="en" {{ auth()->user()->language == 'en' ? 'selected' : '' }}>🇬🇧 English</option>
                        <option value="de" {{ auth()->user()->language == 'de' ? 'selected' : '' }}>🇩🇪 Deutsch</option>
                    </select>
                </div>

                <div>
                    <label for="country" class="block font-semibold mb-2">{{ __('profile.country') }}</label>
                    <input type="text" id="country" name="country" value="{{ old('country', auth()->user()->country) }}" class="w-full p-3 rounded-lg border border-gray-300 bg-gray-50 dark:bg-gray-700">
                </div>

                <div class="md:col-span-2">
                    <label for="favorite_park_id" class="block font-semibold mb-2">{{ __('profile.favorite_park') }}</label>
                    <select name="favorite_park_id" id="favorite_park_id" class="w-full p-3 rounded-lg border border-gray-300 bg-gray-50 dark:bg-gray-700">
                        <option value="">-- {{ __('profile.none') }} --</option>
                        @foreach($parks as $park)
                            <option value="{{ $park->id }}" {{ auth()->user()->favorite_park_id == $park->id ? 'selected' : '' }}>{{ $park->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label for="bio" class="block font-semibold mb-2">{{ __('profile.about_me') }}</label>
                <textarea id="bio" name="bio" rows="4" class="w-full p-3 rounded-lg border border-gray-300 bg-gray-50 dark:bg-gray-700">{{ old('bio', auth()->user()->bio) }}</textarea>
            </div>

            <div>
                <label class="block font-semibold mb-2">{{ __('profile.profile_photo') }} <span class="text-sm text-gray-500">(max 2 MB)</span></label>
                <input type="file" name="profile_photo" accept="image/*" class="w-full p-3 rounded-lg border border-gray-300 bg-gray-50 dark:bg-gray-700">
                @if(auth()->user()->profile_photo)
                    <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" class="mt-4 w-24 h-24 rounded-full object-cover">
                @endif
            </div>

            <div class="text-center">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition">
                    💾 {{ __('profile.save') }}
                </button>
            </div>
        </form>
    </div>
</body>
@endsection
