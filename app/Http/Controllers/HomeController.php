<?php

namespace App\Http\Controllers;

use App\Models\Komunitas;
use App\Models\Artikel;

class HomeController extends Controller
{
    public function index()
    {
        $jumlahKomunitas = Komunitas::count();
        $jumlahArtikel = Artikel::count();

        return view('index', compact('jumlahKomunitas', 'jumlahArtikel'));
    }
}
