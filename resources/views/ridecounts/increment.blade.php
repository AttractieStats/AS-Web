@extends('layouts.vimexx')
@section('content')
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-center">Add a Ride Count</h1>

        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('ridecounts.increment') }}" class="space-y-6 bg-white p-6 rounded-lg shadow-md">
            @csrf

            <div>
                <label for="attraction_id" class="block text-sm font-medium text-gray-700">Select Attraction:</label>
                <select name="attraction_id" id="attraction_id" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @foreach ($attractions as $attraction)
                        <option value="{{ $attraction->id }}">{{ $attraction->name }} ({{ $attraction->park->name }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-600">
                    Add Ride Count
                </button>
            </div>
        </form>
    </div>
</body>
@endsection
