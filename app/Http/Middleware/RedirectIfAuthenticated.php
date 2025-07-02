<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            // Periksa apakah pengguna sudah terautentikasi untuk guard ini
            if (Auth::guard($guard)->check()) {
                $user = Auth::user(); // Dapatkan objek pengguna yang terautentikasi

                // Logika pengalihan berdasarkan role pengguna
                if ($user->role === 'admin') {
                    // Jika role adalah 'admin', arahkan ke dashboard admin
                    return redirect('/admin/index');
                } elseif ($user->role === 'komunitas') {
                    // Jika role adalah 'komunitas', arahkan ke halaman utama (root)
                    return redirect('/');
                } else {
                    // Untuk role lain atau role yang tidak terdefinisi, arahkan ke halaman utama
                    return redirect('/');
                }
            }
        }

        // Jika pengguna tidak terautentikasi, lanjutkan permintaan
        return $next($request);
    }
}
