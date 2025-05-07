<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        return view('users.index', compact('users'));
    }

public function show(User $user)
{
    $rideCounts = $user->rideCounts()->with('attraction')->get();

    $existingFriendship = \DB::table('friends')
        ->where(function ($query) use ($user) {
            $query->where('user_id', auth()->id())
                  ->where('friend_id', $user->id);
        })
        ->orWhere(function ($query) use ($user) {
            $query->where('user_id', $user->id)
                  ->where('friend_id', auth()->id());
        })
        ->first();

    return view('users.show', compact('user', 'rideCounts', 'existingFriendship'));

}

}
