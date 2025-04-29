<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class HomeKegiatanController extends Controller
{
    public function index()
    {
        // Ambil 6 kegiatan terbaru berdasarkan created_at
        $homekegiatan = Kegiatan::latest()->take(6)->get();
        
        return view('index', compact('homekegiatan')); // Pastikan 'homekegiatan' disesuaikan
    }
    
    
}
