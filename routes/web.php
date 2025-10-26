<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\JenisSuratController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MediaController;

/*
|--------------------------------------------------------------------------
| Web Routes - Proyek Bina Desa
|--------------------------------------------------------------------------
*/

// =====================
// DEFAULT REDIRECT
// =====================
Route::get('/', function () {
    return session('user')
        ? redirect()->route('admin.dashboard')
        : redirect()->route('admin.login');
});

// =====================
// AUTH ROUTES
// =====================
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::get('/admin/register', [AuthController::class, 'showRegisterForm'])->name('admin.register');
Route::post('/admin/register', [AuthController::class, 'register'])->name('admin.register.post');

// =====================
// ADMIN AREA (Protected)
// =====================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('warga', WargaController::class);
    Route::resource('jenis-surat', JenisSuratController::class);
    Route::resource('user', UserController::class);
    Route::resource('media', MediaController::class);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});





// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\HomeController;
// use App\Http\Controllers\PegawaiController;
// use App\Http\Controllers\QuestionController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/pcr', function () {
//     $a = 5 + 5;
//     return 'Selamat Datang di Website Kampus PCR!';
// });


// Route::get('/mahasiswa', function () {
//     return 'Halo Mahasiswa';
// });

// Route::get('/mahasiswa/{param1}', [MahasiswaController::class, 'show']);

// Route::get('/nama/{param1}', function ($param1) {
//     return 'Nama saya: ' . $param1;
// });

// Route::get('/nim/{param1?}', function ($param1 = '') {
//     return 'NIM saya: ' . $param1;
// });

// # Named routed#
// use App\Http\Controllers\MahasiswaController;
// Route::get('/mahasiswa', function () {
//     return 'Halo Mahasiswa';
// })->name('mahasiswa.show');
// Route::get('/mahasiswa/{param1}', [MahasiswaController::class, 'show']);

// Route::get('/about', function () {
//     return view('halaman-about');
// });

// Route::get('/home',[HomeController::class,'index']);

// Route::get('/pegawai', [PegawaiController::class, 'index']);

// //question
// Route::post('question/store', [QuestionController::class, 'store'])
// 		->name('question.store');

//    // AuthController (untuk login)




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

