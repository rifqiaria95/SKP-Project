<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function activity(Request $request)
    {
        // Menampilkan Data Activity
        // $logs = \ActivityLog::ActivityLogList();
        $logs = ActivityLog::all();
        $user = User::all();

        if ($request->ajax()) {
            return datatables()->of($logs)
            ->addColumn('user', function (ActivityLog $logs) {
                if ($logs->user_id === 'Not Login') {
                    return 'Not Login';
                } else {
                    return $logs->user->name;
                }
            })
            ->addIndexColumn()
            ->toJson();
        }

        return view('activitylog.index', compact(['logs', 'user']));
    }
}
