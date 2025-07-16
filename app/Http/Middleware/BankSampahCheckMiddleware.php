<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Komunitas; // Pastikan model Komunitas di-import
use App\Models\User;     // Tambahkan import untuk model User
use App\Models\PengajuanBankSampah; // Tambahkan import untuk model PengajuanBankSampah

class BankSampahCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Cek apakah user memiliki role 'komunitas'
        if ($user->role !== 'komunitas') {
            return redirect()->back()->with('error', 'Akses ditolak. Anda bukan komunitas.');
        }

        // Cek apakah user memiliki data komunitas
        if (!$user->relationLoaded('komunitas')) {
            $user->load('komunitas');
        }
        if (!$user->komunitas) {
            return redirect()->back()->with('error', 'Data komunitas tidak ditemukan.');
        }

        // Muat semua pengajuan bank sampah untuk komunitas ini
        if (!$user->komunitas->relationLoaded('pengajuanBankSampah')) {
            $user->komunitas->load('pengajuanBankSampah');
        }

        // Dapatkan koleksi pengajuan
        $pengajuanCollection = $user->komunitas->pengajuanBankSampah;

        // Cari pengajuan yang statusnya 'diterima'
        // Jika ada beberapa, ambil yang pertama ditemukan (atau yang paling baru jika diurutkan)
        $pengajuanDiterima = $pengajuanCollection->firstWhere('status', 'diterima');

        // Cek apakah ada pengajuan bank sampah sama sekali
        if ($pengajuanCollection->isEmpty()) {
            return redirect()->back()->with('error', 'Anda belum mengajukan bank sampah.');
        }

        // Cek apakah ada pengajuan yang statusnya 'diterima'
        if (!$pengajuanDiterima) {
            // Jika ada pengajuan tapi belum ada yang diterima, cek status pengajuan yang ada
            // Misalnya, ambil pengajuan terbaru untuk menampilkan statusnya
            $latestPengajuan = $pengajuanCollection->sortByDesc('created_at')->first();

            if ($latestPengajuan && $latestPengajuan->status === 'diproses') {
                return redirect()->back()->with('error', 'Pengajuan bank sampah Anda sedang diproses.');
            } elseif ($latestPengajuan && $latestPengajuan->status === 'ditolak') {
                return redirect()->back()->with('error', 'Pengajuan bank sampah Anda ditolak. Silakan ajukan kembali.');
            } else {
                // Ini akan menangani kasus di mana ada pengajuan tapi statusnya tidak 'diterima', 'diproses', atau 'ditolak'
                // atau jika ada pengajuan tapi tidak ada yang 'diterima' dan tidak ada yang 'latest'
                return redirect()->back()->with('error', 'Pengajuan bank sampah Anda belum diterima.');
            }
        }

        // Jika sampai sini, berarti ada pengajuan yang statusnya 'diterima'.
        // Maka, izinkan akses.
        return $next($request);
    }
}
