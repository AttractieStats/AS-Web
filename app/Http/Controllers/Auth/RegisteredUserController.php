<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Services\DiscordService;  // Vergeet niet de DiscordService toe te voegen

class RegisteredUserController extends Controller
{
    protected $discord;

    // Injecteer de DiscordService in de constructor
    public function __construct(DiscordService $discord)
    {
        $this->discord = $discord; // Zet de discord service op
    }

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Maak een nieuwe gebruiker aan
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Verstuur het bericht naar Discord
        $message = "{$user->name} heeft zich aangemeld op AttractieStats!";
        $this->discord->sendMessage($message);  // Verstuur naar Discord

        // Event voor registratie
        event(new Registered($user));

        // Login de gebruiker en stuur hem door naar de homepagina
        auth()->login($user);

        return redirect()->route('home');  // Verwijst naar homepagina
    }
}
