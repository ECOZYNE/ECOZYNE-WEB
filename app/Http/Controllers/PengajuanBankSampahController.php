<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\PengajuanBankSampah;

class PengajuanBankSampahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $id_komunitas = $user->komunitas->id_komunitas ?? null;

        $lastPengajuan = PengajuanBankSampah::where('id_komunitas', $id_komunitas)
                                            ->latest()
                                            ->first();

        $canSubmitNewApplication = true;
        $rejectionNote = null;

        if ($lastPengajuan) {
            if (in_array($lastPengajuan->status, ['diproses', 'diterima'])) {
                $canSubmitNewApplication = false;
            } elseif ($lastPengajuan->status === 'ditolak') {
                $rejectionNote = $lastPengajuan->catatan;
            }
        }

        return view('dashboard.pengajuan-bank-sampah', compact(
            'canSubmitNewApplication',
            'rejectionNote',
            'lastPengajuan'
        ));
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

        $lastPengajuan = PengajuanBankSampah::where('id_komunitas', $user->komunitas->id_komunitas)
                                            ->latest()
                                            ->first();

        if ($lastPengajuan && in_array($lastPengajuan->status, ['diproses', 'diterima'])) {
            return redirect()->back()->with('error', 'Anda sudah memiliki pengajuan yang sedang diproses atau sudah diterima.');
        }

        $request->validate([
            'nama_bank_sampah' => [
                'required',
                'string',
                'max:255',
                Rule::unique('pengajuan_bank_sampah')->where(function ($query) {
                    return $query->where('status', '!=', 'ditolak');
                }),
            ],
            'file_dokumen' => 'required|mimes:pdf|max:15360',
            'lokasi_bank_sampah' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $filePath = $request->file('file_dokumen')->store('dokumen_pengajuan', 'public');

        PengajuanBankSampah::create([
            'id_komunitas'        => $user->komunitas->id_komunitas,
            'nama_bank_sampah'    => $request->nama_bank_sampah,
            'file_dokumen'        => $filePath,
            'lokasi_bank_sampah'  => $request->lokasi_bank_sampah,
            'latitude'            => $request->latitude,
            'longitude'           => $request->longitude,
            'catatan'             => null,
            'status'              => 'diproses',
         
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
