<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

use App\Models\User;
use App\Models\Komunitas;
use App\Models\PengajuanBankSampah;
use App\Models\BankSampah;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Proses login pengguna dengan proteksi brute force.
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Cek rate limiting berdasarkan username dan IP
        $throttleKey = $this->throttleKey($request);

        // Cek apakah user sedang dalam cooldown
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $minutes = ceil($seconds / 60);

            $message = "Terlalu banyak percobaan login. Silakan coba lagi dalam {$minutes} menit.";

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $message,
                    'cooldown' => $seconds
                ], 429);
            }

            return back()->withErrors([
                'username' => $message,
            ])->withInput();
        }

        $credentials = $request->only('username', 'password');

        // Coba autentikasi menggunakan Laravel Auth
        if (Auth::attempt($credentials)) {
            // Login berhasil - clear rate limiter
            RateLimiter::clear($throttleKey);

            $request->session()->regenerate(); // Hindari session fixation

            $user = Auth::user();
            $isBankSampah = false;

            // Jika role komunitas, cek status bank sampah
            if ($user->role === 'komunitas') {
                $komunitas = Komunitas::where('id_user', $user->id_user)->first();

                if ($komunitas) {
                    $pengajuan = PengajuanBankSampah::where('id_komunitas', $komunitas->id_komunitas)
                        ->where('status', 'diterima')
                        ->first();

                    if ($pengajuan) {
                        $bankSampah = BankSampah::where('id_pengajuan_bank_sampah', $pengajuan->id_pengajuan_bank_sampah)->first();
                        $isBankSampah = $bankSampah !== null;
                    }
                }
            }

            // Simpan informasi penting ke session
            session([
                'user_id'        => $user->id_user,
                'role'           => $user->role,
                'is_admin'       => $user->role === 'admin',
                'is_bank_sampah' => $isBankSampah,
            ]);

            // Tentukan URL redirect berdasarkan role
            $redirectUrl = $user->role === 'admin' ? '/admin/index' : '/';

            // Return JSON response untuk AJAX
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Login berhasil! Selamat datang kembali.',
                    'redirect_url' => $redirectUrl
                ]);
            }

            // Jika bukan AJAX, set session flash message dan redirect
            return redirect($redirectUrl)->with('login_success', 'Login berhasil! Selamat datang kembali.');
        }

        // Login gagal - increment rate limiter
        RateLimiter::hit($throttleKey, 300); // 300 detik = 5 menit cooldown

        // Hitung sisa percobaan
        $attempts = RateLimiter::attempts($throttleKey);
        $remaining = 5 - $attempts;

        $message = 'Username atau password salah.';
        if ($remaining > 0 && $remaining < 5) {
            $message .= " Sisa percobaan: {$remaining} kali.";
        }

        // Jika login gagal
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => $message,
                'remaining_attempts' => $remaining
            ], 401);
        }

        return back()->withErrors([
            'username' => $message,
        ])->withInput();
    }

    /**
     * Logout pengguna.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Hapus semua session & regenerate token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    /**
     * Generate throttle key berdasarkan username dan IP.
     */
    protected function throttleKey(Request $request): string
    {
        return Str::lower($request->input('username')) . '|' . $request->ip();
    }

    /**
     * Method tambahan untuk clear rate limit manual (jika diperlukan admin).
     */
    public function clearLoginAttempts(Request $request)
    {
        $throttleKey = $this->throttleKey($request);
        RateLimiter::clear($throttleKey);

        return response()->json([
            'success' => true,
            'message' => 'Login attempts cleared successfully.'
        ]);
    }
}
