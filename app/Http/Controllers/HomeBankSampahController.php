<?php

namespace App\Http\Controllers;

use App\Models\BankSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeBankSampahController extends Controller
{
    public function index()
    {
        // Eager load the BankSampah's own address and its nested relations
        // We also eager load pengajuanBankSampah as it's used for the bank's name.
        $bankSampahs = BankSampah::with([
                                'alamat.kelurahan.kecamatan', // This is the primary path for Bank Sampah's address
                                'pengajuanBankSampah' // Needed for nama_bank_sampah
                            ])
                            ->whereHas('pengajuanBankSampah', function ($query) {
                                $query->where('status', 'diterima');
                            })
                            ->orderByDesc('created_at') 
                            ->get();

        $sudahMengajukan = false;
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->komunitas) {
                $sudahMengajukan = $user->komunitas->pengajuanBankSampah()->where('status', 'pending')->exists();
            }
        }

        return view('bank_sampah', compact('bankSampahs', 'sudahMengajukan'));
    }

    public function show($id)
    {
        // Eager load relationships for the detail page as well
        $bankSampah = BankSampah::with([
                                'pengajuanBankSampah.komunitas', // Full chain for Komunitas address if needed for detail
                                'alamat.kelurahan.kecamatan', // Direct Bank Sampah address
                                'produks'
                            ])
                            ->findOrFail($id);

        return view('bank_sampah_detail', compact('bankSampah'));
    }
}