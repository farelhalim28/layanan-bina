  <?php

use Illuminate\Support\Facades\Route;
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

    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ===== MASTER DATA =====
    Route::resource('warga', WargaController::class);
    Route::resource('user', UserController::class);

    // ===== JENIS SURAT =====
    Route::resource('jenis-surat', JenisSuratController::class);
    // Route khusus delete media jenis surat
    Route::delete('jenis-surat/media/{id}', [JenisSuratController::class, 'deleteMedia'])->name('jenis-surat.media.delete');

    // ===== PERMOHONAN SURAT =====
    Route::resource('permohonan-surat', PermohonanSuratController::class);
    // Route khusus delete media permohonan surat
    Route::delete('permohonan-surat/media/{id}', [PermohonanSuratController::class, 'deleteMedia'])->name('permohonan-surat.media.delete');

    // ===== BERKAS PERSYARATAN =====
    Route::resource('berkas-persyaratan', BerkasPersyaratanController::class);
    // Route khusus delete media berkas persyaratan
    Route::delete('berkas-persyaratan/media/{id}', [BerkasPersyaratanController::class, 'deleteMedia'])->name('berkas-persyaratan.media.delete');

    // ===== RIWAYAT STATUS SURAT =====
    Route::resource('riwayat-status', RiwayatStatusSuratController::class);
    Route::delete('riwayat-status/media/{id}', [App\Http\Controllers\RiwayatStatusSuratController::class, 'deleteMedia'])->name('riwayat-status.media.delete');

    // ===== MEDIA (CRUD Standalone) =====
    Route::resource('media', MediaController::class);

    // ===== MULTIPLE UPLOAD (Helper) =====
    Route::post('multipleupload', [MultipleUploadController::class, 'store'])->name('multipleupload.store');
    Route::delete('multipleupload/{id}', [MultipleUploadController::class, 'destroy'])->name('multipleupload.destroy');

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

