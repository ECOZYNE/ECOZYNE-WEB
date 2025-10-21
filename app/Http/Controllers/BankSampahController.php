<?php

namespace App\Http\Controllers;

use App\Models\BankSampah;
use Illuminate\Http\Request;

class BankSampahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $BankSampah = BankSampah::with('jamOperasional')->get();
        return view('admin.view-bank-sampah', compact('BankSampah'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BankSampah $bankSampah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BankSampah $bankSampah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BankSampah $bankSampah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Cari bank sampah berdasarkan id
        $bankSampah = BankSampah::findOrFail($id);

        // Hapus bank sampah terlebih dahulu (yang punya foreign key ke pengajuan)
        $bankSampah->delete();

        // Setelah itu hapus pengajuan bank sampah yang terkait
        $pengajuan = $bankSampah->pengajuanBankSampah;
        if ($pengajuan) {
            $pengajuan->delete();
        }

        return redirect()->route('bank-sampah.index')->with('success', 'Data bank sampah dan pengajuannya berhasil dihapus.');
    }
}
