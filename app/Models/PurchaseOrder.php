<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $table   = 'purchase_order';

    protected $guarded = [];



    public function user()
    {
        return $this->belongsTo(User::class)->withPivot(['item_id', 'purchase_order_id', 'harga', 'total_harga', 'ppn', 'grand_total', 'quantity']);
    }

    public function item()
    {
        return $this->belongsToMany(Item::class);
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
