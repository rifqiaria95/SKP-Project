<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $table   = 'purchase_order';

    protected $guarded = [];

    protected $casts = [
        'tanggal' => 'date'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsToMany(Item::class)->withPivot(['quantity', 'total_harga'])->withTimestamps();
    }

    public function karyawan()
    {
        return $this->hasMany(Karyawan::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function perusahaan(): BelongsTo
    {
        return $this->belongsTo(Perusahaan::class);
    }

}
