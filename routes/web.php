<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\JenisSuratController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PermohonanSuratController;
use App\Http\Controllers\BerkasPersyaratanController;
use App\Http\Controllers\RiwayatStatusSuratController;
use App\Http\Controllers\MultipleUploadController;

/*
|--------------------------------------------------------------------------
| Web Routes - Proyek Bina Desa
|--------------------------------------------------------------------------
*/

// =====================
// DEFAULT REDIRECT
// =====================
Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('admin.dashboard')
        : redirect()->route('admin.login');
});

// =====================
// AUTH ROUTES
// =====================
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
    Route::get('/admin/register', [AuthController::class, 'showRegisterForm'])->name('admin.register');
    Route::post('/admin/register', [AuthController::class, 'register'])->name('admin.register.post');
});

// =====================
// ADMIN AREA (Protected)
// =====================
Route::prefix('admin')->name('admin.')->middleware('checkislogin')->group(function () {

    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ===== MASTER DATA =====
    Route::resource('warga', WargaController::class);

    // ===== USER MANAGEMENT (Hanya SUPER ADMIN) =====
    Route::middleware('checkrole:Super Admin')->group(function () {
        Route::resource('user', UserController::class);
    });

    // ===== JENIS SURAT =====
    Route::resource('jenis-surat', JenisSuratController::class);
    Route::delete('jenis-surat/media/{id}', [JenisSuratController::class, 'deleteMedia'])->name('jenis-surat.media.delete');

    // ===== PERMOHONAN SURAT =====
    Route::resource('permohonan-surat', PermohonanSuratController::class);
    Route::delete('permohonan-surat/media/{id}', [PermohonanSuratController::class, 'deleteMedia'])->name('permohonan-surat.media.delete');

    // ===== BERKAS PERSYARATAN =====
    Route::resource('berkas-persyaratan', BerkasPersyaratanController::class);
    Route::delete('berkas-persyaratan/media/{id}', [BerkasPersyaratanController::class, 'deleteMedia'])->name('berkas-persyaratan.media.delete');

    // ===== RIWAYAT STATUS SURAT =====
    Route::resource('riwayat-status', RiwayatStatusSuratController::class);
    Route::delete('riwayat-status/media/{id}', [RiwayatStatusSuratController::class, 'deleteMedia'])->name('riwayat-status.media.delete');

    // ===== MEDIA CRUD =====
    Route::resource('media', MediaController::class);

    // ===== MULTIPLE UPLOAD =====
    Route::post('multipleupload', [MultipleUploadController::class, 'store'])->name('multipleupload.store');
    Route::delete('multipleupload/{id}', [MultipleUploadController::class, 'destroy'])->name('multipleupload.destroy');

});
