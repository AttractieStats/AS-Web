<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use Illuminate\Http\Request;
use App\Models\User;


class FriendController extends Controller
{
    public function index()
    {
        $friends = auth()->user()->friends;
        $requests = auth()->user()->friendRequests;
        return view('friends.index', compact('friends', 'requests'));
    }

public function sendRequest(User $user)
{
    $authUser = auth()->user();

    if ($authUser->id === $user->id) {
        return back()->with('error', 'Je kunt jezelf niet toevoegen.');
    }

    $exists = \DB::table('friends')
        ->where(function ($query) use ($authUser, $user) {
            $query->where('user_id', $authUser->id)
                ->where('friend_id', $user->id);
        })->orWhere(function ($query) use ($authUser, $user) {
            $query->where('user_id', $user->id)
                ->where('friend_id', $authUser->id);
        })->exists();

    if ($exists) {
        return back()->with('error', 'Je hebt al een vriendschapsverzoek gestuurd of jullie zijn al vrienden.');
    }

    \DB::table('friends')->insert([
        'user_id' => $authUser->id,
        'friend_id' => $user->id,
        'accepted' => false,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return back()->with('success', 'Vriendschapsverzoek verstuurd!');
}

    public function accept($id)
    {
        $request = Friend::where('user_id', $id)->where('friend_id', auth()->id())->firstOrFail();
        $request->update(['accepted' => true]);

        return back()->with('success', 'Je bent nu vrienden!');
    }

    public function reject($id)
    {
        Friend::where('user_id', $id)->where('friend_id', auth()->id())->delete();
        return back()->with('info', 'Verzoek afgewezen.');
    }
}
