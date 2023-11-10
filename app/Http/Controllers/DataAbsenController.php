<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataAbsenController extends Controller
{
    public function index(Request $request) {
        return view('be-absensi.index');
    }
}
