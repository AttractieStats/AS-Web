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

<div class="container mx-auto mt-[20px] p-6">
    <h1 class="text-3xl font-bold mb-6 text-white">{{ $user->name }}'s Ritjes</h1>

    <div class="bg-[#1E1E1E] p-6 rounded-lg shadow-lg">
        <table class="min-w-full text-white table-auto">
            <thead class="bg-gray-800">
                <tr>
                    <th class="px-6 py-3 text-left">Attractie</th>
                    <th class="px-6 py-3 text-left">Aantal Ritjes</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rideCounts as $ride)
                    <tr class="border-t border-gray-700 hover:bg-gray-800">
                        <td class="px-6 py-3">{{ $ride->attraction->name }}</td>
                        <td class="px-6 py-3">{{ $ride->count }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-6 py-3" colspan="2">Geen ritjes gevonden.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        <a href="{{ route('admin.users.index') }}" class="inline-block px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300">
            ← Terug naar gebruikers
        </a>
    </div>
</div>
