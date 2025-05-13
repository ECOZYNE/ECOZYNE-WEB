<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KomunitasController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;

// TUGAS PBO W 5 STUDENT

//--------------------------------------------------------------------------------------

Route::get('/', function () {
    return redirect('/student');
});

Route::get('/student', [StudentController::class, 'index'])
    ->name('student.index');

Route::get('/student/add', [StudentController::class, 'create'])
    ->name('student.create');

    Route::get('/student/add', [StudentController::class, 'create'])
    ->name('student.create');

Route::post('/student/add', [StudentController::class, 'store'])
    ->name('student.store');

    Route::get('/student/edit/{id}', [StudentController::class, 'edit'])
    ->name('student.edit');

    Route::put('/student/edit/{id}', [StudentController::class, 'update'])
    ->name('student.update');

    Route::delete('/student/delete/{id}', [StudentController::class, 'destroy'])
    ->name('student.destroy');


//--------------------------------------------------------------------------------------

Route::get('/', function () {
    return view('/index');
});


Route::get('/', [HomeController::class, 'index']);

// login

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');  // Show login form
Route::post('login', [AuthController::class, 'login'])->name('login-post');  // Handle login post request
Route::post('logout', [AuthController::class, 'logout'])->name('logout');  // Handle logout


// reset password

Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('forgot.form');
Route::post('/forgot-password', [ForgotPasswordController::class, 'handleForgot'])->name('forgot.handle');


// fungsi Registrasi
Route::get('/register', [UserController::class, 'showRegisterForm']);
Route::post('/register-post', [UserController::class, 'register']);
Route::get('/get-kelurahan/{id_kecamatan}', [UserController::class, 'getKelurahan']);

// Dashboard

Route::get('/dashboard/index', function () {
    return view('/dashboard/index');
});

Route::get('/dashboard/form', function () {
    return view('/dashboard/form');
});



// admin

Route::get('/admin/index', [UserController::class, 'data_pengguna']);

Route::get('/admin/view-komunitas', [UserController::class, 'data_komunitas']);

Route::get('/admin/add-komunitas', [UserController::class, 'showAddKomunitasForm']);

// Artikel
Route::resource('artikel', ArtikelController::class);

// Menampilkan form tambah artikel
Route::get('/admin/add-artikel', [ArtikelController::class, 'create'])->name('artikel.form');

// Proses tambah artikel
Route::post('/artikel-post', [ArtikelController::class, 'artikel'])->name('artikel.post');

// Menampilkan daftar artikel
Route::get('/admin/view-artikel', [ArtikelController::class, 'index'])->name('artikel.index');

// Menampilkan artikel berdasarkan ID
Route::get('/admin/view-artikel/{id}', [ArtikelController::class, 'show'])->name('artikel.show');

// routes/web.php
Route::get('/admin/komunitas/{id}', [UserController::class, 'showKomunitas']);
Route::post('/admin/komunitas/{id}', [UserController::class, 'updateKomunitas']);
Route::delete('/admin/komunitas/{id}', [UserController::class, 'deleteKomunitas']);





Route::get('/admin/add-hadiah', function () {
    return view('/admin/add-hadiah');
});


// kegiatan

Route::get('/admin/kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
Route::get('/admin/kegiatan/{id}', [KegiatanController::class, 'show'])->name('kegiatan.show');
Route::put('/admin/kegiatan/{id}', [KegiatanController::class, 'update'])->name('kegiatan.update');
Route::delete('/admin/kegiatan/{id}', [KegiatanController::class, 'destroy'])->name('kegiatan.destroy');


// Menampilkan form tambah kegiatan
Route::get('/admin/add-kegiatan', [KegiatanController::class, 'create'])->name('kegiatan.form');

// Proses tambah kegiatan
Route::post('/kegiatan-post', [KegiatanController::class, 'kegiatan'])->name('kegiatan.post');

// Menampilkan daftar kegiatan
Route::get('/admin/view-kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');

// Menampilkan kegiatan berdasarkan ID
Route::get('/admin/view-kegiatan/{id}', [KegiatanController::class, 'show'])->name('kegiatan.show');

Route::get('/admin/add-hadiah', function () {
    return view('/admin/add-hadiah');
});


// galeri

// Form tambah galeri
Route::get('/admin/add-galeri', [GaleriController::class, 'create'])->name('galeri.form');

// Proses tambah galeri
Route::post('/galeri-post', [GaleriController::class, 'store'])->name('galeri.post');

// View galeri
Route::get('/admin/view-galeri', [GaleriController::class, 'index'])->name('galeri.index');

Route::put('/galeri/{id}', [GaleriController::class, 'update'])->name('galeri.update');
Route::delete('/galeri/{id}', [GaleriController::class, 'destroy'])->name('galeri.destroy');



// luar

Route::get('/index', function () {
    return view('/index');
});

Route::get('/tentang-eco-enzim', function () {
    return view('tentang-eco-enzim');
});

Route::get('/artikel', function () {
    return view('/artikel');
});

Route::get('/portfolio-details', function () {
    return view('/portfolio-details');
});

Route::get('/artikel-details', function () {
    return view('/artikel-details');

});

Route::get('/bank_sampah', function () {
    return view('/bank_sampah');
});




//dashboard komunitas
Route::get('/dashboard/pengajuan_bank_sampah', function () {
    return view('/dashboard/pengajuan_bank_sampah');
});

Route::get('/dashboard/pesanan_anda', function () {
    return view('/dashboard/pesanan_anda');
});

