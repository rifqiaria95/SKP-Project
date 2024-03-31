<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'status',
        'job_title',
        'user_id',
        'perusahaan_id',
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
    
    public function perusahaan(): BelongsTo
    {
        return $this->belongsTo(Perusahaan::class);
    }

    public function absensi()
    {
        return $this->hasOne(Absensi::class);
    }

    public function purchase_order()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function nama_lengkap()
    {
        return $this->nama_depan. ' ' .$this->nama_belakang;
    }


}
