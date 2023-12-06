<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table    = "karyawan";
    
    protected $fillable = [
        'nama_depan',
        'nama_belakang',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'user_id',
        'avatar'
    ];

    public function getAvatar()
    {
        if (!$this->avatar) {
            return asset('images/default.png');
        }

        return asset('images/'.$this->avatar);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function absensi()
    {
        return $this->hasOne(Absensi::class);
    }

    public function nama_lengkap()
    {
        return $this->nama_depan. ' ' .$this->nama_belakang;
    }


}
