<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
     * Proses login pengguna.
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $credentials = $request->only('username', 'password');

        // Coba autentikasi menggunakan Laravel Auth
        if (Auth::attempt($credentials)) {
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

        // Tambahan keamanan: jika Auth::attempt gagal, cek manual
        $user = User::where('username', $request->username)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            // Optional: login manual jika perlu
            Auth::login($user);
            
            $redirectUrl = $user->role === 'admin' ? '/admin/index' : '/';
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Login berhasil! Selamat datang kembali.',
                    'redirect_url' => $redirectUrl
                ]);
            }
            
            return redirect($redirectUrl)->with('login_success', 'Login berhasil! Selamat datang kembali.');
        }

        // Jika login gagal
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Username atau password salah.'
            ]);
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
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
}