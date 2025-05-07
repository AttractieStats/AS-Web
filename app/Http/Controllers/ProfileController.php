<?php

namespace App\Http\Controllers;

use App\Models\Park;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as ImgManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\Encoders\JpegEncoder;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
            'parks' => Park::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'language' => 'required|in:nl,en,de',
            'country' => 'nullable|string|max:100',
            'bio' => 'nullable|string|max:1000',
            'favorite_park_id' => 'nullable|exists:parks,id',
            'profile_photo' => 'nullable|image|max:8192', // we verwerken zelf
        ]);

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo) {
                \Storage::disk('public')->delete($user->profile_photo);
            }

            $image = $request->file('profile_photo');
            $filename = 'profile_' . $user->id . '.jpg';

$manager = new ImgManager(new GdDriver());
$processed = $manager->read($image)
    ->resize(300, 300, function ($c) {
        $c->aspectRatio();
        $c->upsize();
    })
    ->encode(new JpegEncoder(quality: 75));


\Storage::disk('public')->put('profile_photos/' . $filename, (string) $processed);
            $validated['profile_photo'] = 'profile_photos/' . $filename;
        }

        $user->update($validated);

        return back()->with('success', 'Profiel succesvol bijgewerkt!');
    }

    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function updateLanguage(Request $request)
    {
        $request->validate([
            'language' => 'required|in:nl,en,de',
        ]);

        $user = auth()->user();
        $user->language = $request->language;
        $user->save();

        return back()->with('success', 'Taalvoorkeur opgeslagen!');
    }
}
