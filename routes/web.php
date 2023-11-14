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
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route Home
Route::get('/', 'SiteController@home');

// Route Dashboard
Route::get('dashboard', 'DashboardController@index');

// Route User
Route::get('user', 'UserController@index');
Route::get('user/edit/{id}', 'UserController@edit');
Route::post('user/update/{id}', 'UserController@update');
Route::delete('user/delete/{id}', 'UserController@destroy');

// Route Data Karyawan
Route::get('karyawan', 'KaryawanController@index');
Route::post('karyawan/store', 'KaryawanController@store');
Route::get('karyawan/edit/{id}', 'KaryawanController@edit');
Route::post('karyawan/update/{id}', 'KaryawanController@update');
Route::delete('karyawan/delete/{id}', 'KaryawanController@destroy');

// Route Meal Attendance
Route::get('absensi', 'AbsensiController@index');
Route::get('absensi/create', 'AbsensiController@create');
Route::post('absensi/store', 'App\Http\Controllers\AbsensiController@store');


