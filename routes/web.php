<?php

use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/filament-clear', function() {
    $exitCode = Artisan::call('filament:clear');
    // return what you want
});
Route::get('/filament-assets', function() {
    $exitCode = Artisan::call('filament:assets');
    // return what you want
});

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('optimize:clear');
    // return what you want
});

Route::get('/ngelink', function () {
    Artisan::call('storage:link');
});
Route::get('/', [GuestController::class, 'index']);

Route::get('/permohonan', [GuestController::class, 'permohonan']);
Route::get('/berita', [GuestController::class, 'berita']);

Route::get('/tentang-kami', [GuestController::class, 'tentang_kami']);
Route::get('/struktur-organisasi', [GuestController::class, 'struktur_organisasi']);
Route::get('/penghargaan', [GuestController::class, 'penghargaan']);
Route::get('/budaya-perusahaan', [GuestController::class, 'budaya_perusahaan']);
Route::get('/sertifikasi', [GuestController::class, 'sertifikasi']);
Route::get('/unit/{unit}', [GuestController::class, 'unit_get']);
Route::get('/siaran-pers', [GuestController::class, 'siaran_pers']);
Route::get('/siaran-pers', [GuestController::class, 'siaran_pers']);
Route::get('/siaran-pers/{slug}', [GuestController::class, 'siaran_pers_page']);
Route::get('/guest/login', [GuestController::class, 'login']);
Route::post('/guest/login', [GuestController::class, 'login_proses']);
Route::get('/kontak', [GuestController::class, 'kontak']);

Route::get('/login', function () {
    return redirect(route('filament.admin.auth.login'));
})->name('login');
