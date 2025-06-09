<?php

namespace App\Http\Controllers;

use App\Models\transaksi_sampah;
use App\Models\Komunitas;
use App\Models\Point;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransaksiSampahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $komunitas = Komunitas::where('id_user', $user->id_user)->first();
        
        $transaksi = transaksi_sampah::with(['komunitas_penyetor', 'komunitas_penerima'])
            ->where('id_komunitas_penerima', $komunitas->id_komunitas)
            ->orderBy('tanggal_transaksi', 'desc')
            ->get();
            
        return view('dashboard.riwayat-setor-sampah', compact('transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.add-setor-sampah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'berat_sampah' => 'required|numeric|min:0.1',
        ], [
            'username.required' => 'Username harus dipilih',
            'berat_sampah.required' => 'Berat sampah harus diisi',
            'berat_sampah.min' => 'Berat sampah minimal 0.1 kg',
        ]);

        try {
            DB::beginTransaction();

            $user_bank_sampah = Auth::user();
            $komunitas_bank_sampah = Komunitas::where('id_user', $user_bank_sampah->id_user)->first();

            if (!$komunitas_bank_sampah) {
                return redirect()->back()->with('error', 'Data komunitas bank sampah tidak ditemukan');
            }

            // Cari komunitas penyetor berdasarkan username
            $user_penyetor = User::where('username', $request->username)->first();
            
            if (!$user_penyetor) {
                return redirect()->back()->with('error', 'Username tidak ditemukan');
            }

            $komunitas_penyetor = Komunitas::where('id_user', $user_penyetor->id_user)->first();

            if (!$komunitas_penyetor) {
                return redirect()->back()->with('error', 'Data komunitas penyetor tidak ditemukan');
            }

            // Cek apakah bank sampah mencoba setor ke dirinya sendiri
            if ($komunitas_bank_sampah->id_komunitas == $komunitas_penyetor->id_komunitas) {
                return redirect()->back()->with('error', 'Tidak dapat menyetor sampah ke komunitas sendiri');
            }

            // Hitung poin (1 kg = 10 poin)
            $poin_didapat = $request->berat_sampah * 10;

            // Simpan transaksi sampah
            $transaksi = transaksi_sampah::create([
                'id_komunitas_penyetor' => $komunitas_penyetor->id_komunitas,
                'id_komunitas_penerima' => $komunitas_bank_sampah->id_komunitas,
                'berat_sampah' => $request->berat_sampah,
                'poin_didapat' => $poin_didapat,
                'tanggal_transaksi' => now(),
                'status' => 'selesai'
            ]);

            // Update poin komunitas penyetor
            $point_komunitas = Point::where('id_komunitas', $komunitas_penyetor->id_komunitas)->first();
            
            if ($point_komunitas) {
                $point_komunitas->increment('point', $poin_didapat);
                
                // Update expired_point jika diperlukan (perpanjang 1 tahun dari sekarang)
                $point_komunitas->update([
                    'expired_point' => now()->addYear()
                ]);
            } else {
                // Jika belum ada record point, buat baru
                Point::create([
                    'id_komunitas' => $komunitas_penyetor->id_komunitas,
                    'point' => $poin_didapat,
                    'expired_point' => now()->addYear(),
                ]);
            }

            DB::commit();

            return redirect()->back()->with('success', 
                "Setoran sampah berhasil! {$request->berat_sampah} kg sampah dari {$request->username} = {$poin_didapat} poin"
            );

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error creating transaksi sampah: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan setoran sampah');
        }
    }

    /**
     * Search username for dropdown/autocomplete
     */
    public function searchUsername(Request $request)
    {
        $query = $request->get('q');
        $user_bank_sampah = Auth::user();
        $komunitas_bank_sampah = Komunitas::where('id_user', $user_bank_sampah->id_user)->first();

        if (!$query) {
            return response()->json([]);
        }

        // Cari username yang mengandung query, tapi bukan bank sampah sendiri
        $users = User::where('username', 'LIKE', "%{$query}%")
            ->where('role', 'komunitas')
            ->where('id_user', '!=', $user_bank_sampah->id_user)
            ->with('komunitas')
            ->limit(10)
            ->get();

        $results = $users->map(function($user) {
            return [
                'username' => $user->username,
                'email' => $user->email,
                'nama' => $user->komunitas->nama ?? '',
                'no_telp' => $user->komunitas->no_telp ?? '',
            ];
        });

        return response()->json($results);
    }

    /**
     * Display the specified resource.
     */
    public function show(transaksi_sampah $transaksi_sampah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(transaksi_sampah $transaksi_sampah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, transaksi_sampah $transaksi_sampah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(transaksi_sampah $transaksi_sampah)
    {
        //
    }
}