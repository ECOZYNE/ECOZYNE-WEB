<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanBankSampah;
use Illuminate\Support\Facades\Auth;

class PengajuanBankSampahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        // Ambil id_komunitas dari user yang login
        $id_komunitas = $user->komunitas->id_komunitas ?? null;

        // Cek apakah sudah pernah mengajukan
        $sudahMengajukan = PengajuanBankSampah::where('id_komunitas', $id_komunitas)->exists();

        return view('dashboard.pengajuan-bank-sampah', compact('sudahMengajukan'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$user->komunitas) {
            return redirect()->back()->with('error', 'Akun tidak memiliki komunitas.');
        }

        $request->validate([
            'nama_bank_sampah' => 'required|string|max:255',
            'file_dokumen' => 'required|mimes:pdf|max:15360', // 15 MB
        ]);
        

        $filePath = $request->file('file_dokumen')->store('dokumen_pengajuan', 'public');

        PengajuanBankSampah::create([
            'id_komunitas' => $user->komunitas->id_komunitas,
            'nama_bank_sampah' => $request->nama_bank_sampah,
            'file_dokumen' => $filePath,
            'catatan' => null,
            'status' => 'diproses'
        ]);

        return redirect()->back()->with('success', 'Pengajuan berhasil dikirim.');
    }




    /**
     * Display the specified resource.
     */
    public function show(PengajuanBankSampah $pengajuanBankSampah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PengajuanBankSampah $pengajuanBankSampah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PengajuanBankSampah $pengajuanBankSampah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PengajuanBankSampah $pengajuanBankSampah)
    {
        //
    }
}
