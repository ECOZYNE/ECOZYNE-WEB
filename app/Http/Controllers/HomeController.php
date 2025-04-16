<?php

namespace App\Http\Controllers;

use App\Models\Komunitas;
use App\Models\Artikel;
use App\Models\Kegiatan;


class HomeController extends Controller
{
    public function index()
    {
        $jumlahKomunitas = Komunitas::count();
        $jumlahArtikel = Artikel::count();
        $jumlahKegiatan = Kegiatan::count();


        return view('index', compact('jumlahKomunitas', 'jumlahArtikel', 'jumlahKegiatan'));
    }
}
