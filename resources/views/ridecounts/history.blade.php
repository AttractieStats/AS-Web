<table class="table-auto w-full border-collapse border border-gray-200">
    <thead class="bg-gray-100">
        <tr>
            <th class="border border-gray-300 px-4 py-2">Datum</th>
            <th class="border border-gray-300 px-4 py-2">Aantal Ritjes</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($history as $day)
            <tr class="odd:bg-white even:bg-gray-50">
                <td class="border border-gray-300 px-4 py-2">{{ $day->date }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $day->total }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="2" class="border border-gray-300 px-4 py-2 text-center">Geen geschiedenis beschikbaar.</td>
            </tr>
        @endforelse
    </tbody>
</table>
