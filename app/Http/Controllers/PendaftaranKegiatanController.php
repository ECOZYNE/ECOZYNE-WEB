<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendaftaranKegiatan;
use App\Models\Komunitas;
use Illuminate\Support\Facades\Auth;

class PendaftaranKegiatanController extends Controller
{

    public function index()
    {
        // Ambil user login
        $idUser = Auth::user()->id_user;

        // Ambil data komunitas milik user ini
        $komunitas = Komunitas::where('id_user', $idUser)->first();

        if (!$komunitas) {
            // Handle jika user belum punya komunitas
            return redirect()->back()->with('error', 'Data komunitas tidak ditemukan.');
        }

        // Ambil pendaftaran berdasarkan id_komunitas
        $pendaftaran = PendaftaranKegiatan::where('id_komunitas', $komunitas->id_komunitas)
            ->latest()
            ->get();

        return view('dashboard.my-kegiatan', compact('pendaftaran'));
    }




    public function store(Request $request)
    {
        $request->validate([
            'id_komunitas' => 'required|exists:komunitas,id_komunitas',
            'id_kegiatan' => 'required|exists:kegiatan,id_kegiatan',
        ]);

        // Cek apakah sudah pernah mendaftar
        $sudahTerdaftar = PendaftaranKegiatan::where('id_komunitas', $request->id_komunitas)
            ->where('id_kegiatan', $request->id_kegiatan)
            ->exists();

        if ($sudahTerdaftar) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar pada kegiatan ini.');
        }

        PendaftaranKegiatan::create([
            'id_komunitas' => $request->id_komunitas,
            'id_kegiatan' => $request->id_kegiatan,
        ]);

        return redirect()->back()->with('success', 'Berhasil mendaftar kegiatan.');
    }
}

