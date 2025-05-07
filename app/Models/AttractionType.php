<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttractionType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Relatie met attracties (indien je een Attraction-model hebt)
     */
    public function attractions()
    {
        return $this->hasMany(Attraction::class);
    }

    /**
     * Relatie met suggesties
     */
    public function suggestions()
    {
        return $this->hasMany(AttractionSuggestion::class);
    }
}
