<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\KasirMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\pemasokController;
use App\Http\Controllers\pembelianController;
use App\Http\Controllers\penjualanController;

Route::get('/dashboard/admin', [IndexController::class, 'allData1'])->name('admin')->middleware(['auth', AdminMiddleware::class]);
Route::get('/dashboard/kasir', [IndexController::class, 'allData2'])->name('kasir')->middleware(['auth', KasirMiddleware::class]);

Route::resource('barang', BarangController::class);
Route::resource('pemasok', pemasokController::class);
Route::resource('pembelian', pembelianController::class);
Route::resource('penjualan', penjualanController::class);

Route::get('/', function () {
    return view('login');
})->name('login.form')->middleware('guest');

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/register', function () {
    return view('register');
})->name('register.form');

Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::prefix('laporan')->group(function () {
    Route::get('/pembelian', [LaporanController::class, 'pembelian'])->name('laporan.pembelian');
    Route::get('/penjualan', [LaporanController::class, 'penjualan'])->name('laporan.penjualan');
});

