<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BerandaWaliController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\WaliSantriPembayaranController;
use App\Http\Controllers\WaliSantriProfilController;
use App\Http\Controllers\WaliSantriSantriController;
use App\Http\Controllers\WaliSantriTagihanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post('login', [LoginController::class, 'loginApi']);
//http://localhost:8000/api/login
Route::prefix('walisantri')->middleware(['auth:sanctum', 'auth.wali'])->group(function () {
    //route khusus wali santri
    Route::get('beranda', [BerandaWaliController::class, 'indexApi']);
    Route::resource('santri', WaliSantriSantriController::class);
    Route::resource('tagihan', WaliSantriTagihanController::class);
    Route::resource('pembayaran', WaliSantriPembayaranController::class);
    Route::resource('profil', WaliSantriProfilController::class);
});

Route::resource('santri', SantriController::class)->middleware('auth:sanctum');
//http://localhost:8000/api/santri

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
