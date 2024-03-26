<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'item';

    protected $guarded = [];

    public function purchase_order()
    {
        return $this->belongsToMany(PurchaseOrder::class)->withPivot(['item_id', 'purchase_order_id', 'harga', 'total_harga', 'ppn', 'grand_total', 'quantity']);
    }
}
