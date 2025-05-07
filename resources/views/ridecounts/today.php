@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ritjes vandaag</h1>
    <ul>
        @forelse ($rideCounts as $ride)
            <li>{{ $ride->attraction_name }} om {{ $ride->created_at->format('H:i') }}</li>
        @empty
            <li>Geen ritjes vandaag.</li>
        @endforelse
    </ul>
</div>
@endsection
