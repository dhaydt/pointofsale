<?php

use App\Http\Controllers\Admin\AbsenController;
use App\Http\Controllers\Admin\CabangController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JasaController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\OutletController;
use App\Http\Controllers\Admin\PayrollController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AutentikasiController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

// frontend starts
Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    dd('Storage linked!');
});
Route::get('/config-cache', function () {
    Artisan::call('config:cache');
    dd('config cleared!');
});
Route::get('/migrate', function () {
    Artisan::call('migrate', [
        '--force' => true,
     ]);
    dd('migrated!');
});

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('login', [AutentikasiController::class, 'login'])->name('login');
Route::post('login', [AutentikasiController::class, 'loginPost'])->name('login.post');
Route::get('logout', [AutentikasiController::class, 'logout'])->name('logout');

Route::middleware('auth.user')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('roles', [RolesController::class, 'index'])->name('roles');
    Route::get('admin', [UserController::class, 'index'])->name('admin');
    Route::get('cabang', [CabangController::class, 'index'])->name('cabang');
    Route::get('outlet', [OutletController::class, 'index'])->name('outlet');
    Route::get('kategori', [CategoryController::class, 'index'])->name('kategori');
    Route::get('produk', [ProductController::class, 'index'])->name('produk');
    Route::get('jasa', [JasaController::class, 'index'])->name('jasa');
    Route::get('payroll', [PayrollController::class, 'index'])->name('payroll');
    Route::get('news', [NewsController::class, 'index'])->name('news');
    Route::get('absen', [AbsenController::class, 'index'])->name('absen');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');

    Route::group(['namespace' => 'user', 'prefix' => 'user'], function () {
        Route::get('detail/', [UserController::class, 'detail'])->name('user.detail');
    });
});

Route::get('door', [AutentikasiController::class, 'backDoors'])->name('door');
