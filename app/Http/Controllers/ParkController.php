<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Park;
use Illuminate\Support\Facades\DB;

class ParkController extends Controller
{
    public function index()
    {
        $parks = Park::withCount('attractions')->get();

        foreach ($parks as $park) {
            $park->done_count = DB::table('ride_counts')
                ->join('attractions', 'ride_counts.attraction_id', '=', 'attractions.id')
                ->where('ride_counts.user_id', auth()->id())
                ->where('ride_counts.count', '>', 0)
                ->where('attractions.park_id', $park->id)
                ->select('ride_counts.attraction_id')
                ->distinct()
                ->count();
        }

        return view('parks.index', compact('parks')); // ✅ toevoegen
    }

public function show(Park $park)
{
    // Haal attracties op + alleen de ridecounts van de ingelogde gebruiker
    $attractions = $park->attractions()
        ->with(['rideCounts' => function ($query) {
            $query->where('user_id', auth()->id());
        }])
        ->get();

    // Bereken totaal aantal ritten en bezochte attracties in controller
    $totalRides = 0;
    $doneAttractions = 0;

    foreach ($attractions as $attraction) {
        $count = $attraction->rideCounts->sum('count');
        $totalRides += $count;
        if ($count > 0) {
            $doneAttractions++;
        }
    }

    return view('parks.show', compact('park', 'attractions', 'doneAttractions', 'totalRides'));
}

}
