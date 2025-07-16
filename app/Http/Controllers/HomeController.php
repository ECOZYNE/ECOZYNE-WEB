<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\Artikel;
use App\Models\Kegiatan;
use App\Models\Komunitas;
use App\Models\BankSampah;
use App\Models\Hadiah; // Make sure Hadiah model is imported
use App\Models\Point; // Make sure Point model is imported
use Illuminate\Http\Request;
use App\Models\PendaftaranKegiatan;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $jumlahKomunitas = Komunitas::count();
        $jumlahBanksampah = BankSampah::count();
        $jumlahArtikel = Artikel::count();
        $jumlahKegiatan = Kegiatan::count();

        $kegiatanterbaru = Kegiatan::latest()->take(6)->get();
        $artikelterbaru = Artikel::latest()->take(3)->get();
        $galeri = Galeri::latest()->take(12)->get();

        // --- Bagian untuk Katalog Hadiah di Halaman Utama (8 terbaru) ---
        $hadiah = Hadiah::latest()->take(8)->get();
        $loggedIn = Auth::check(); // Cek apakah pengguna sudah login
        $userPoints = 0; // Inisialisasi poin pengguna

        if ($loggedIn) {
            $user = Auth::user();
            $komunitasUser = Komunitas::where('id_user', $user->id_user)->first();

            if ($komunitasUser) {
                $pointData = Point::where('id_komunitas', $komunitasUser->id_komunitas)->first();
                if ($pointData) {
                    $userPoints = $pointData->point;
                }
            }
        }
        // --- Akhir Bagian Katalog Hadiah Halaman Utama ---

        return view('index', compact(
            'jumlahKomunitas',
            'jumlahBanksampah',
            'jumlahArtikel',
            'jumlahKegiatan',
            'kegiatanterbaru',
            'artikelterbaru',
            'galeri',
            'hadiah',
            'loggedIn',
            'userPoints'
        ));
    }

    /**
     * Display all available prizes for the /hadiah page.
     */
    public function hadiah()
    {
        // Fetch all prizes without any 'take' limit
        $hadiah = Hadiah::latest()->get(); // Get all prizes, ordered by latest

        $loggedIn = Auth::check();
        $userPoints = 0;

        if ($loggedIn) {
            $user = Auth::user();
            $komunitasUser = Komunitas::where('id_user', $user->id_user)->first();

            if ($komunitasUser) {
                $pointData = Point::where('id_komunitas', $komunitasUser->id_komunitas)->first();
                if ($pointData) {
                    $userPoints = $pointData->point;
                }
            }
        }

        // Pass all prizes, login status, and user points to the 'hadiah' view
        return view('hadiah', compact('hadiah', 'loggedIn', 'userPoints'));
    }

    // ... (rest of your existing methods like daftarKegiatan, show, etc.)
    public function daftarKegiatan(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Anda harus login terlebih dahulu.');
        }

        $user = Auth::user();
        $komunitas = Komunitas::where('id_user', $user->id_user)->first();

        if (!$komunitas) {
            return redirect()->back()->with('error', 'Anda belum tergabung dalam komunitas.');
        }

        $request->validate([
            'id_kegiatan' => 'required|exists:kegiatan,id_kegiatan',
        ]);

        $sudahTerdaftar = PendaftaranKegiatan::where('id_komunitas', $komunitas->id_komunitas)
            ->where('id_kegiatan', $request->id_kegiatan)
            ->exists();

        if ($sudahTerdaftar) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar di kegiatan ini.');
        }

        $kegiatan = Kegiatan::find($request->id_kegiatan);

        if ($kegiatan->kouta <= 0) {
            return redirect()->back()->with('error', 'Kuota kegiatan sudah habis.');
        }

        PendaftaranKegiatan::create([
            'id_komunitas' => $komunitas->id_komunitas,
            'id_kegiatan' => $request->id_kegiatan,
        ]);

        $kegiatan->kouta -= 1;
        $kegiatan->save();

        return redirect()->back()
            ->with('success', 'Berhasil mendaftar kegiatan.')
            ->with('sweet_alert', [
                'type' => 'success',
                'message' => 'Anda berhasil mengikuti kegiatan ini!',
                'scroll_to' => 'services'
            ]);
    }

    public function show($id)
    {
        $artikel = Artikel::findOrFail($id);
        $recentPosts = Artikel::where('id_artikel', '!=', $id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        return view('artikel-details', compact('artikel', 'recentPosts'));
    }
}