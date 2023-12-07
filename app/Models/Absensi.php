<?php

namespace App\Models;
use DateTimeInterface;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y H:i:s');
    }

    protected $table    = "absensi";

    protected $fillable = [
        'status',
        'job_title',
        'tanggal_absensi',
        'karyawan_id',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
