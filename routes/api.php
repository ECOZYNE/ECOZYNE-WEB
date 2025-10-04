<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\ArtikelApiController;
use App\Http\Controllers\Api\KegiatanApiController;
use App\Http\Controllers\Api\GaleriApiController;
use App\Http\Controllers\Api\HadiahApiController;

// Login API
Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/logout', [AuthApiController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/profile', [AuthApiController::class, 'profile'])->middleware('auth:sanctum');

// Artikel API Routes
Route::get('/artikels', [ArtikelApiController::class, 'index']);
Route::get('/artikels/{id}', [ArtikelApiController::class, 'show']);

// Kegiatan API Routes
Route::get('/kegiatans', [KegiatanApiController::class, 'index']);
Route::get('/kegiatans/{id}', [KegiatanApiController::class, 'show']);
Route::get('/kegiatans-upcoming', [KegiatanApiController::class, 'upcoming']);
Route::get('/kegiatans-latest/{limit?}', [KegiatanApiController::class, 'latest']);

// Galeri API Routes
Route::get('/galeris', [GaleriApiController::class, 'index']);
Route::get('/galeris/{id}', [GaleriApiController::class, 'show']);
Route::get('/galeris-latest/{limit?}', [GaleriApiController::class, 'latest']);

// Hadiah API Routes
Route::get('/hadiahs', [HadiahApiController::class, 'index']);
Route::get('/hadiahs/{id}', [HadiahApiController::class, 'show']);
Route::get('/hadiahs-available', [HadiahApiController::class, 'available']);
Route::get('/hadiahs-latest/{limit?}', [HadiahApiController::class, 'latest']);
Route::get('/hadiahs-by-point', [HadiahApiController::class, 'byPoint']);