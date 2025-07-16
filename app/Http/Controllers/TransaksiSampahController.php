<?php

namespace App\Http\Controllers;

use App\Models\Transaksi_Sampah;
use App\Models\Komunitas;
use App\Models\Point;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon; // Tambahkan import Carbon

class TransaksiSampahController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $komunitas = Komunitas::where('id_user', $user->id_user)->first();

        if (!$komunitas) {
            return redirect()->route('dashboard.index')->with('error', 'Data komunitas tidak ditemukan.');
        }

        $pengajuan = DB::table('pengajuan_bank_sampah')
            ->where('id_komunitas', $komunitas->id_komunitas)
            ->where('status', 'diterima')
            ->first();

        if (!$pengajuan) {
            return redirect()->route('dashboard.index')->with('error', 'Anda belum diterima sebagai bank sampah.');
        }

        $bank_sampah = DB::table('bank_sampah')
            ->where('id_pengajuan_bank_sampah', $pengajuan->id_pengajuan_bank_sampah)
            ->first();

        if (!$bank_sampah) {
            return redirect()->route('dashboard.index')->with('error', 'Data bank sampah tidak ditemukan.');
        }

        $transaksi = Transaksi_Sampah::with(['komunitas_penyetor.user', 'bank_sampah_penerima'])
            ->byBankSampah($bank_sampah->id_bank_sampah)
            ->latest()
            ->get();

        $today = now()->startOfDay();
        $startOfWeek = now()->startOfWeek();
        $startOfMonth = now()->startOfMonth();
        $startOfYear = now()->startOfYear();

        $summaryData = [
            'hari_ini' => [
                'transaksi' => $transaksi->where('created_at', '>=', $today)->count(),
                'berat' => $transaksi->where('created_at', '>=', $today)->sum('berat_sampah'),
            ],
            'minggu_ini' => [
                'transaksi' => $transaksi->where('created_at', '>=', $startOfWeek)->count(),
                'berat' => $transaksi->where('created_at', '>=', $startOfWeek)->sum('berat_sampah'),
            ],
            'bulan_ini' => [
                'transaksi' => $transaksi->where('created_at', '>=', $startOfMonth)->count(),
                'berat' => $transaksi->where('created_at', '>=', $startOfMonth)->sum('berat_sampah'),
            ],
            'tahun_ini' => [
                'transaksi' => $transaksi->where('created_at', '>=', $startOfYear)->count(),
                'berat' => $transaksi->where('created_at', '>=', $startOfYear)->sum('berat_sampah'),
            ],
            'semua' => [
                'transaksi' => $transaksi->count(),
                'berat' => $transaksi->sum('berat_sampah'),
            ],
        ];

        return view('dashboard.riwayat-setor-sampah', compact('transaksi', 'summaryData'));
    }

    public function statistik()
    {
        try {
            // Mendapatkan user dan bank sampah yang sedang login
            $user = Auth::user();
            $komunitas = Komunitas::where('id_user', $user->id_user)->first();

            if (!$komunitas) {
                return response()->json(['error' => 'Data komunitas tidak ditemukan.'], 404);
            }

            $pengajuan = DB::table('pengajuan_bank_sampah')
                ->where('id_komunitas', $komunitas->id_komunitas)
                ->where('status', 'diterima')
                ->first();

            if (!$pengajuan) {
                return response()->json(['error' => 'Anda belum diterima sebagai bank sampah.'], 404);
            }

            $bank_sampah = DB::table('bank_sampah')
                ->where('id_pengajuan_bank_sampah', $pengajuan->id_pengajuan_bank_sampah)
                ->first();

            if (!$bank_sampah) {
                return response()->json(['error' => 'Data bank sampah tidak ditemukan.'], 404);
            }

            // Mendapatkan data untuk bulan ini
            $bulanIni = Carbon::now()->startOfMonth();
            $akhirBulan = Carbon::now()->endOfMonth();
            
            // Summary data untuk bulan ini (tanpa poin)
            $summaryBulan = DB::table('transaksi_sampah')
                ->where('id_bank_sampah', $bank_sampah->id_bank_sampah)
                ->whereBetween('created_at', [$bulanIni, $akhirBulan])
                ->selectRaw('
                    COUNT(*) as total_transaksi,
                    SUM(berat_sampah) as total_berat
                ')
                ->first();
            
            // Data chart per hari dalam bulan ini
            $chartData = [];
            $currentDate = $bulanIni->copy();
            
            while ($currentDate->lte($akhirBulan)) {
                $dailyData = DB::table('transaksi_sampah')
                    ->where('id_bank_sampah', $bank_sampah->id_bank_sampah)
                    ->whereDate('created_at', $currentDate->format('Y-m-d'))
                    ->selectRaw('
                        COUNT(*) as total_transaksi,
                        COALESCE(SUM(berat_sampah), 0) as total_berat
                    ')
                    ->first();
                
                $chartData[] = [
                    'date' => $currentDate->format('d/m'),
                    'total_transaksi' => $dailyData->total_transaksi ?? 0,
                    'total_berat' => $dailyData->total_berat ?? 0
                ];
                
                $currentDate->addDay();
            }
            
            return response()->json([
                'summary' => [
                    'total_transaksi' => $summaryBulan->total_transaksi ?? 0,
                    'total_berat' => $summaryBulan->total_berat ?? 0
                ],
                'chart_data' => $chartData
            ]);

        } catch (\Exception $e) {
            Log::error('Error in statistik method: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat memuat data statistik.'], 500);
        }
    }

    public function create()
    {
        return view('dashboard.add-setor-sampah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|exists:user,username',
            'berat_sampah' => 'required|numeric|min:0.1',
        ]);

        try {
            DB::beginTransaction();

            $user_bank_sampah = Auth::user();
            $komunitas = Komunitas::where('id_user', $user_bank_sampah->id_user)->first();

            if (!$komunitas) {
                throw new \Exception('Data komunitas Anda tidak ditemukan.');
            }

            $pengajuan = DB::table('pengajuan_bank_sampah')
                ->where('id_komunitas', $komunitas->id_komunitas)
                ->where('status', 'diterima')
                ->first();

            if (!$pengajuan) {
                throw new \Exception('Anda belum diterima sebagai bank sampah.');
            }

            $bank_sampah = DB::table('bank_sampah')
                ->where('id_pengajuan_bank_sampah', $pengajuan->id_pengajuan_bank_sampah)
                ->first();

            if (!$bank_sampah) {
                throw new \Exception('Data bank sampah tidak ditemukan.');
            }

            $user_penyetor = User::where('username', $request->username)->first();

            if (!$user_penyetor) {
                throw new \Exception('Username tidak ditemukan.');
            }

            if ($user_bank_sampah->id_user === $user_penyetor->id_user) {
                throw new \Exception('Tidak boleh menyetor ke bank sampah sendiri.');
            }

            $komunitas_penyetor = Komunitas::where('id_user', $user_penyetor->id_user)->first();

            if (!$komunitas_penyetor) {
                throw new \Exception('Komunitas penyetor tidak ditemukan.');
            }

            $point_didapat = $request->berat_sampah * 10;

            Transaksi_Sampah::create([
                'id_komunitas' => $komunitas_penyetor->id_komunitas,
                'id_bank_sampah' => $bank_sampah->id_bank_sampah,
                'berat_sampah' => $request->berat_sampah,
                'point_didapat' => $point_didapat,
            ]);

            $point = Point::firstOrNew([
                'id_komunitas' => $komunitas_penyetor->id_komunitas
            ]);

            $point->point += $point_didapat;
            $point->expired_point = now()->addYear();
            $point->save();

            DB::commit();

            return redirect()->back()->with('success', "Setoran berhasil! {$request->berat_sampah} kg = {$point_didapat} poin.");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal simpan setoran: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function searchUsername(Request $request)
    {
        $query = $request->get('q');
        $user_bank_sampah = Auth::user();

        if (!$query) {
            return response()->json([]);
        }

        $users = User::where('username', 'LIKE', "%{$query}%")
            ->where('role', 'komunitas')
            ->where('id_user', '!=', $user_bank_sampah->id_user)
            ->whereHas('komunitas')
            ->with('komunitas')
            ->limit(10)
            ->get();

        $results = $users->map(function ($user) {
            return [
                'username' => $user->username,
                'email' => $user->email,
                'nama' => optional($user->komunitas)->nama ?? 'N/A',
                'no_telp' => optional($user->komunitas)->no_telp ?? 'N/A',
            ];
        });

        return response()->json($results);
    }

    public function show(Transaksi_Sampah $transaksi_sampah) {}
    public function edit(Transaksi_Sampah $transaksi_sampah) {}
    public function update(Request $request, Transaksi_Sampah $transaksi_sampah) {}
    public function destroy(Transaksi_Sampah $transaksi_sampah) {}
}