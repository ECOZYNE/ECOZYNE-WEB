<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\Artikel;
use App\Models\Kegiatan;
use App\Models\Komunitas;
use App\Models\BankSampah;
use App\Models\Hadiah;
use App\Models\Point;
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

        // --- Bagian untuk Katalog Hadiah ---
        $hadiah = Hadiah::latest()->take(6)->get();
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
        // --- Akhir Bagian Katalog Hadiah ---

        return view('index', compact(
            'jumlahKomunitas',
            'jumlahBanksampah',
            'jumlahArtikel',
            'jumlahKegiatan',
            'kegiatanterbaru',
            'artikelterbaru',
            'galeri',
            'hadiah',
            'loggedIn',     // Pastikan ini selalu diteruskan ke view
            'userPoints'
        ));
    }

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
}