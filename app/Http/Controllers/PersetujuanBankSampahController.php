<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PengajuanBankSampah;

class PersetujuanBankSampahController extends Controller
{
    public function index()
    {
        $sudahMengajukan = PengajuanBankSampah::orderBy('id_pengajuan_bank_sampah', 'desc')->get();
        return view('admin.persetujuaan-bank-sampah', compact('sudahMengajukan'));
    }

    public function updatePersetujuan(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diterima,ditolak',
            'catatan' => 'nullable|string|max:1000',
        ]);

        $pengajuan = PengajuanBankSampah::findOrFail($id);

        $pengajuan->update([
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);

        // Jika status diterima, insert ke tabel bank_sampah jika belum ada
        if ($request->status === 'diterima') {
            $sudahAda = DB::table('bank_sampah')->where('id_pengajuan_bank_sampah', $pengajuan->id_pengajuan_bank_sampah)->exists();

            if (!$sudahAda) {
                DB::table('bank_sampah')->insert([
                    'id_pengajuan_bank_sampah' => $pengajuan->id_pengajuan_bank_sampah,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'Pengajuan berhasil diperbarui.');
    }




}
