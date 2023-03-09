<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LelangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\HistoryLelangController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MasyarakatController;


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
    return view('home');
});


// ROUTE REGISTER
Route::get('register', [RegisterController::class, 'view'])->name('register')->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->name('register-store')->middleware('guest');

// ROUTE LOGIN & LOGOUT
Route::get('login', [LoginController::class, 'view'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class, 'proses'])->name('login.proses')->middleware('guest');
Route::get('logout', [LoginController::class, 'logout'])->name('logout-petugas');

// ROUTE DASHBOARD USER
Route::get('dashboard/admin', [Dashboard::class, 'admin'])->name('dashboard.admin')->middleware('auth', 'level:admin,petugas');
Route::get('dashboard/petugas', [Dashboard::class, 'petugas'])->name('dashboard.petugas')->middleware('auth', 'level:petugas');
Route::get('dashboard/masyarakat', [Dashboard::class, 'masyarakat'])->name('dashboard.masyarakat')->middleware('auth', 'level:masyarakat');

// ROUTE USER LEVEL ADMIN
    Route::controller(UserController::class)->group(function() {
        Route::post('/admin/operator/create', 'store')->name('user.store')->middleware('auth','level:admin');
        Route::get('/admin/operator/create', 'create')->name('user.create')->middleware('auth','level:admin');
        Route::get('user', 'index')->name('user.index')->middleware('auth','level:admin');
        Route::get('/user/{user}/edit', 'edit')->name('user.edit')->middleware('auth','level:admin');
        Route::get('user/{user}', 'show')->name('user.show')->middleware('auth','level:admin');
        Route::delete('user/{user}', 'destroy')->name('user.destroy')->middleware('auth','level:admin');
        Route::put('user/{user}', 'update')->name('user.update')->middleware('auth','level:admin');
    });

// ROUTE LISTLELANG
Route::get('/dashboard/masyarakat/listlelang', [ListController::class, 'index'])->name('listlelang.index')->middleware('auth', 'level:masyarakat');
Route::get('listlelang', [ListController::class, 'index'])->name('listlelang.index')->middleware('auth', 'level:admin,petugas,masyarakat');

//ROUTE MASYARAKAT CONTROLLER
Route::get('data-penawaran-anda', [MasyarakatController::class, 'index'])->name('masyarakatlelang.index')->middleware('auth', 'level:masyarakat');

// ROUTE BARANG LEVEL ADMIN DAN PETUGAS
Route::middleware(['auth', 'level:admin,petugas'])->group(function () {
    Route::controller(BarangController::class)->group(function() {
        Route::get('barang', 'index')->name('barang.index');
        Route::get('barang/create', 'create')->name('barang.create');
        Route::post('barang', 'store')->name('barang.store');
        Route::get('barang/{barang}', 'show')->name('barang.show');
        Route::get('barang/{barang}/edit', 'edit')->name('barang.edit');
        Route::put('barang/{barang}', 'update')->name('barang.update');
        Route::delete('barang/{barang}', 'destroy')->name('barang.destroy');
    });
});


// ROUTE LELANG 
Route::controller(LelangController::class)->group(function() {
    Route::get('lelang', 'index')->name('lelang.index')->middleware('auth', 'level:petugas');
    Route::get('lelang/create', 'create')->name('lelang.create')->middleware('auth', 'level:petugas');
    Route::post('lelang', 'store')->name('lelang.store')->middleware('auth', 'level:petugas');
    Route::get('lelang/{lelang}', 'show')->name('lelang.show')->middleware('auth', 'level:petugas');
    Route::get('lelang/{lelang}/edit', 'edit')->name('lelang.edit')->middleware('auth', 'level:petugas');
    Route::put('lelang/{lelang}', 'update')->name('lelang.update')->middleware('auth', 'level:petugas');
    Route::delete('lelang/{lelang}', 'destroy')->name('lelang.destroy')->middleware('auth', 'level:petugas');
    Route::get('/petugas/lelang/{lelang}', 'show')->name('lelangpetugas.show')->middleware('auth','level:petugas');
    Route::put('/petugas/lelang/{lelang}', 'update')->name('lelang.update')->middleware('auth','level:petugas');
    Route::get('/cetak-lelang', 'cetaklelang')->name('cetak.lelang')->middleware('auth','level:admin,petugas');
    Route::get('/cetak-lelang', 'cetaklelang')->name('cetak.lelang')->middleware('auth','level:admin,petugas');
Route::get('/cetak-penawaran/{lelang}', 'cetakpenawaran')->name('cetak.penawaran')->middleware('auth','level:admin,petugas');
});

// ROUTE HISTORY LELANG
Route::controller(HistoryLelangController::class)->group(function() {
    Route::get('/menawar/{lelang}', 'create')->name('lelangin.create')->middleware('auth','level:masyarakat');
    Route::get('/data-penawaran', 'index')->name('datapenawaran.index')->middleware('auth','level:petugas,admin');
    Route::post('/menawar/{lelang}', 'store')->name('lelangin.store')->middleware('auth','level:masyarakat');
    Route::put('/lelangpetugas/{id}/pemenang', 'setPemenang')->name('lelangpetugas.setpemenang')->middleware('auth','level:petugas');
    Route::delete('/data-penawaran/{lelang}', 'destroy')->name('lelangin.destroy')->middleware('auth','level:petugas');
    Route::get('cetak-history', 'cetakhistory')->name('cetak.history')->middleware('auth','level:petugas,admin');

});
Route::get('generate-pdf', [LaporanController::class, 'generatePdf'])->name('generatePdf');

// ROUTE ERROR
Route::view('error/403', 'error.403')->name('error.403');