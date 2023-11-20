<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KetStatus extends Model
{
    use HasFactory;

    protected $table    = "ket_status";
    
    protected $fillable = [
        'nama_status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
