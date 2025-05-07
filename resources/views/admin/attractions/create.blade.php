<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-gray-200">
    @include('layouts.navigation')
    <div class="container mx-auto p-6 bg-gray-800 shadow-md rounded-lg mt-10">
        <h1 class="text-3xl font-bold mb-6 text-gray-100">Add New Attraction</h1>
        <form action="{{ isset($attraction) ? route('admin.attractions.update', $attraction) : route('admin.attractions.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">

        @if ($errors->any())
    <div class="mb-4">
        <ul class="list-disc list-inside text-red-500">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


            @csrf
            @if(isset($attraction))
                @method('PUT')
            @endif
        
            <div class="flex flex-col">
                <label for="name" class="mb-2 font-semibold text-gray-300">Naam:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $attraction->name ?? '') }}" required class="p-2 border border-gray-600 rounded-md bg-gray-700 text-gray-200">
            </div>
        
            <div class="flex flex-col">
                <label for="type" class="mb-2 font-semibold text-gray-300">Type:</label>
                <div class="space-y-2">
                    @foreach($types as $type)
    <label class="inline-flex items-center">
        <input type="radio" name="type_id" value="{{ $type->id }}" {{ old('type_id', $attraction->type_id ?? '') == $type->id ? 'checked' : '' }} class="form-radio text-blue-600">
        <span class="ml-2">{{ $type->name }}</span>
    </label>
@endforeach

                </div>
            </div>
        
            <div class="flex flex-col">
                <label for="park_id" class="mb-2 font-semibold text-gray-300">Park:</label>
                <select id="park_id" name="park_id" required class="p-2 border border-gray-600 rounded-md bg-gray-700 text-gray-200">
                    @foreach($parks as $park)
                        <option value="{{ $park->id }}" {{ old('park_id', $attraction->park_id ?? '') == $park->id ? 'selected' : '' }}>{{ $park->name }}</option>
                    @endforeach
                </select>
            </div>
        
            <div class="flex flex-col">
                <label for="image" class="mb-2 font-semibold text-gray-300">Afbeelding:</label>
                <input type="file" id="image" name="image" accept="image/*" class="p-2 border border-gray-600 rounded-md bg-gray-700 text-gray-200">
                @if(isset($attraction->image_path))
                    <img src="{{ asset('storage/' . $attraction->image_path) }}" alt="Afbeelding van {{ $attraction->name }}" class="mt-4 max-w-xs rounded-md shadow-md">
                @endif
            </div>
        
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600">Opslaan</button>
        </form>
    </div>
</body>
</html>
