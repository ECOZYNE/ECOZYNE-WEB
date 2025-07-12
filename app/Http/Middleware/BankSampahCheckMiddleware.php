<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BankSampahCheckMiddleware
{
    /**
     * Tangani permintaan masuk.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        $user = Auth::user();

        // Cek apakah user memiliki role 'komunitas'
        if ($user->role !== 'komunitas') {
            return redirect()->back()->with('error', 'Akses ditolak. Anda bukan komunitas.');
        }

        // Cek apakah user memiliki data komunitas
        if (!$user->komunitas) {
            return redirect()->back()->with('error', 'Data komunitas tidak ditemukan.');
        }

        // Cek apakah komunitas sudah mengajukan bank sampah
        $pengajuan = $user->komunitas->pengajuanBankSampah;
        if (!$pengajuan) {
            return redirect()->back()->with('error', 'Anda belum mengajukan bank sampah.');
        }

        // Cek apakah pengajuan sudah diterima
        if ($pengajuan->status !== 'diterima') {
            return redirect()->back()->with('error', 'Pengajuan bank sampah Anda belum diterima.');
        }

        // Cek apakah data bank sampah sudah tersedia
        if (!$pengajuan->bank_sampah) {
            return redirect()->back()->with('error', 'Data bank sampah belum tersedia.');
        }

        return $next($request);
    }
}
