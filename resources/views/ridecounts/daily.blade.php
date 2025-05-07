<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Ritjes op {{ $date }}</h1>
    <p class="text-lg mb-4">Totaal aantal ritjes: <span class="font-semibold">{{ $totalRides }}</span></p>

    <ul class="list-disc pl-5 mb-4">
        @foreach ($dailyCounts as $ride)
            <li class="mb-2">
                <span class="font-medium">Attractie ID:</span> {{ $ride->ride_id }} - 
                <span class="font-medium">Aantal ritjes:</span> {{ $ride->count }} - 
                <span class="font-medium">Tijd:</span> {{ $ride->created_at->format('H:i') }}
            </li>
        @endforeach
    </ul>
</div>
