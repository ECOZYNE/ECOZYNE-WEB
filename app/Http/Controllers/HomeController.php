<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Komunitas;
use App\Models\Artikel;
use App\Models\Kegiatan;
use App\Models\Galeri; 


class HomeController extends Controller
{
 public function index()
{
    $jumlahKomunitas = Komunitas::count();
    $jumlahArtikel = Artikel::count();
    $jumlahKegiatan = Kegiatan::count();

    $kegiatanterbaru = Kegiatan::latest()->take(6)->get();
    $artikelterbaru = Artikel::latest()->take(3)->get();
    $galeri = Galeri::latest()->take(12)->get(); // Ambil max 12 foto terbaru

    return view('index', compact(
        'jumlahKomunitas',
        'jumlahArtikel',
        'jumlahKegiatan',
        'kegiatanterbaru',
        'artikelterbaru',
        'galeri' // kirim ke view
    ));
}


}