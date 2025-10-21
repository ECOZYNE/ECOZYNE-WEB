<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\ArtikelApiController;
use App\Http\Controllers\Api\KegiatanApiController;
use App\Http\Controllers\Api\GaleriApiController;
use App\Http\Controllers\Api\HadiahApiController;
use App\Http\Controllers\Api\KomikApiController;
use App\Http\Controllers\Api\PendaftaranKegiatanApiController;
use App\Http\Controllers\Api\BankSampahApiController;
use App\Http\Controllers\Api\PengajuanBankSampahApiController;
use Illuminate\Support\Facades\Http;


Route::get('/notifikasi', function () {
    $url = 'https://ecozyne-best-default-rtdb.asia-southeast1.firebasedatabase.app/notifikasi.json';
    $response = Http::get($url);

    if ($response->failed()) {
        return response()->json(['error' => 'Gagal mengambil data dari Firebase'], 500);
    }

    $data = $response->json();

    return response()->json($data);
});


/*
|--------------------------------------------------------------------------
| Authentication API Routes
|--------------------------------------------------------------------------
*/
Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/logout', [AuthApiController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/profile', [AuthApiController::class, 'profile'])->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->get('/home', [AuthApiController::class, 'home']);

/*
|--------------------------------------------------------------------------
| Artikel API Routes
|--------------------------------------------------------------------------
*/
Route::get('/artikels', [ArtikelApiController::class, 'index']);
Route::get('/artikels/{id}', [ArtikelApiController::class, 'show']);

/*
|--------------------------------------------------------------------------
| Kegiatan API Routes
|--------------------------------------------------------------------------
*/
Route::get('/kegiatans', [KegiatanApiController::class, 'index']);
Route::get('/kegiatans/{id}', [KegiatanApiController::class, 'show']);
Route::get('/kegiatans-upcoming', [KegiatanApiController::class, 'upcoming']);
Route::get('/kegiatans-latest/{limit?}', [KegiatanApiController::class, 'latest']);

/*
|--------------------------------------------------------------------------
| Pendaftaran Kegiatan API Routes (Protected)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {
    // Get my registrations
    Route::get('/pendaftaran-kegiatan', [PendaftaranKegiatanApiController::class, 'index']);

    // Register for activity
    Route::post('/pendaftaran-kegiatan', [PendaftaranKegiatanApiController::class, 'store']);

    // Get detail of registration
    Route::get('/pendaftaran-kegiatan/{id}', [PendaftaranKegiatanApiController::class, 'show']);

    // Cancel registration
    Route::delete('/pendaftaran-kegiatan/{id}', [PendaftaranKegiatanApiController::class, 'destroy']);

    // Get available activities (not registered yet)
    Route::get('/kegiatan-tersedia', [PendaftaranKegiatanApiController::class, 'available']);

    // Check if already registered for specific activity
    Route::get('/cek-pendaftaran/{id_kegiatan}', [PendaftaranKegiatanApiController::class, 'checkRegistration']);
});

/*
|--------------------------------------------------------------------------
| Galeri API Routes
|--------------------------------------------------------------------------
*/
Route::get('/galeris', [GaleriApiController::class, 'index']);
Route::get('/galeris/{id}', [GaleriApiController::class, 'show']);
Route::get('/galeris-latest/{limit?}', [GaleriApiController::class, 'latest']);

/*
|--------------------------------------------------------------------------
| Hadiah API Routes
|--------------------------------------------------------------------------
*/
Route::get('/hadiahs', [HadiahApiController::class, 'index']);
Route::get('/hadiahs/{id}', [HadiahApiController::class, 'show']);
Route::get('/hadiahs-available', [HadiahApiController::class, 'available']);
Route::get('/hadiahs-latest/{limit?}', [HadiahApiController::class, 'latest']);
Route::get('/hadiahs-by-point', [HadiahApiController::class, 'byPoint']);

/*
|--------------------------------------------------------------------------
| Komik API Routes
|--------------------------------------------------------------------------
*/
Route::get('/komik', [KomikApiController::class, 'index']);
Route::get('/komik/{id}', [KomikApiController::class, 'show']);
/*
|--------------------------------------------------------------------------
| Bank Sampah API Routes (Public)
|--------------------------------------------------------------------------
*/
Route::get('/bank-sampahs', [BankSampahApiController::class, 'index']);
Route::get('/bank-sampahs/{id}', [BankSampahApiController::class, 'show']);
Route::get('/bank-sampahs/{id}/with-products', [BankSampahApiController::class, 'withProducts']);
Route::get('/bank-sampahs/{id}/statistics', [BankSampahApiController::class, 'statistics']);
Route::get('/bank-sampahs-nearest', [BankSampahApiController::class, 'nearest']);

/*
|--------------------------------------------------------------------------
| Pengajuan Bank Sampah API Routes (Protected)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {
    // Get all pengajuan for user's komunitas
    Route::get('/pengajuan-bank-sampahs', [PengajuanBankSampahApiController::class, 'index']);

    // Create new pengajuan
    Route::post('/pengajuan-bank-sampahs', [PengajuanBankSampahApiController::class, 'store']);

    // Get specific pengajuan detail
    Route::get('/pengajuan-bank-sampahs/{id}', [PengajuanBankSampahApiController::class, 'show']);

    // Check status of latest pengajuan
    Route::get('/pengajuan-bank-sampahs-status', [PengajuanBankSampahApiController::class, 'status']);
});
