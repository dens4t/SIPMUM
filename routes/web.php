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

Route::get('/ngelink', function () {
    Artisan::call('storage:link');
});
Route::get('/', [GuestController::class, 'index']);

Route::get('/permohonan', [GuestController::class, 'permohonan']);
Route::get('/permohonan/nomor-surat', [GuestController::class, 'datatable_nomor_surat'])->middleware('auth');

Route::get('/tentang-kami', [GuestController::class, 'tentang_kami']);
Route::get('/struktur-organisasi', [GuestController::class, 'struktur_organisasi']);
Route::get('/penghargaan', [GuestController::class, 'penghargaan']);
Route::get('/budaya-perusahaan', [GuestController::class, 'budaya_perusahaan']);
Route::get('/sertifikasi', [GuestController::class, 'sertifikasi']);
Route::get('/unit', [GuestController::class, 'unit']);
Route::get('/siaran-pers', [GuestController::class, 'siaran_pers']);


Route::get('/login', function () {
    return redirect(route('filament.admin.auth.login'));
})->name('login');
