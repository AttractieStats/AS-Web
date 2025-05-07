<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Attraction;
use App\Models\RideCount;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/rides/{user_id}', function ($user_id) {
    return Attraction::where('user_id', $user_id)->get();
});

Route::post('/rides', function (Request $request) {
    $ride = new Attraction();
    $ride->user_id = $request->input('user_id');
    $ride->attraction_id = $request->input('attraction_id');
    $ride->save();

    return response()->json(['message' => 'Rit opgeslagen!']);
});

use Illuminate\Support\Facades\DB;

Route::get('/ride_counts/{user_id}', function ($user_id) {
    $rides = DB::table('ride_counts')
        ->join('attractions', 'ride_counts.attraction_id', '=', 'attractions.id')
        ->where('ride_counts.user_id', $user_id)
        ->select('ride_counts.id', 'ride_counts.attraction_id', 'attractions.name as attraction_name', 'ride_counts.count')
        ->get();

    return response()->json($rides);
});


// Registreren
Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6'
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password)
    ]);

    return response()->json(['token' => $user->createToken('authToken')->plainTextToken, 'user_id' => $user->id]);
});

// Inloggen
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages(['email' => 'Invalid credentials']);
    }

    return response()->json([
        'token' => $user->createToken('authToken')->plainTextToken,
        'user_id' => $user->id
    ]);
});

Route::get('/attractions', function () {
    return Attraction::all();
});

Route::get('/ride_counts/{user_id}', function ($user_id) {
    return RideCount::where('user_id', $user_id)->get();
});

Route::post('/ride_counts', function (Request $request) {
    $rideCount = \App\Models\RideCount::where('user_id', $request->user_id)
        ->where('attraction_id', $request->attraction_id)
        ->first();

    if ($rideCount) {
        $rideCount->count += 1;
        $rideCount->save();
    } else {
        \App\Models\RideCount::create([
            'user_id' => $request->user_id,
            'attraction_id' => $request->attraction_id,
            'count' => 1
        ]);
    }

    return response()->json(['message' => 'Ride count updated!']);
});


Route::get('/parks', function () {
    $parks = DB::table('parks')->select('id', 'name', 'location')->get();

    return response()->json($parks);
});

Route::get('/parks/{id}/attractions', function ($id) {
    $attractions = DB::table('attractions')
        ->where('park_id', $id)
        ->select('id', 'name', 
                 DB::raw('COALESCE(type, "Onbekend") as type'), 
                 'image_path')
        ->get();

    return response()->json($attractions);
});