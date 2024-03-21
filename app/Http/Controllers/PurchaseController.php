<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseOrder;

class PurchaseController extends Controller
{
    public function index() {
        $purchase = PurchaseOrder::all();

        return view('purchaseorder.index', compact(['purchase']));
    }
}
