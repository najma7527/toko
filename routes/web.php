<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\KasirMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard/admin', [IndexController::class, 'allData1'])->name('admin')->middleware(['auth', AdminMiddleware::class]);
Route::get('/dashboard/kasir', [IndexController::class, 'allData2'])->name('kasir')->middleware(['auth', KasirMiddleware::class]);


Route::get('/', function () {
    return view('login');
});

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/register', function () {
    return view('register');
})->name('register.form');

Route::post('/register', [RegisterController::class, 'register'])->name('register');

