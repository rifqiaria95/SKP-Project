<?php

use App\Models\ActivityLog as ActivityLogModel;
// use Request;

class ActivityLog {
    public static function addToLog($activity)
    {
        $log             = [];
        $log['activity'] = $activity;
        $log['url']      = Request::fullUrl();
        $log['ip']       = Request::ip();
        $log['agent']    = Request::header('user-agent');
        $log['user_id']  = auth()->check() ? auth()->user()->id : 'Not Login';
    	ActivityLogModel:: create($log);
    }

    public static function ActivityLogList()
    {
    	return ActivityLogModel::latest()->get();
    }
}