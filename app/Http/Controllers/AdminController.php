<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RideCount;

class AdminController extends Controller
{
    public function manageRideCounts()
{
    $rideCounts = RideCount::all();
    return view('admin.ridecounts', compact('rideCounts'));
}

}
