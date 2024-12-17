<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\GetDataController;
use App\Http\Controllers\API\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//jenis barang
Route::get('getJenisBarang', [GetDataController::class, 'getJenisBarang'])->name('getJenisBarang');
Route::post('getJenisBarang', [GetDataController::class, 'storeJenisBarang'])->name('storeJenisBarang');

//barang
Route::get('getBarang', [GetDataController::class, 'getBarang'])->name('getBarang');
Route::post('getBarang', [GetDataController::class, 'storeBarang'])->name('storeBarang');

//penjualan barang
Route::get('getPenjualanBarang', [GetDataController::class, 'getPenjualanBarang'])->name('getPenjualanBarang');
Route::post('getPenjualanBarang', [GetDataController::class, 'storePenjualanBarang'])->name('storePenjualanBarang');