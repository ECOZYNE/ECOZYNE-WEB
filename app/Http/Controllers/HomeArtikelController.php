<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel; // Tetap menggunakan model 'Artikel'

class HomeArtikelController extends Controller
{
    /**

     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil 4 artikel terbaru, diurutkan berdasarkan tanggal pembuatan secara menurun
        // Gunakan nama variabel $artikels untuk koleksi (plural)
        $artikels = Artikel::orderBy('created_at', 'desc')->take(4)->get();

        // Ambil artikel terbaru untuk sidebar (2 artikel berikutnya setelah 4 artikel utama)
        $recentPosts = Artikel::orderBy('created_at', 'desc')->skip(4)->take(2)->get();

        // Mengirimkan data ke view 'artikel'
        // Pastikan nama di compact() sama dengan nama variabel yang Anda gunakan
        return view('artikel', compact('artikels', 'recentPosts')); // Menggunakan 'artikels'
    }

    /**
     * Menampilkan detail satu artikel.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Cari artikel berdasarkan ID atau tampilkan 404 jika tidak ditemukan
        // Gunakan nama variabel $artikel untuk objek tunggal (singular)
        $artikel = Artikel::findOrFail($id);

        // Ambil artikel terbaru untuk sidebar pada halaman detail artikel juga
        $recentPosts = Artikel::orderBy('created_at', 'desc')->take(2)->get();

        // Mengirimkan data ke view 'artikel_detail'
        // Pastikan nama di compact() sama dengan nama variabel yang Anda gunakan
        return view('artikel_detail', compact('artikel', 'recentPosts')); // Menggunakan 'artikel'
    }
}