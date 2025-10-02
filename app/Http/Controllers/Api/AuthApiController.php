<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Komunitas;
use App\Models\PengajuanBankSampah;
use App\Models\BankSampah;

class AuthApiController extends Controller
{
    /**
     * Login API untuk Flutter
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Cari user berdasarkan username
        $user = User::where('username', $request->username)->first();


        // Cek apakah user ada dan password benar
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Username atau password salah.'
            ], 401);
        }

        // Cek status bank sampah jika role komunitas
        $isBankSampah = false;
        $bankSampahData = null;

        if ($user->role === 'komunitas') {
            $komunitas = Komunitas::where('id_user', $user->id_user)->first();

            if ($komunitas) {
                $pengajuan = PengajuanBankSampah::where('id_komunitas', $komunitas->id_komunitas)
                    ->where('status', 'diterima')
                    ->first();

                if ($pengajuan) {
                    $bankSampah = BankSampah::where('id_pengajuan_bank_sampah', $pengajuan->id_pengajuan_bank_sampah)->first();
                    
                    if ($bankSampah) {
                        $isBankSampah = true;
                        $bankSampahData = [
                            'id_bank_sampah' => $bankSampah->id_bank_sampah,
                            'nama_bank_sampah' => $bankSampah->nama_bank_sampah,
                            // Tambahkan data lain yang diperlukan
                        ];
                    }
                }
            }
        }

        // Generate token (jika menggunakan Sanctum)
        // Pastikan sudah install Laravel Sanctum: composer require laravel/sanctum
        $token = $user->createToken('mobile-app-token')->plainTextToken;

        // Response sukses dengan data user dan token
        return response()->json([
            'success' => true,
            'message' => 'Login berhasil! Selamat datang kembali.',
            'data' => [
                'user' => [
                    'id_user' => $user->id_user,
                    'username' => $user->username,
                    'email' => $user->email,
                    'role' => $user->role,
                    'nama' => $komunitas->nama ?? $user->nama,
                    'foto' => $user->foto ? url('storage/user/' . $user->foto) : null,
                ],
                'is_bank_sampah' => $isBankSampah,
                'bank_sampah' => $bankSampahData,
                'token' => $token,
            ]
        ], 200);
    }

    /**
     * Logout API
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        // Revoke token yang sedang digunakan
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil.'
        ], 200);
    }

    /**
     * Get user profile
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */


}