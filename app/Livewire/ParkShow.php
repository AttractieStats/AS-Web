<?php

namespace App\Livewire;

use App\Models\RideCount;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ParkShow extends Component
{
    public $park;
    public $attractions;
    public $doneAttractions;
    public $totalRides;
    public function mount($park,$attractions, $doneAttractions, $totalRides){
        $this->park = $park;
        $this->attractions = $attractions;
        $this->doneAttractions = $doneAttractions;
        $this->totalRides = $totalRides;
    }

    public function render()
    {
        return view('livewire.park-show');
    }

    public function incrementRidecount($attractionId)
    {
            $rideCount = RideCount::firstOrCreate(
                [
                    'user_id' => Auth::id(),
                    'attraction_id' => $attractionId,
                ],
                ['count' => 0]
            );
        $rideCount->increment('count');
    }
}
