<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\Artikel;
use App\Models\Kegiatan;
use App\Models\komunitas;
use App\Models\BankSampah;
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

        return view('index', compact(
            'jumlahKomunitas',
            'jumlahBanksampah', 
            'jumlahArtikel',
            'jumlahKegiatan',
            'kegiatanterbaru',
            'artikelterbaru',
            'galeri'
        ));
    }

//     public function daftarKegiatan(Request $request)
//     {
//         if (!Auth::check()) {
//             return redirect()->back()->with('error', 'Anda harus login terlebih dahulu.');
//         }

//         // Ambil user yang login
//         $user = Auth::user();

//         // Ambil id_komunitas dari relasi dengan komunitas
//         $komunitas = komunitas::where('id_user', $user->id_user)->first();

//         if (!$komunitas) {
//             return redirect()->back()->with('error', 'Anda belum tergabung dalam komunitas.');
//         }

//         $request->validate([
//             'id_kegiatan' => 'required|exists:kegiatan,id_kegiatan',
//         ]);

//         // Cek apakah sudah terdaftar
//         $sudahTerdaftar = PendaftaranKegiatan::where('id_komunitas', $komunitas->id_komunitas)
//             ->where('id_kegiatan', $request->id_kegiatan)
//             ->exists();

//         if ($sudahTerdaftar) {
//             return redirect()->back()->with('error', 'Anda sudah terdaftar di kegiatan ini.');
//         }

//         // Simpan pendaftaran
//         PendaftaranKegiatan::create([
//             'id_komunitas' => $komunitas->id_komunitas,
//             'id_kegiatan' => $request->id_kegiatan,
//         ]);

// return redirect()->back()->with('success', 'Berhasil mendaftar kegiatan.');
//     }



public function daftarKegiatan(Request $request)
{
    if (!Auth::check()) {
        return redirect()->back()->with('error', 'Anda harus login terlebih dahulu.');
    }

    // Ambil user yang login
    $user = Auth::user();

    // Ambil id_komunitas dari relasi dengan komunitas
    $komunitas = komunitas::where('id_user', $user->id_user)->first();

    if (!$komunitas) {
        return redirect()->back()->with('error', 'Anda belum tergabung dalam komunitas.');
    }

    $request->validate([
        'id_kegiatan' => 'required|exists:kegiatan,id_kegiatan',
    ]);

    // Cek apakah sudah terdaftar
    $sudahTerdaftar = PendaftaranKegiatan::where('id_komunitas', $komunitas->id_komunitas)
        ->where('id_kegiatan', $request->id_kegiatan)
        ->exists();

    if ($sudahTerdaftar) {
        return redirect()->back()->with('error', 'Anda sudah terdaftar di kegiatan ini.');
    }

    // Ambil data kegiatan
    $kegiatan = Kegiatan::find($request->id_kegiatan);

    // Cek apakah kouta masih tersedia
    if ($kegiatan->kouta <= 0) {
        return redirect()->back()->with('error', 'Kuota kegiatan sudah habis.');
    }

    // Simpan pendaftaran
    PendaftaranKegiatan::create([
        'id_komunitas' => $komunitas->id_komunitas,
        'id_kegiatan' => $request->id_kegiatan,
    ]);

    // Kurangi kouta kegiatan
    $kegiatan->kouta -= 1;
    $kegiatan->save();

    return redirect()->back()->with('success', 'Berhasil mendaftar kegiatan.');
}

}
