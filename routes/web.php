<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\admin\BarangController;
use App\Http\Controllers\admin\JenisBarangController;
use App\Http\Controllers\admin\PenjualanBarangController;

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
Route::middleware(['guest'])->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::resource('login', LoginController::class);
});
    
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('barang', BarangController::class);
    Route::resource('jenisbarang', JenisBarangController::class);
    Route::resource('penjualanbarang', PenjualanBarangController::class);

    // get barang
    Route::get('/barang-by-jenisbarang/{jenisbarang_id}', [PenjualanBarangController::class, 'getBarangByJenisbarang'])->name('barang.by.jenisbarang');

    Route::post('/logout', [LoginController::class, 'logout']);


    Route::get('delete_jenisbarang/{id}', [JenisBarangController::class, 'destroy'])->name('jenisbarang.destroy');
    Route::get('delete_barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
    Route::get('delete_penjualanbarang/{id}', [PenjualanBarangController::class, 'destroy'])->name('penjualanbarang.destroy');
});