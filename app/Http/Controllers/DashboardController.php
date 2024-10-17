<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Absensi;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $task  = Task::latest()->take(5)->get();
        $karyawan = Karyawan::all();

        return view('dashboard.index', compact('task', 'karyawan'));
    }
}
