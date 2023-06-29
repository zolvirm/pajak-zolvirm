<?php

use App\Exports\PajakExport;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PajakController;
use App\Http\Controllers\PajakExportController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\TrashController;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\DataTables;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// LOGIN LOGOUT
Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');


// DASHBOARD
Route::get('/dash', function () {
    return view('dashboard.dash');
})->middleware('auth');

// PAJAK RESOURCE
Route::controller(PajakController::class)->group(function () {
    Route::get('dash/pajaks', 'index')->name('d-pajaks')->middleware('auth');
    Route::post('dash/pajaks', 'store')->name('pajak.store')->middleware('auth');
    Route::get('dash/pajaks/create', 'create')->name('pajak.create')->middleware('auth');
    Route::get('dash/pajaks/{pajak}', 'show')->name('pajak.show')->middleware('auth');
    Route::put('dash/pajaks/{pajak}', 'update')->name('pajak.update')->middleware('auth');
    Route::delete('dash/pajaks/{pajak}', 'destroy')->name('pajak.delete')->middleware('auth');
    Route::get('dash/pajaks/{pajak}/edit', 'edit')->name('pajak.edit')->middleware('auth');
});

// PEMILIK RESOURCE
Route::controller(PemilikController::class)->group(function () {
    Route::get('dash/pemiliks', 'index')->name('d-pemiliks')->middleware('auth');
    Route::post('dash/pemiliks', 'store')->middleware('auth');
    Route::get('dash/pemiliks/create', 'create')->middleware('auth');
    Route::get('dash/pemiliks/{pemilik}', 'show')->middleware('auth');
    Route::put('dash/pemiliks/{pemilik}', 'update')->middleware('auth');
    Route::delete('dash/pemiliks/{pemilik}', 'destroy')->middleware('auth');
    Route::get('dash/pemiliks/{pemilik}/edit', 'edit')->middleware('auth');
});

// PEMBAYARAN
Route::resource('/dash/pemby', PembayaranController::class)->middleware('auth');
// json
Route::get('/pembayaran-jq', [PembayaranController::class, 'pembjson'])->middleware('auth');

// TEMPAT SAMPAH
Route::get('/dash/trash-pajak', [TrashController::class, 'index'])->middleware('auth');
Route::get('/dash/restore-pajak/{id}', [TrashController::class, 'restore'])->middleware('auth');
Route::post('/dash/forcedelete-pajak/{id}', [TrashController::class, 'forcedelete'])->middleware('auth');

Route::get('/dash/trash-pemilik', [TrashController::class, 'index2'])->middleware('auth');
Route::get('/dash/restore-pemilik/{id}', [TrashController::class, 'restore2'])->middleware('auth');
Route::post('/dash/forcedelete-pemilik/{id}', [TrashController::class, 'forcedelete2'])->middleware('auth');

// EKSPORT IMPORT
Route::get('/pajak-export', [PajakController::class, 'exportpajakexcel'])->middleware('auth');
Route::post('/pajak-import', [PajakController::class, 'importpajakexcel'])->middleware('auth');
Route::get('/contoh-excel-pajak', [PajakController::class, 'downloadCthPajakExcel'])->middleware('auth');

Route::get('/pemilik-export', [PemilikController::class, 'exportPemilikExcel'])->middleware('auth');
Route::post('/pemilik-import', [PemilikController::class, 'importPemilikExcel'])->middleware('auth');
Route::get('/contoh-excel-pemilik', [PemilikController::class, 'downloadCthPemilikExcel'])->middleware('auth');
