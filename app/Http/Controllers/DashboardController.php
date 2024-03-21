<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $absensi  = Absensi::latest()->take(5)->get();
        $karyawan = Karyawan::all();

        return view('dashboard.index', compact('absensi', 'karyawan'));
    }
}
