<?php

use App\Models\Task;
use App\Models\User;
use App\Models\Absensi;
use App\Models\Karyawan;
use App\Models\PurchaseOrder;


function totalKaryawan()
{
    return Karyawan::count();
}

function totalAbsensi()
{
    return Absensi::count();

}

function totalPurchase()
{
    return PurchaseOrder::count();
}

function poPending()
{
    return PurchaseOrder::where('status', '=', 'Pending')->count();
}

function poSelesai()
{
    return PurchaseOrder::where('status', '=', 'Selesai')->count();
}

function totalUser()
{
    return User::count();
}

function totalActiveUser()
{
    return User::where('status_user', '>', 0)->count();

}

function totalInactiveUser()
{
    return User::where('status_user', '<', 1)->count();
}

function totalTask()
{
    return Task::count();
}

function totalProgressTask()
{
    return Task::where('task_status', '===', 'Sedang Dikerjakan')->count();
}

function totalUnfinishedTask()
{
    return Task::where('task_status', '===', 'Belum Dimulai')->count();
}

