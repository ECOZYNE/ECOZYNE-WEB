<?php

namespace App\Http\Controllers;

use App\Models\Komunitas;
use App\Models\BankSampah;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        // Total Komunitas
        $totalKomunitas = Komunitas::count();

        // Total Bank Sampah (hitung saja totalnya, tidak perlu relasi untuk statistik ini)
        $totalBankSampah = BankSampah::count();

        // Data untuk chart
        $kecamatans = Kecamatan::all();
        $labels = $kecamatans->pluck('kecamatan')->toArray();

        $komunitasData = [];
        $bankSampahData = [];

        foreach ($kecamatans as $kecamatan) {
            // Menghitung jumlah komunitas per kecamatan
            $komunitasCount = Komunitas::whereHas('alamat.kelurahan', function ($query) use ($kecamatan) {
                $query->where('id_kecamatan', $kecamatan->id_kecamatan);
            })->count();
            $komunitasData[] = $komunitasCount;

            // MENGUBAH QUERY INI: Menghitung jumlah bank sampah per kecamatan
            // Menelusuri relasi: BankSampah -> PengajuanBankSampah -> Komunitas -> Alamat -> Kelurahan
            $bankSampahCount = BankSampah::whereHas('pengajuanBankSampah.komunitas.alamat.kelurahan', function ($query) use ($kecamatan) {
                $query->where('id_kecamatan', $kecamatan->id_kecamatan);
            })->count();
            $bankSampahData[] = $bankSampahCount;
        }

       $colors = [
    '#FF6384', // Merah Muda Cerah
    '#36A2EB', // Biru Langit
    '#FFCE56', // Kuning Cerah
    '#4BC0C0', // Teal
    '#9966FF', // Ungu
    '#FF9F40', // Oranye Terang
    '#C9CBCE', // Abu-abu Terang
    '#8BC34A', // Hijau Limau
    '#E91E63', // Merah Jambu Gelap
    '#00BCD4', // Cyan
    '#FFC107', // Amber
    '#673AB7', // Ungu Tua
    '#FF5722', // Oranye Merah
    '#03A9F4', // Biru Cerah
    '#795548', // Coklat
    '#607D8B', // Biru Keabu-abuan
];

        return view('admin.index', compact(
            'totalKomunitas',
            'totalBankSampah',
            'labels',
            'komunitasData',
            'bankSampahData',
            'colors'
        ));
    }
}