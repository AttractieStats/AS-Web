<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Park extends Model
{
    use HasFactory;
    
    public function attractions() {
        return $this->hasMany(Attraction::class);
    }
    
}

