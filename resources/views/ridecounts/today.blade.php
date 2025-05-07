@foreach ($rideCounts as $ride)
<li class="flex items-start">
    <div class="text-gray-300 text-sm w-12 flex-shrink-0">{{ $ride->created_at->format('H:i') }}</div>
    <div class="flex-1 pl-4 border-l-2 border-green-500">
        <p class="text-green-500 font-semibold">{{ $ride->attraction->name }}</p>
        <p class="text-gray-400 text-sm">{{ $ride->attraction->type }}</p>
    </div>
</li>
@endforeach
