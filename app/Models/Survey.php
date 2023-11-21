<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $table    = "survey";
    protected $fillable = [
        'experience_score',
        'description',
        'suggestion',
        'recommend',
        'arrival',
        'service',
        'room',
        'fb',
        'facilities',
        'cleanliness',
        'atmosphere',
        'checkout',
        'wifi',
        'value',
    ];
}
