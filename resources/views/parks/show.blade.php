@extends('layouts.vimexx')
@section('content')
{{--    'park', 'attractions', 'doneAttractions', 'totalRides'  --}}
    @livewire('park-show', ['park' => $park,'attractions'=> $attractions, 'doneAttractions'=>$doneAttractions,'totalRides'=>$totalRides])
@endsection
