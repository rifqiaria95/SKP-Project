<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = "Task";

    protected $guarded = [];

    protected $casts = [
        'deadline' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
