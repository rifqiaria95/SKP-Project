<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{

    public function activity(Request $request)
    {
        // Menampilkan Data Activity
        $logs = \ActivityLog::ActivityLogList();
        $user = User::all();

        if ($request->ajax()) {
            return datatables()->of($logs)
            ->addIndexColumn()
            ->toJson();
        }

        return view('activitylog.index', compact(['logs', 'user']));
    }
}
