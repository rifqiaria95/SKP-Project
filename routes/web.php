<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route Home
Route::get('/', 'SiteController@home');

// Route Data Absensi Karyawan
Route::get('dataabsensi', 'DataAbsenController@index');

// Route Dara Karyawan
Route::get('karyawan', 'KaryawanController@index');
Route::post('karyawan/store', 'KaryawanController@store');

// Route Front End Meal Attendance
Route::get('absensi', 'AbsensiController@index');
Route::post('absensi/store', 'App\Http\Controllers\AbsensiController@store');
