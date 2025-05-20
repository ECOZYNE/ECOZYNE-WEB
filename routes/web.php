<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\KomunitasController;
use App\Http\Controllers\PenukaranController;;
use App\Http\Controllers\TransaksiSampahController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\PengajuanBankSampahController;

Route::get('/', [HomeController::class, 'index'])->name('home');




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
Route::get('/admin/komunitas/{id}', [UserController::class, 'showKomunitas'])->name('admin.komunitas.index');
Route::put('/admin/komunitas/{id}', [UserController::class, 'updateKomunitas']);
// Route::delete('/admin/komunitas/{id}', [UserController::class, 'deleteKomunitas']);
Route::delete('/admin/komunitas/{id}', [UserController::class, 'deleteKomunitas'])->name('admin.komunitas.destroy');


Route::get('/admin/view-bank-sampah', function () {
    return view('/admin/view-bank-sampah');
    });

    Route::get('/admin/persetujuaan-bank-sampah', function () {
        return view('/admin/persetujuaan-bank-sampah');
        });

// profile

Route::get('/admin/my-profile', function () {
    return view('/admin/my-profile');
});

// Hadiah

Route::get('/admin/add-hadiah', function () {
    return view('/admin/add-hadiah');
});

Route::get('/admin/view-hadiah', function () {
    return view('/admin/view-hadiah');
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


Route::get('/admin/view-peserta-kegiatan', function () {
    return view('/admin/view-peserta-kegiatan');
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

// penukaran


Route::get('/admin/konfirmasi-penukaran', function () {
    return view('/admin/konfirmasi-penukaran');
});

Route::get('/admin/view-penukaran', function () {
    return view('/admin/view-penukaran');
});

Route::get('/admin/view-penukaran', function () {
    return view('/admin/view-penukaran');
});

Route::get('/admin/riwayat-penukaran', function () {
    return view('/admin/riwayat-penukaran');
});





//dashboard komunitas

Route::get('/dashboard/index', function () {
    return view('/dashboard/index');
});

Route::get('/dashboard/index-super', function () {
    return view('/dashboard/index-super');
});

Route::get('/dashboard/form', function () {
    return view('/dashboard/form');
});

// Route::get('/dashboard/pengajuan-bank-sampah', function () {
//     return view('/dashboard/pengajuan-bank-sampah');
// });

Route::get('/dashboard/pengajuan-bank-sampah', [PengajuanBankSampahController::class, 'index'])->name('pengajuan-bank-sampah.index');

Route::post('/pengajuan-bank-sampah', [PengajuanBankSampahController::class, 'store'])->name('pengajuan-bank-sampah.store');


// profile

Route::get('/dashboard/my-profile', function () {
    return view('/dashboard/my-profile');
});

   // Menu Utama - Pesanan Anda
   Route::get('/dashboard/my-pesanan-produk', function () {
     return view('/dashboard/my-pesanan-produk');
   });

    Route::get('/dashboard/my-riwayat-pesanan-produk', function () {
      return view('/dashboard/my-riwayat-pesanan-produk');
    });

    // Menu Utama - Penukaran Anda
    Route::get('/dashboard/my-penukaran-hadiah', function () {
        return view('/dashboard/my-penukaran-hadiah');
    });
    
    Route::get('/dashboard/my-riwayat-penukaran-hadiah', function () {
        return view('/dashboard/my-riwayat-penukaran-hadiah');
    });

    // Bank Sampah - Kelola Setor Sampah

    Route::get('/dashboard/add-setor-sampah', function () {
     return view('/dashboard/add-setor-sampah');
    });

    Route::get('/dashboard/riwayat-setor-sampah', function () {
    return view('/dashboard/riwayat-setor-sampah');
    });

    // Bank Sampah - Kelola Produk

    Route::get('/dashboard/add-produk', function () {
        return view('/dashboard/add-produk');
    });
    
    Route::get('/dashboard/view-produk', function () {
        return view('/dashboard/view-produk');
    });
    
    // Bank Sampah - Penjualan Produk
    Route::get('/dashboard/konfirmasi-pesanan-produk', function () {
        return view('/dashboard/konfirmasi-pesanan-produk');
    });
    

    Route::get('/dashboard/view-pesanan-produk', function () {
        return view('/dashboard/view-pesanan-produk');
    });
    
    Route::get('/dashboard/riwayat-pesanan-produk', function () {
        return view('/dashboard/riwayat-pesanan-produk');
    });

    Route::get('/dashboard/my-kegiatan', function () {
        return view('/dashboard/my-kegiatan');
    });
    

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

Route::get('/artikel-details', function () {
    return view('/artikel-details');
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

Route::get('/bank_sampah_asri', function () {
    return view('/bank_sampah_asri');
});

    
 Route::get('/hadiah', function () {
    return view('/hadiah');
});
 
  
