<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perusahaan extends Model
{
    use HasFactory;

    protected $table = "perusahaan";

    protected $guarded = [];

    public function karyawan(): HasMany
    {
        return $this->hasMany(Karyawan::class);
    }
}
