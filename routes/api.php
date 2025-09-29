<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArtikelApiController;
use App\Http\Controllers\Api\KegiatanApiController;

// Artikel API Routes
Route::get('/artikels', [ArtikelApiController::class, 'index']);
Route::get('/artikels/{id}', [ArtikelApiController::class, 'show']);

// Kegiatan API Routes
Route::get('/kegiatans', [KegiatanApiController::class, 'index']);
Route::get('/kegiatans/{id}', [KegiatanApiController::class, 'show']);
Route::get('/kegiatans-upcoming', [KegiatanApiController::class, 'upcoming']);
Route::get('/kegiatans-latest/{limit?}', [KegiatanApiController::class, 'latest']);