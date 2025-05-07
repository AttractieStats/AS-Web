<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#121212]">
@include('layouts.navigation')
<div class="container mx-auto p-6 bg-[#1E1E1E] shadow-md rounded-lg">
    <h1 class="text-3xl font-bold mb-6 text-white">Manage Attractions</h1>
    <a href="{{ route('admin.attractions.create') }}" class="inline-block mb-4 px-6 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition duration-300">Add New Attraction</a>
    <div class="overflow-x-auto">
        <table class="table-auto w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-left text-gray-600">Name</th>
                    <th class="px-4 py-2 text-left text-gray-600">Type</th>
                    <th class="px-4 py-2 text-left text-gray-600">Park</th>
                    <th class="px-4 py-2 text-left text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attractions->sortBy('name') as $attraction)
                    <tr class="border-b hover:bg-gray-100 transition duration-300">
                        <td class="border px-4 py-2">{{ $attraction->name }}</td>
                        <td class="border px-4 py-2">{{ $attraction->type }}</td>
                        <td class="border px-4 py-2">{{ $attraction->park->name }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('admin.attractions.edit', $attraction) }}" class="text-blue-500 hover:text-blue-700 transition duration-300">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
