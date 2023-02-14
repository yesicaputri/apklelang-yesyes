<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LelangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('barang', BarangController::class);

Route::resource('lelang', LelangController::class);

Route::resource('user', UserController::class);

Route::resource('barang', BarangController::class)->middleware('auth');
Route::resource('lelang', LelangController::class)->middleware('auth');

// ROUTE REGISTER
Route::get('register', [RegisterController::class, 'view'])->name('register')->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->name('register-store')->middleware('guest');

// ROUTE LOGIN LOGOUT
Route::get('login', [LoginController::class, 'view'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class, 'proses'])->name('login.proses')->middleware('guest');
Route::get('logout', [LoginController::class, 'logout'])->name('logout-petugas');

// ROUTE DASHBOARD USER
Route::get('dashboard/admin', [Dashboard::class, 'admin'])->name('dashboard.admin')->middleware('auth', 'level:admin,petugas');
Route::get('dashboard/petugas', [Dashboard::class, 'petugas'])->name('dashboard.petugas')->middleware('auth', 'level:petugas');
Route::get('dashboard/masyarakat', [Dashboard::class, 'masyarakat'])->name('dashboard.masyarakat')->middleware('auth', 'level:masyarakat');

// ROUTE BARANG
Route::get('barang/admin', [BarangController::class, 'index'])->name('barang.index')->middleware('auth', 'level:admin');
Route::get('barang/petugas', [BarangController::class, 'index'])->name('barang.index')->middleware('auth', 'level:petugas');
Route::get('lelang/petugas', [LelangController::class, 'index'])->name('lelang.index')->middleware('auth', 'level:petugas');
Route::get('lelang/masyarakat', [LelangController::class, 'index'])->name('lelang.index')->middleware('auth', 'level:masyarakat');

Route::post('/admin/operator/create', [UserController::class, 'store'])->name('user.store')->middleware('auth','level:admin');
Route::get('/admin/operator/create', [UserController::class, 'create'])->name('user.create')->middleware('auth','level:admin');
Route::get('/admin/operator', [UserController::class, 'index'])->name('index')->middleware('auth','level:admin');

// ROUTE ERROR
Route::view('error/403', 'error.403')->name('error.403');