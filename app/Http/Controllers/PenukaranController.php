<?php

namespace App\Http\Controllers;

use App\Models\Hadiah;
use App\Models\Point;
use App\Models\Komunitas;
use App\Models\Penukaran;
use App\Models\transaksi_penukaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenukaranController extends Controller
{
    /**
     * Store penukaran baru
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Anda harus login terlebih dahulu.');
        }

        $request->validate([
            'id_hadiah' => 'required|exists:hadiah,id_hadiah',
            'jumlah' => 'required|integer|min:1',
            'point_satuan' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $komunitas = Komunitas::where('id_user', $user->id_user)->first();

        if (!$komunitas) {
            return redirect()->back()->with('error', 'Anda belum tergabung dalam komunitas.');
        }

        $hadiah = Hadiah::find($request->id_hadiah);
        $pointData = Point::where('id_komunitas', $komunitas->id_komunitas)->first();
        $userPoints = $pointData ? $pointData->point : 0;

        $totalPointDibutuhkan = $request->point_satuan * $request->jumlah;

        // Validasi stok
        if ($hadiah->stok < $request->jumlah) {
            return redirect()->back()
                ->with('error', 'Stok hadiah tidak mencukupi.')
                ->with('sweet_alert', [
                    'type' => 'error',
                    'title' => 'Gagal!',
                    'message' => 'Stok hadiah tidak mencukupi!',
                    'scroll_to' => 'pricing'
                ]);
        }

        // Validasi poin
        if ($userPoints < $totalPointDibutuhkan) {
            return redirect()->back()
                ->with('error', 'Poin Anda tidak mencukupi.')
                ->with('sweet_alert', [
                    'type' => 'error',
                    'title' => 'Gagal!',
                    'message' => 'Poin Anda tidak mencukupi untuk penukaran ini!',
                    'scroll_to' => 'pricing'
                ]);
        }

        try {
            DB::beginTransaction();

            // Buat penukaran
            $penukaran = Penukaran::create([
                'id_komunitas' => $komunitas->id_komunitas,
                'status_penukaran' => 'menunggu',
            ]);

            // Buat transaksi penukaran
            transaksi_penukaran::create([
                'id_penukaran' => $penukaran->id_penukaran,
                'id_hadiah' => $request->id_hadiah,
                'jumlah' => $request->jumlah,
                'point_satuan' => $request->point_satuan,
            ]);

            // Kurangi stok hadiah
            $hadiah->decrement('stok', $request->jumlah);

            // Kurangi poin user
            if ($pointData) {
                $pointData->decrement('point', $totalPointDibutuhkan);
            }

            DB::commit();

            return redirect()->back()
                ->with('success', 'Penukaran hadiah berhasil diajukan! Menunggu persetujuan admin.')
                ->with('sweet_alert', [
                    'type' => 'success',
                    'title' => 'Berhasil!',
                    'message' => 'Penukaran berhasil! Total poin yang digunakan: ' . number_format($totalPointDibutuhkan) . ' XP',
                    'scroll_to' => 'pricing'
                ]);

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memproses penukaran: ' . $e->getMessage())
                ->with('sweet_alert', [
                    'type' => 'error',
                    'title' => 'Kesalahan!',
                    'message' => 'Terjadi error sistem saat memproses penukaran.',
                    'scroll_to' => 'pricing'
                ]);
        }
    }

    /**
     * Update status penukaran (untuk admin)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diterima,ditolak,dikemas,dikirim,selesai,dibatalkan'
        ]);

        $penukaran = Penukaran::with(['transaksi', 'komunitas'])->findOrFail($id);
        $oldStatus = $penukaran->status_penukaran;
        $newStatus = $request->status;

        try {
            DB::beginTransaction();

            $penukaran->update(['status_penukaran' => $newStatus]);

            if (in_array($newStatus, ['ditolak', 'dibatalkan']) && in_array($oldStatus, ['menunggu', 'diterima', 'dikemas'])) {
                foreach ($penukaran->transaksi as $transaksi) {
                    $hadiah = Hadiah::find($transaksi->id_hadiah);
                    if ($hadiah) {
                        $hadiah->increment('stok', $transaksi->jumlah);
                    }

                    $pointData = Point::where('id_komunitas', $penukaran->id_komunitas)->first();
                    if ($pointData) {
                        $totalPoint = $transaksi->point_satuan * $transaksi->jumlah;
                        $pointData->increment('point', $totalPoint);
                    }
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Status penukaran berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Tampilkan daftar penukaran untuk admin
     */
    public function index()
    {
        $penukaran = Penukaran::with(['komunitas.user', 'transaksi.hadiah'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.penukaran.index', compact('penukaran'));
    }

    /**
     * Tampilkan detail penukaran
     */
    public function show($id)
    {
        $penukaran = Penukaran::with(['komunitas.user', 'transaksi.hadiah'])->findOrFail($id);
        return view('admin.penukaran.show', compact('penukaran'));
    }

    /**
     * Tampilkan riwayat penukaran user
     */
public function riwayat()
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $user = Auth::user();
    $komunitas = Komunitas::where('id_user', $user->id_user)->first();

    if (!$komunitas) {
        return view('dashboard.my-penukaran-hadiah', ['penukaran' => collect()]);
    }

    $penukaran = Penukaran::with(['transaksi.hadiah'])
        ->where('id_komunitas', $komunitas->id_komunitas)
        ->orderBy('created_at', 'desc')
      ->get();

    return view('dashboard.my-penukaran-hadiah', compact('penukaran'));
}

public function batalkan($id)
{
    $penukaran = Penukaran::with('transaksi')->findOrFail($id);

    if ($penukaran->status_penukaran !== 'menunggu') {
        return redirect()->back()->with('error', 'Penukaran hanya bisa dibatalkan jika masih berstatus "menunggu".');
    }

    try {
        DB::beginTransaction();

        foreach ($penukaran->transaksi as $transaksi) {
            // Kembalikan stok
            $hadiah = Hadiah::find($transaksi->id_hadiah);
            if ($hadiah) {
                $hadiah->increment('stok', $transaksi->jumlah);
            }

            // Kembalikan point ke komunitas
            $totalPoint = $transaksi->point_satuan * $transaksi->jumlah;
            $point = Point::where('id_komunitas', $penukaran->id_komunitas)->first();
            if ($point) {
                $point->increment('point', $totalPoint);
            }
        }

        // Ubah status penukaran
        $penukaran->update(['status_penukaran' => 'dibatalkan']);

        DB::commit();
        return redirect()->back()->with('success', 'Penukaran berhasil dibatalkan. Poin dan stok telah dikembalikan.');
    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->with('error', 'Terjadi kesalahan saat membatalkan: ' . $e->getMessage());
    }
}

public function konfirmasiPenukaran()
{
    $penukaran = Penukaran::with(['komunitas.user', 'transaksi.hadiah'])
        ->where('status_penukaran', 'menunggu')
        ->orderBy('created_at', 'asc') 
        ->get();

    return view('admin.konfirmasi-penukaran', compact('penukaran'));
}

public function penukaranDiterima()
{
    $penukaran = Penukaran::with(['komunitas.user', 'transaksi.hadiah'])
        ->whereIn('status_penukaran', ['diterima', 'dikemas', 'dikirim', 'selesai'])
        ->orderBy('created_at', 'asc')
        ->get();

    return view('admin.view-penukaran', compact('penukaran')); // ← GANTI DI SINI
}

public function updateStatusPenukaranDiterima(Request $request, $id)
{
    $penukaran = Penukaran::findOrFail($id);
    $status = $request->status;

    if (in_array($status, ['dikemas', 'dikirim', 'selesai'])) {
        $penukaran->status_penukaran = $status;
        $penukaran->save();

        return response()->json(['success' => true]);
    }

    return response()->json(['error' => 'Status tidak valid'], 400);
}

public function RiwayatPenukaranSelesai()
{
    $penukaran = \App\Models\Penukaran::with(['komunitas.user', 'transaksi.hadiah'])
        ->where('status_penukaran', 'selesai')
        ->orderByDesc('created_at')
        ->get();

    return view('admin.riwayat-penukaran', compact('penukaran'));
}


  public function riwayatPenukaranSaya()
    {
        // Mengambil data penukaran hadiah yang statusnya 'selesai'
        // dan memuat relasi 'transaksi' dan 'hadiah' secara eager loading
        $penukaran = Penukaran::where('status_penukaran', 'selesai')
                               ->with('transaksi.hadiah')
                               ->orderByDesc('created_at') // Urutkan dari yang terbaru
                               ->get();

        // Mengembalikan view dengan data penukaran
        return view('dashboard.my-riwayat-penukaran-hadiah', compact('penukaran'));
    }



}