<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttractionSuggestion extends Model
{
    use HasFactory;

protected $fillable = [
    'name',
    'type_id',
    'park_id',
    'photo_path',
    'approved',
    'rejected',
];


public function type()
{
    return $this->belongsTo(\App\Models\AttractionType::class, 'type_id');
}

public function park()
{
    return $this->belongsTo(\App\Models\Park::class, 'park_id');
}
}
