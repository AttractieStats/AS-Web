<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
protected $fillable = [
    'name',
    'email',
    'password',
    'language',
    'country',
    'bio',
    'favorite_park_id',
    'profile_photo',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function rideCounts() {
        return $this->hasMany(RideCount::class);
    }

    public function role()
{
    return $this->belongsTo(Role::class);
}

// Controleer of een gebruiker een bepaalde rol heeft
public function hasRole($role)
{
    return $this->role->name === $role;
}

public function favoritePark()
{
    return $this->belongsTo(Park::class, 'favorite_park_id');
}



//FRIENDS
public function friends()
{
    return $this->hasMany(Friend::class, 'user_id')->where('accepted', true);
}

public function friendRequests()
{
    return $this->hasMany(Friend::class, 'friend_id')->where('accepted', false);
}

public function hasSentRequestTo($userId)
{
    return Friend::where('user_id', $this->id)->where('friend_id', $userId)->exists();
}


public function friendsOfMine()
{
    return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')->withPivot('status');
}

public function friendsOf()
{
    return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id')->withPivot('status');
}


public function isFriendsWith($userId)
{
    return Friend::where(function ($query) use ($userId) {
        $query->where('user_id', $this->id)->where('friend_id', $userId);
    })->orWhere(function ($query) use ($userId) {
        $query->where('user_id', $userId)->where('friend_id', $this->id);
    })->where('accepted', true)->exists();
}

    
}
