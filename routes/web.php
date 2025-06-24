<?php

use App\Models\BankSampah;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\HadiahController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\KomunitasController;
use App\Http\Controllers\PenukaranController;
use App\Http\Controllers\BankSampahController;
use App\Http\Controllers\HomeBankSampahController;
use App\Http\Controllers\TransaksiSampahController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\PendaftaranKegiatanController;
use App\Http\Controllers\PengajuanBankSampahController;
use App\Http\Controllers\PersetujuanBankSampahController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Public Pages
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


Route::get('/bank_sampah', [HomeBankSampahController::class, 'index'])->name('bank_sampah.index');
Route::get('/bank_sampah/{id}', [HomeBankSampahController::class, 'show'])->name('bank_sampah.show');
Route::post('/purchase-product', [PesananController::class, 'storePurchase'])->name('product.purchase')->middleware('auth');

Route::get('/bank_sampah_asri', function () {
    return view('/bank_sampah_asri');
});

Route::get('/hadiah', function () {
    return view('/hadiah');
});

Route::get('/kegiatan', [KegiatanController::class, 'semuaKegiatan'])->name('kegiatan.index');

/*
|--------------------------------------------------------------------------
| AUTHENTICATION ROUTES - PROTECTED WITH GUEST MIDDLEWARE
|--------------------------------------------------------------------------
*/

    // Login
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login-post');

    // Password Reset
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('forgot.form');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'handleForgot'])->name('forgot.handle');

    // Registration
    Route::get('/register', [UserController::class, 'showRegisterForm']);
    Route::post('/register-post', [UserController::class, 'register']);

    // Routes yang bisa diakses siapa saja
    Route::get('/get-kelurahan/{id_kecamatan}', [UserController::class, 'getKelurahan']);

