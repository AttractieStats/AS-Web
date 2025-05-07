<?php

namespace App\Http\Controllers;

use App\Models\AttractionSuggestion;
use App\Models\AttractionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Park;


class SuggestionController extends Controller
{
    /**
     * Toon het formulier voor het indienen van een suggestie.
     */
    public function create(Request $request)
    {
        $types = AttractionType::all();
        $parks = Park::all();
        $selectedParkId = $request->input('park_id');

        return view('suggestions.create', compact('types', 'parks', 'selectedParkId'));
    }

    /**
     * Verwerk het ingestuurde formulier en sla de suggestie op.
     */
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'type_id' => 'required|exists:attraction_types,id',
        'park_id' => 'required|exists:parks,id',
        'photo' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('photo')) {
        $validated['photo_path'] = $request->file('photo')->store('suggestions', 'public');
    }

    AttractionSuggestion::create([
        'name' => $validated['name'],
        'type_id' => $validated['type_id'],
        'park_id' => $validated['park_id'],
        'photo_path' => $validated['photo_path'] ?? null,
        'approved' => false,
    ]);

    // Zet park_id in de sessie zodat het terugkomt in het formulier
    session()->flash('last_park_id', $validated['park_id']);

    return redirect()
        ->route('suggestions.create', ['park_id' => $validated['park_id']])
        ->with('success', 'Bedankt veur de suggestie! Hij wordt beoordeeld door een beheerder.');
}

}
