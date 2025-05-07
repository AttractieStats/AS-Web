<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RideCount extends Model
{
    use HasFactory;

    // Sta mass assignment toe voor de volgende kolommen
    protected $fillable = [
        'user_id',
        'attraction_id',
        'count',
        'ridefoto',
    ];

    // Relatie met de gebruiker
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relatie met de attractie
    public function attraction()
    {
        return $this->belongsTo(Attraction::class);
    }
}
