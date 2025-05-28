<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\komunitas;
use App\Models\BankSampah;
use Illuminate\Http\Request;
use App\Models\PengajuanBankSampah;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');  // This is the login view
    }

    // public function login(Request $request)
    // {
    //     // Validate input fields
    //     $request->validate([
    //         'username' => 'required|string',
    //         'password' => 'required|string',
    //     ]);

    //     // Check if user exists
    //     $user = User::where('username', $request->username)->first();

    //     if ($user && Hash::check($request->password, $user->password)) {
    //         // If credentials are correct, store user session data
    //         session(['user_id' => $user->id_user, 'role' => $user->role]);

    //         // Redirect user based on role
    //         if ($user->role === 'admin') {
    //             return redirect('/admin/index');
    //         } elseif ($user->role === 'komunitas') {
    //             return redirect('/');  // Redirect to komunitas index
    //         }
    //     }

    //     // If login fails
    //     return back()->with('error', 'Username or password is incorrect!');
    // }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Simpan status admin ke session
            session(['is_admin' => $user->role === 'admin']);

            if ($user->role === 'admin') {
                return redirect('/admin/index');
            } elseif ($user->role === 'komunitas') {
                // Ambil komunitas berdasarkan id_user
                $komunitas = Komunitas::where('id_user', $user->id_user)->first();

                $isBankSampah = false;

                if ($komunitas) {
                    // Cari pengajuan bank sampah dengan status diterima
                    $pengajuan = PengajuanBankSampah::where('id_komunitas', $komunitas->id_komunitas)
                        ->where('status', 'diterima')
                        ->first();

                    if ($pengajuan) {
                        // Cek apakah sudah ada data bank sampah terkait pengajuan tersebut
                        $bankSampah = BankSampah::where('id_pengajuan_bank_sampah', $pengajuan->id_pengajuan_bank_sampah)->first();
                        $isBankSampah = $bankSampah !== null;
                    }
                }
                session(['is_bank_sampah' => $isBankSampah]);
                return redirect('/');
            }
        }

        // Jika gagal login
        return back()->with('error', 'Username atau password salah!');
    }

    public function logout()
    {
        Auth::logout();            // Logout Laravel Auth
        session()->flush();        // Kosongkan semua session
        return redirect('/login');
    }

}