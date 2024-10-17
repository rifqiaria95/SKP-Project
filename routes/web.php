<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

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

// Route Home
Route::get('/', 'SiteController@home');

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'authenticate']);

Route::group(['middleware' => ['auth', 'checkRole:owner']], function () {

    // Route User
    Route::get('user', 'UserController@index');
    Route::get('user/edit/{id}', 'UserController@edit');
    Route::post('user/update/{id}', 'UserController@update');
    Route::delete('user/delete/{id}', 'UserController@destroy');
    Route::get('user/profile/{id}', 'UserController@profile');

    // Route Survey Hotels (Admin)
    Route::get('survey', 'SurveyController@index');

    // Route Activity Log
    Route::get('activitylog', 'ActivityLogController@activity');

});

Route::group(['middleware' => ['auth', 'checkRole:owner,admin']], function () {
    // Route Dashboard
    Route::get('dashboard', 'DashboardController@index');

    // Route Data Karyawan
    Route::get('karyawan', 'KaryawanController@index');
    Route::post('karyawan/store', 'KaryawanController@store');
    Route::get('karyawan/edit/{id}', 'KaryawanController@edit');
    Route::post('karyawan/update/{id}', 'KaryawanController@update');
    Route::delete('karyawan/delete/{id}', 'KaryawanController@destroy');
    Route::get('karyawan/profile/{id}', 'KaryawanController@profile');
    Route::get('karyawan/exportexcelkaryawan/', 'KaryawanController@exportexcelkaryawan');

    // Route Meal Attendance (Admin)
    Route::get('absensi', 'AbsensiController@index');
    Route::get('absensi/edit/{id}', 'AbsensiController@edit');
    Route::post('absensi/update/{id}', 'AbsensiController@update');
    Route::delete('absensi/delete/{id}', 'AbsensiController@destroy');

});

Route::group(['middleware' => ['auth', 'checkRole:owner,admin,karyawan']], function () {
    // Route Dashboard
    Route::get('dashboard', 'DashboardController@index');

    // Route Purchase Order
    Route::get('purchaseorder', 'PurchaseController@index');
    Route::get('purchaseorder/create', 'PurchaseController@create');
    Route::post('purchaseorder/store', 'PurchaseController@store');
    Route::get('purchaseorder/edit/{id}', 'PurchaseController@edit');
    Route::post('purchaseorder/update/{id}', 'PurchaseController@update');
    Route::delete('purchaseorder/delete/{id}', 'PurchaseController@destroy');
    Route::get('purchaseorder/detail/{id}', 'PurchaseController@detailPurchase');
    Route::post('purchaseorder/{id}/{iditem}/deleteitem', 'PurchaseController@deleteItem');
    Route::get('purchaseorder/getDetail/{id}', 'PurchaseController@getDetail');
    Route::get('purchaseorder/getDetailItem/{id}', 'PurchaseController@getDetailItem');
    Route::get('purchaseorder/export/{id}', 'PurchaseController@exportPDF');

    // Route Item
    Route::get('item', 'ItemController@index');
    Route::post('item/store', 'ItemController@store');

    // Route Vendor
    Route::get('vendor', 'VendorController@index');
    Route::post('vendor/store', 'VendorController@store');
    Route::get('vendor/edit/{id}', 'VendorController@edit');
    Route::post('vendor/update/{id}', 'VendorController@update');
    Route::delete('vendor/delete/{id}', 'VendorController@destroy');

    // Route Perusahaan
    Route::get('perusahaan', 'PerusahaanController@index');
    Route::post('perusahaan/store', 'PerusahaanController@store');
    Route::get('perusahaan/edit/{id}', 'PerusahaanController@edit');
    Route::post('perusahaan/update/{id}', 'PerusahaanController@update');
    Route::delete('perusahaan/delete/{id}', 'PerusahaanController@destroy');

    // Route Inventory
    Route::get('inventory', 'InventoryController@index');


    // Route Inventory
    Route::get('task', 'TaskController@index');
    Route::post('task/store', 'TaskController@store');
    Route::get('task/edit/{id}', 'TaskController@edit');
    Route::post('task/update/{id}', 'TaskController@update');
    Route::delete('task/delete/{id}', 'TaskController@destroy');

});

// ----------------------------- Route yang bisa diakses oleh semua user tanpa login -------------------------------- //

// Route Meal Attendance (User)
Route::get('absensi/create', 'AbsensiController@create');
Route::post('absensi/store', 'AbsensiController@store');
Route::get('absensi/gettitle/{id}', 'AbsensiController@getTitle');

// Route Survey Hotels
Route::get('survey/create', 'SurveyController@create');
Route::post('survey/store', 'SurveyController@store');


Route::get('karyawan/create', 'KaryawanController@create');

