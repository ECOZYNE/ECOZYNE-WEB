<?php

namespace App\Http\Controllers;

use App\Models\Komunitas;
use App\Models\User;
use App\Models\Penukaran;
use App\Models\Transaksi_Sampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomunitasController extends Controller
{
    /**
     * Menampilkan dashboard dengan informasi poin komunitas pengguna.
     */
    public function index()
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        $totalPoints = 0;
        $expirationDate = 'N/A';
        $pointMasuk = collect();
        $pointKeluar = collect();

        if ($user) {
            // Load relasi komunitas dan point
            $user->load('komunitas.point');

            // Ambil data point jika tersedia
            $point = $user->komunitas->point ?? null;

            if ($point) {
                $totalPoints = $point->point ?? 0;
                $expirationDate = $point->expired_point
                    ? $point->expired_point->format('d M Y')
                    : 'N/A';
            }

            // Ambil riwayat setoran (point masuk)
            if ($user->komunitas) {
                $pointMasuk = Transaksi_Sampah::with('bank_sampah_penerima.pengajuanBankSampah')
                    ->where('id_komunitas', $user->komunitas->id_komunitas)
                    ->latest()
                    ->get();

                // Ambil riwayat penukaran (point keluar) dengan detail transaksi
                // Termasuk semua status (menunggu, diterima, dikemas, dikirim, selesai)
                $pointKeluar = Penukaran::with(['transaksi.hadiah'])
                    ->where('id_komunitas', $user->komunitas->id_komunitas)
                    ->whereIn('status_penukaran', ['menunggu', 'diterima', 'dikemas', 'dikirim', 'selesai'])
                    ->latest()
                    ->get()
                    ->map(function ($penukaran) {
                        // Hitung total point yang digunakan untuk penukaran ini
                        $totalPointKeluar = $penukaran->transaksi->map(function ($transaksi) {
                            return $transaksi->jumlah * $transaksi->point_satuan;
                        })->sum();

                        // Tambahkan informasi total point keluar ke object penukaran
                        $penukaran->total_point_keluar = $totalPointKeluar;

                        return $penukaran;
                    });
            }
        }

        return view('dashboard.index', compact('user', 'totalPoints', 'expirationDate', 'pointMasuk', 'pointKeluar'));
    }

    /**
     * Menampilkan formulir untuk membuat komunitas baru.
     */
    public function create()
    {
        return view('komunitas.create'); // Sesuaikan dengan file view kamu
    }

    /**
     * Menyimpan komunitas baru ke dalam database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            // Tambah validasi lainnya sesuai kebutuhan
        ]);

        Komunitas::create($request->all());

        return redirect()->route('komunitas.index')->with('success', 'Komunitas berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail komunitas tertentu.
     */
    public function show(Komunitas $komunitas)
    {
        return view('komunitas.show', compact('komunitas'));
    }

    /**
     * Menampilkan form edit komunitas.
     */
    public function edit(Komunitas $komunitas)
    {
        return view('komunitas.edit', compact('komunitas'));
    }

    /**
     * Memperbarui data komunitas.
     */
    public function update(Request $request, Komunitas $komunitas)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            // Tambah validasi lainnya sesuai kebutuhan
        ]);

        $komunitas->update($request->all());

        return redirect()->route('komunitas.index')->with('success', 'Komunitas berhasil diperbarui.');
    }

    /**
     * Menghapus komunitas.
     */
    public function destroy(Komunitas $komunitas)
    {
        $komunitas->delete();

        return redirect()->route('komunitas.index')->with('success', 'Komunitas berhasil dihapus.');
    }
}