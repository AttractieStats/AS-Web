<?php

namespace App\Http\Controllers;

use App\Models\Attraction;
use App\Models\AttractionType;
use App\Models\AttractionSuggestion;
use Illuminate\Http\Request;
use App\Models\Park;


class AdminSuggestionController extends Controller
{
    public function index()
    {
        $suggestions = AttractionSuggestion::with('type', 'park') // ✅ Laad relaties
            ->where('approved', false)
            ->where('rejected', false)
            ->get();

        return view('admin.suggestions.index', compact('suggestions'));
    }

public function edit($id)
{
    $suggestion = AttractionSuggestion::findOrFail($id);
    $types = AttractionType::all();
    $parks = Park::all(); // ✅ voeg deze toe!

    return view('admin.suggestions.edit', compact('suggestion', 'types', 'parks'));
}


    public function update(Request $request, $id)
    {
        $suggestion = AttractionSuggestion::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type_id' => 'required|exists:attraction_types,id',
            'park_id' => 'required|exists:parks,id',
        ]);

        $suggestion->update($validated);

        return redirect()->route('admin.suggestions')->with('success', 'Suggestie aangepast');
    }

    public function approve($id)
    {
        $suggestion = AttractionSuggestion::with('type')->findOrFail($id);

        Attraction::create([
            'name' => $suggestion->name,
            'type' => $suggestion->type->name, // ✅ type als string
            'park_id' => $suggestion->park_id,
            'photo_path' => $suggestion->photo_path,
        ]);

        $suggestion->update(['approved' => true]);

        return redirect()->route('admin.suggestions')->with('success', 'Suggestie goedgekeurd en attractie toegevoegd');
    }

    public function reject($id)
    {
        $suggestion = AttractionSuggestion::findOrFail($id);

        if ($suggestion->approved) {
            return redirect()->route('admin.suggestions')->with('error', 'Deze suggestie is al goedgekeurd.');
        }

        $suggestion->update(['rejected' => true]);

        return redirect()->route('admin.suggestions')->with('success', 'Suggestie is afgekeurd.');
    }
}
