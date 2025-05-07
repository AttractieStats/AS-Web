<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attraction;
use App\Models\Park;
use App\Models\AttractionType;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\Encoders\JpegEncoder;

class AdminAttractionController extends Controller
{
    public function index()
    {
        $attractions = Attraction::with('park', 'type')->get();
        return view('admin.attractions.index', compact('attractions'));
    }

public function create()
{
    $attractionTypes = AttractionType::all();
    $parks = Park::all();
    return view('admin.attractions.create', compact('attractionTypes', 'parks'));
}


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type_id' => 'required|exists:attraction_types,id',
            'park_id' => 'required|exists:parks,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        if ($request->hasFile('image')) {
            $manager = new ImageManager(new GdDriver());
            $image = $manager->read($request->file('image'));

            $orientation = $image->exif('Orientation');
            switch ($orientation) {
                case 3: $image->rotate(180); break;
                case 6: $image->rotate(-90); break;
                case 8: $image->rotate(90); break;
            }

            $filename = uniqid() . '.jpg';
            $encoded = $image->encode(new JpegEncoder(quality: 75));
            \Storage::disk('public')->put('attractions/' . $filename, (string) $encoded);
            $validated['image_path'] = 'attractions/' . $filename;
        }

        Attraction::create($validated);

        return redirect()->route('admin.attractions.index')->with('success', 'Attractie succesvol aangemaakt!');
    }

public function edit(Attraction $attraction)
{
    $attractionTypes = AttractionType::all();
    $parks = Park::all();
    return view('admin.attractions.edit', compact('attraction', 'attractionTypes', 'parks'));
}


    public function update(Request $request, Attraction $attraction)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type_id' => 'required|exists:attraction_types,id',
            'park_id' => 'required|exists:parks,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        if ($request->hasFile('image')) {
            if ($attraction->image_path) {
                \Storage::disk('public')->delete($attraction->image_path);
            }

            $manager = new ImageManager(new GdDriver());
            $image = $manager->read($request->file('image'));

            $orientation = $image->exif('Orientation');
            switch ($orientation) {
                case 3: $image->rotate(180); break;
                case 6: $image->rotate(-90); break;
                case 8: $image->rotate(90); break;
            }

            $filename = uniqid() . '.jpg';
            $encoded = $image->encode(new JpegEncoder(quality: 55));
            \Storage::disk('public')->put('attractions/' . $filename, (string) $encoded);
            $validated['image_path'] = 'attractions/' . $filename;
        }

        $attraction->update($validated);

        return redirect()->route('admin.attractions.index')->with('success', 'Attractie succesvol bijgewerkt!');
    }

    public function show(Attraction $attraction)
    {
        return view('admin.attractions.show', compact('attraction'));
    }


    public function reject($id)
{
    $suggestion = \App\Models\AttractionSuggestion::findOrFail($id);

    if ($suggestion->approved) {
        return redirect()->route('admin.suggestions')->with('error', 'Deze suggestie is al goedgekeurd.');
    }

    $suggestion->update(['rejected' => true]);

    return redirect()->route('admin.suggestions')->with('success', 'Suggestie is afgekeurd.');
}

}