// Logout - hanya untuk user yang sudah login
Route::middleware(['auth'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES - PROTECTED WITH AUTH MIDDLEWARE
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Admin Dashboard
        Route::get('/index', [AdminController::class, 'adminDashboard'])->name('index');

    // Admin Profile
    Route::get('/my-profile', [UserController::class, 'adminProfile'])->name('admin.profile');
    Route::put('/update-profil', [UserController::class, 'updateAdminProfile'])->name('admin.update.profil');
    Route::post('/update-password', [UserController::class, 'updateAdminPassword'])->name('admin.update.password');

    // Admin - Komunitas Management
    Route::get('/view-komunitas', [UserController::class, 'data_komunitas']);
    Route::get('/add-komunitas', [UserController::class, 'showAddKomunitasForm']);
    Route::get('/komunitas/{id}', [UserController::class, 'showKomunitas'])->name('admin.komunitas.index');
    Route::put('/komunitas/{id}', [UserController::class, 'updateKomunitas']);
    Route::delete('/komunitas/{id}', [UserController::class, 'deleteKomunitas'])->name('admin.komunitas.destroy');

    // Admin - Artikel Management
    Route::get('/add-artikel', [ArtikelController::class, 'create'])->name('artikel.form');
    Route::get('/view-artikel', [ArtikelController::class, 'index'])->name('artikel.index');
    Route::get('/view-artikel/{id}', [ArtikelController::class, 'show'])->name('artikel.show');

    // Admin - Kegiatan Management
    Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
    Route::get('/kegiatan/{id}', [KegiatanController::class, 'show'])->name('kegiatan.show');
    Route::put('/kegiatan/{id}', [KegiatanController::class, 'update'])->name('kegiatan.update');
    Route::delete('/kegiatan/{id}', [KegiatanController::class, 'destroy'])->name('kegiatan.destroy');
    Route::get('/add-kegiatan', [KegiatanController::class, 'create'])->name('kegiatan.form');
    Route::get('/view-kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
    Route::get('/view-kegiatan/{id}', [KegiatanController::class, 'show'])->name('kegiatan.show');
    Route::get('/view-peserta-kegiatan', [KegiatanController::class, 'dataPesertaKegiatan'])->name('kegiatan.peserta');

    // Admin - Galeri Management
    Route::get('/add-galeri', [GaleriController::class, 'create'])->name('galeri.form');
    Route::get('/view-galeri', [GaleriController::class, 'index'])->name('galeri.index');

    // Admin - Hadiah Management
    Route::get('/add-hadiah', [HadiahController::class, 'create'])->name('hadiah.create');
    Route::get('/view-hadiah', [HadiahController::class, 'index'])->name('hadiah.index');
    Route::post('/hadiah', [HadiahController::class, 'store'])->name('hadiah.store');
    Route::put('/hadiah/{id}', [HadiahController::class, 'update'])->name('hadiah.update');
    Route::delete('/hadiah/{id}', [HadiahController::class, 'destroy'])->name('hadiah.destroy');
    
    
    // Admin - Bank Sampah Management
    Route::get('/view-bank-sampah', [BankSampahController::class, 'index'])->name('bank-sampah.index');
    Route::delete('/view-bank-sampah/{id}', [BankSampahController::class, 'destroy'])->name('bank-sampah.destroy');
    Route::get('/persetujuaan-bank-sampah', [PersetujuanBankSampahController::class, 'index'])->name('persetujuan.index');


    Route::post('/penukaran', [PenukaranController::class, 'store'])->name('penukaran.store');
    Route::get('/riwayat-penukaran', [PenukaranController::class, 'riwayat'])->name('penukaran.riwayat');
    
    // Admin routes (pastikan ada pengecekan role di controller)
      Route::get('/view-penukaran', [PenukaranController::class, 'penukaranDiterima'])->name('admin.penukaran.diterima');
Route::put('/view-penukaran/{id}/status', [PenukaranController::class, 'updateStatusPenukaranDiterima'])->name('penukaran.diterima.update');
Route::put('/view-penukaran/{id}/status', [PenukaranController::class, 'updateStatusPenukaranDiterima'])->name('admin.penukaran.updateStatus');

    // Admin - Penukaran Management

    Route::get('/konfirmasi-penukaran', [PenukaranController::class, 'konfirmasiPenukaran'])->name('admin.konfirmasi.penukaran');
Route::put('/penukaran/{id}/status', [PenukaranController::class, 'updateStatus'])->name('penukaran.update.status');


Route::get('/riwayat-penukaran', [PenukaranController::class, 'RiwayatPenukaranSelesai'])
    ->name('admin.penukaran.riwayat');
});

// Admin routes yang masih menggunakan resource dan POST methods
Route::middleware(['auth'])->group(function () {
    // Admin - Artikel Resource Routes
    Route::post('/artikel-post', [ArtikelController::class, 'artikel'])->name('artikel.post');

    // Admin - Kegiatan POST Routes
    Route::post('/kegiatan-post', [KegiatanController::class, 'kegiatan'])->name('kegiatan.post');

    // Admin - Galeri POST Routes
    Route::post('/galeri-post', [GaleriController::class, 'store'])->name('galeri.post');
    Route::put('/galeri/{id}', [GaleriController::class, 'update'])->name('galeri.update');
    Route::delete('/galeri/{id}', [GaleriController::class, 'destroy'])->name('galeri.destroy');

    // Admin - Hadiah POST Routes
    Route::post('/hadiah', [HadiahController::class, 'store'])->name('hadiah.store');

    // Admin - Persetujuan Routes
    Route::put('/pengajuan/{id}', [PersetujuanBankSampahController::class, 'updatePersetujuan']);
});

/*
|--------------------------------------------------------------------------
| DASHBOARD KOMUNITAS ROUTES - PROTECTED WITH AUTH MIDDLEWARE
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('dashboard')->group(function () {
   
    Route::get('/index', [KomunitasController::class, 'index'])->name('dashboard.index');

    // Dashboard Forms
    Route::get('/form', function () {
        return view('/dashboard/form');
    });

    // Dashboard Profile
    Route::get('/my-profile', [UserController::class, 'showMyProfile'])->name('profil.index');
    Route::put('/my-profile', [UserController::class, 'updateMyProfile'])->name('profil.update');
    Route::post('/my-profile/password', [UserController::class, 'updatePassword'])->name('ubah-password');

    // Dashboard - Pengajuan Bank Sampah
    Route::get('/pengajuan-bank-sampah', [PengajuanBankSampahController::class, 'index'])->name('pengajuan-bank-sampah.index');

    // Dashboard - Kegiatan
    // Route::get('/my-kegiatan', function () {
    //     return view('/dashboard/my-kegiatan');
    // });
    Route::get('/my-kegiatan', [PendaftaranKegiatanController::class, 'index'])->name('my-kegiatan.index');

// Halaman daftar pesanan milik user (pembeli)
Route::get('/my-pesanan-produk', [PesananController::class, 'index'])->name('pesanan.index');

// Batalkan pesanan (hanya untuk pembeli, status menunggu)
Route::post('/pesanan/{id}/batalkan', [PesananController::class, 'batalkan'])->name('pesanan.batalkan');

// Halaman konfirmasi pesanan untuk bank sampah (status menunggu -> diterima/ditolak) 
Route::get('/konfirmasi-pesanan-produk', [PesananController::class, 'konfirmasiPesanan'])->name('konfirmasi.pesanan');

// Update status konfirmasi (menunggu -> diterima/ditolak)
Route::post('/pesanan/{id}/update-status-konfirmasi', [PesananController::class, 'updateStatusKonfirmasi'])->name('pesanan.update.status.konfirmasi');

// Halaman view pesanan yang sudah diterima (untuk bank sampah)
Route::get('/view-pesanan-produk', [PesananController::class, 'viewAcceptedOrders'])->name('dashboard.view-pesanan-produk');

// Update status pesanan lanjutan (diterima -> dikemas -> dikirim -> selesai)
Route::post('/pesanan/{id}/update-status', [PesananController::class, 'updateStatus'])->name('pesanan.update.status');

// Store purchase (untuk pembelian produk)
Route::post('/pesanan/store-purchase', [PesananController::class, 'storePurchase'])->name('pesanan.store.purchase');

    
    Route::patch('/penukaran/{id}/batalkan', [PenukaranController::class, 'batalkan'])->name('penukaran.batalkan');

 
    Route::get('/my-riwayat-pesanan-produk', function () {
        return view('/dashboard/my-riwayat-pesanan-produk');
    });

    Route::resource('artikel', ArtikelController::class);


    Route::get('/my-penukaran-hadiah', [PenukaranController::class, 'riwayat'])->name('penukaran.riwayat');


    // Rute untuk "Riwayat Penukaran Hadiah Saya"
Route::get('/my-riwayat-penukaran-hadiah', [PenukaranController::class, 'riwayatPenukaranSaya'])
    ->name('my-riwayat-penukaran-hadiah');

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD BANK SAMPAH ROUTES
    |--------------------------------------------------------------------------
    */

    // Bank Sampah - Setor Sampah
    Route::get('/add-setor-sampah', [TransaksiSampahController::class, 'create'])->name('transaksi-sampah.create');
    Route::post('/add-setor-sampah', [TransaksiSampahController::class, 'store'])->name('transaksi-sampah.store');
    Route::get('/riwayat-setor-sampah', [TransaksiSampahController::class, 'index'])->name('transaksi-sampah.index');
    
    // untuk search username
    Route::get('/search-username', [TransaksiSampahController::class, 'searchUsername'])->name('transaksi-sampah.search-username');

 Route::get('/add-produk', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/add-produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/view-produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
    




    
    Route::get('/riwayat-pesanan-produk', function () {
        return view('/dashboard/riwayat-pesanan-produk');
    });
});

// Dashboard routes yang menggunakan POST methods
Route::middleware(['auth'])->group(function () {
    Route::post('/pengajuan-bank-sampah', [PengajuanBankSampahController::class, 'store'])->name('pengajuan-bank-sampah.store');
    Route::post('/daftar-kegiatan', [HomeController::class, 'daftarKegiatan'])->name('daftar-kegiatan.daftarKegiatan');
});