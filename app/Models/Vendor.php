<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $table   = "vendor";

    protected $guarded = [];



    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
}
