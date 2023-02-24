<?php

use App\Http\Controllers\Api\AbsenController;
use App\Http\Controllers\Api\Auth\AutentikasiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AutentikasiController::class, 'login']);
Route::middleware('api.auth')->group(function(){
    Route::post('logout', [AutentikasiController::class, 'logout']);

    Route::post('absen_post', [AbsenController::class, 'clock_check']);
    Route::post('absen_history', [AbsenController::class, 'history']);
});
