<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\QuestionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pcr', function () {
    $a = 5 + 5;
    return 'Selamat Datang di Website Kampus PCR!';
});


Route::get('/mahasiswa', function () {
    return 'Halo Mahasiswa';
});

Route::get('/mahasiswa/{param1}', [MahasiswaController::class, 'show']);

Route::get('/nama/{param1}', function ($param1) {
    return 'Nama saya: ' . $param1;
});

Route::get('/nim/{param1?}', function ($param1 = '') {
    return 'NIM saya: ' . $param1;
});

# Named routed#
use App\Http\Controllers\MahasiswaController;
Route::get('/mahasiswa', function () {
    return 'Halo Mahasiswa';
})->name('mahasiswa.show');
Route::get('/mahasiswa/{param1}', [MahasiswaController::class, 'show']);

Route::get('/about', function () {
    return view('halaman-about');
});

Route::get('/home',[HomeController::class,'index']);

Route::get('/pegawai', [PegawaiController::class, 'index']);

//question
Route::post('question/store', [QuestionController::class, 'store'])
		->name('question.store');

   // AuthController (untuk login)




// Route Login
//Route::get('/login', [AuthController::class, 'index'])->name('auth.login');
//Route::post('/login', [AuthController::class, 'login'])->name('auth.login.process');

// Route Register
//Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
//Route::post('/register', [AuthController::class, 'register'])->name('auth.register.process');

// Dashboard
//Route::get('/dashboard', function () {
    //$user = session('user');
    //return view('login.dashboard', compact('user'));
//})->name('dashboard');

// Projek AuthController
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Admin Routes - Bina Desa
|--------------------------------------------------------------------------
*/

// Authentication Routes
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');

Route::get('/admin/register', [AuthController::class, 'showRegisterForm'])->name('admin.register');
Route::post('/admin/register', [AuthController::class, 'register'])->name('admin.register.post');

Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout.get');

// Dashboard
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});

// Permohonan Surat - CRUD
Route::prefix('admin/permohonan')->group(function () {
    Route::get('/', [AdminController::class, 'permohonanIndex'])->name('admin.permohonan.index');
    Route::get('/{id}', [AdminController::class, 'permohonanShow'])->name('admin.permohonan.show');
    Route::post('/{id}/update-status', [AdminController::class, 'permohonanUpdateStatus'])->name('admin.permohonan.update_status');
});

// Jenis Surat - CRUD
Route::prefix('admin/jenis-surat')->group(function () {
    Route::get('/', [AdminController::class, 'jenisSuratIndex'])->name('admin.jenis_surat.index');
    Route::get('/create', [AdminController::class, 'jenisSuratCreate'])->name('admin.jenis_surat.create');
    Route::post('/', [AdminController::class, 'jenisSuratStore'])->name('admin.jenis_surat.store');
    Route::get('/{id}/edit', [AdminController::class, 'jenisSuratEdit'])->name('admin.jenis_surat.edit');
    Route::put('/{id}', [AdminController::class, 'jenisSuratUpdate'])->name('admin.jenis_surat.update');
    Route::delete('/{id}', [AdminController::class, 'jenisSuratDestroy'])->name('admin.jenis_surat.destroy');
});

// Default route
Route::get('/', function () {
    if (session('user')) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('admin.login');
});
