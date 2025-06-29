<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;

class HomeArtikelController extends Controller
{
    /**
     * Display a listing of all articles without pagination or search (as per your request).
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil semua artikel, diurutkan berdasarkan tanggal pembuatan secara menurun
        $allartikel = Artikel::latest()->get();

        // Ambil artikel terbaru untuk sidebar (6 artikel terbaru)
        $recentPosts = Artikel::orderBy('created_at', 'desc')->take(6)->get();

        // Mengirimkan data ke view 'artikel' (katalog format)
        return view('artikel', compact('allartikel', 'recentPosts'));
    }

    /**
     * Display the specified article detail.
     *
     * @param  int  $id The ID of the article to display.
     * @return \Illuminate\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        // Find the article by its ID, or abort with a 404 if not found.
        $artikel = Artikel::findOrFail($id);

        // Get recent posts for the sidebar on the detail page, excluding the current article.
        $recentPosts = Artikel::where('id_artikel', '!=', $id)
                               ->orderBy('created_at', 'desc')
                               ->take(5) // Adjust as needed
                               ->get();

 
        // Pass the single article, recent posts, and related articles to the 'artikel-detail' view.
        return view('artikel-details', compact('artikel', 'recentPosts'));
    }
}