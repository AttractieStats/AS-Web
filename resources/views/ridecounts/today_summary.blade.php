
<div class="container">
    <h1 class="text-green-500 text-xl font-bold mb-4">Ritjes Vandaag</h1>
    <table class="table-auto w-full border-collapse border border-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="border border-gray-300 px-4 py-2">Attractie</th>
                <th class="border border-gray-300 px-4 py-2">Type</th>
                <th class="border border-gray-300 px-4 py-2">Aantal Keer</th>
                <th class="border border-gray-300 px-4 py-2">Eerste Ritje Tijd</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rides as $ride)
                <tr class="odd:bg-white even:bg-gray-50">
                    <td class="border border-gray-300 px-4 py-2">{{ $ride['attraction'] }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $ride['type'] }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $ride['count'] }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $ride['time']->format('H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center border border-gray-300 px-4 py-2">
                        Geen ritjes vandaag.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


<div class="flex justify-between mb-4">
    <a href="{{ route('ridecounts.summary', ['date' => \Carbon\Carbon::parse($selectedDate)->subDay()->toDateString()]) }}"
       class="bg-gray-800 text-white p-2 rounded">← Vorige Dag</a>
    <a href="{{ route('ridecounts.summary', ['date' => \Carbon\Carbon::parse($selectedDate)->addDay()->toDateString()]) }}"
       class="bg-gray-800 text-white p-2 rounded">Volgende Dag →</a>
</div>
