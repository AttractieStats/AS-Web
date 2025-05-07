<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attraction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'park_id',
        'image_path',
    ];

    /**
     * Get the park that the attraction belongs to.
     */
    public function park()
    {
        return $this->belongsTo(Park::class);
    }



    /**
     * Get the ride counts associated with the attraction.
     */
    public function rideCounts()
    {
        return $this->hasMany(RideCount::class);
    }

public function type()
{
    return $this->belongsTo(\App\Models\AttractionType::class, 'type_id');
}


}
