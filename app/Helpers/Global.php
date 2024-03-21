<?php

use App\Models\User;
use App\Models\Absensi;
use App\Models\Karyawan;


function totalKaryawan()
{
    return Karyawan::count();
}

function totalAbsensi()
{
    return Absensi::count();

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

