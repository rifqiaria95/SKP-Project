<?php

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

