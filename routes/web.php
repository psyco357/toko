<?php

use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Data\BarangController;
use App\Http\Controllers\Data\ReportController;
use App\Http\Controllers\Data\StokController;
use App\Http\Controllers\Data\TokoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.signin');
});


// Route::get('/barang', function () {
//     return view('konten.barang');
// });

// Route::get('/', [MenuControl::class, 'Menu']);
Route::post('/auth', [UserController::class, 'auth'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

Route::get('/toko', [TokoController::class, 'tokoView'])->name('toko');
Route::get('toko/{id}', [TokoController::class, 'getToko']);
Route::post('toko/update/{id}', [TokoController::class, 'updateToko']);
Route::delete('toko/delete/{id}', [TokoController::class, 'deleteToko']);
Route::post('/toko/create', [TokoController::class, 'create']);

Route::get('/barang', [BarangController::class, 'barangView'])->name('barang');
Route::get('barang/{id}', [BarangController::class, 'getBarang']);
Route::post('barang/update/{id}', [BarangController::class, 'updateBarang']);
Route::delete('barang/delete/{id}', [BarangController::class, 'deleteBarang']);
Route::post('/barang/create', [BarangController::class, 'create']);

Route::get('/stok', [StokController::class, 'stokView'])->name('stok');
Route::get('stok/{id}', [StokController::class, 'getBarang']);
Route::get('tokobarang/{id}', [StokController::class, 'getTokoBarang']);
// Route::get('addstok/{id}', [StokController::class, 'addStok']);
Route::post('stok/update/{id}', [StokController::class, 'updateStok']);
Route::delete('stok/delete/{id}', [StokController::class, 'deleteBarang']);
Route::post('/stok/create', [StokController::class, 'create'])->name('savestok');


Route::get('/reportjual', [ReportController::class, 'reportjual']);
Route::get('penjualan/{id}', [ReportController::class, 'getDataJual']);
Route::get('/penjualan', [ReportController::class, 'getKasir']);
Route::post('/checkout', [ReportController::class, 'checkOut']);
// Route::get('/penjualan', function () {
//     return view('konten.kasir');
// });