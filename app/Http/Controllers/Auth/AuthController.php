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

            // Redirect sesuai role
            return redirect()->intended(
                $user->role === 'admin' ? '/admin/index' : '/'
            );
        }

        // Tambahan keamanan: jika Auth::attempt gagal, cek manual
        $user = User::where('username', $request->username)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            // Optional: login manual jika perlu
            Auth::login($user);
            return redirect()->intended('/');
        }

        // Jika login gagal
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
