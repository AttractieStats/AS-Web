<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RideCount;
use App\Models\Attraction;
use Carbon;


class RideCounterController extends Controller
{
    public function index()
    {
        $attractions = Attraction::with('park')->get();
        return view('ridecounts.increment', compact('attractions'));
    }
    
    
    public function store(Request $request) {
        $request->validate([
            'attraction_id' => 'required|exists:attractions,id',
            'count' => 'required|integer|min:1',
        ]);
    
        RideCount::create([
            'user_id' => auth()->id(),
            'attraction_id' => $request->attraction_id,
            'count' => $request->count,
        ]);
    
        return redirect()->back()->with('success', 'Ride count updated!');
    }


    public function increment(Request $request, Attraction $attraction)
    {
        $rideCount = RideCount::firstOrCreate(
            [
                'user_id' => auth()->id(),
                'attraction_id' => $attraction->id,
            ],
            [
                'count' => 0,
            ]
        );
    
        $rideCount->increment('count');
    
        return response()->json([
            'success' => true,
            'count' => $rideCount->count,
        ]);
    }
 
    

    
}
