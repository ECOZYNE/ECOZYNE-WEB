<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BankSampahCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        $user = Auth::user();

        // Check if user has komunitas role
        if ($user->role !== 'komunitas') {
            return redirect()->back()->with('error', 'Akses ditolak. Anda bukan komunitas.');
        }

        // Check if user has komunitas record
        if (!$user->komunitas) {
            return redirect()->back()->with('error', 'Data komunitas tidak ditemukan.');
        }

        // Check if komunitas has pengajuan bank sampah
        $pengajuan = $user->komunitas->pengajuanBankSampah;
        if (!$pengajuan) {
            return redirect()->back()->with('error', 'Anda belum mengajukan bank sampah.');
        }

        // Check if pengajuan has been approved (status = 'disetujui' or similar)
        if ($pengajuan->status !== 'diterima') {
            return redirect()->back()->with('error', 'Pengajuan bank sampah Anda belum diterima.');
        }

        // Check if bank_sampah record exists (meaning the pengajuan has been processed)
        if (!$pengajuan->bank_sampah) {
            return redirect()->back()->with('error', 'Data bank sampah belum tersedia.');
        }

        return $next($request);
    }
}