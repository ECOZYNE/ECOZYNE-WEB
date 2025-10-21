<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PendaftaranKegiatan;
use App\Models\Komunitas;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PendaftaranKegiatanApiController extends Controller
{
    /**
     * Get list of registered activities for authenticated user's community
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            // Ambil user login
            $idUser = Auth::user()->id_user;

            // Ambil data komunitas milik user ini
            $komunitas = Komunitas::where('id_user', $idUser)->first();

            if (!$komunitas) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data komunitas tidak ditemukan.'
                ], 404);
            }

            // Ambil pendaftaran berdasarkan id_komunitas dengan relasi kegiatan
            $pendaftaran = PendaftaranKegiatan::where('id_komunitas', $komunitas->id_komunitas)
                ->with(['kegiatan', 'komunitas'])
                ->latest()
                ->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Data pendaftaran kegiatan berhasil diambil',
                'data' => [
                    'komunitas' => $komunitas,
                    'pendaftaran' => $pendaftaran
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Register for an activity
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id_komunitas' => 'required|exists:komunitas,id_komunitas',
                'id_kegiatan' => 'required|exists:kegiatan,id_kegiatan',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Verifikasi bahwa komunitas milik user yang login
            $idUser = Auth::user()->id_user;
            $komunitas = Komunitas::where('id_komunitas', $request->id_komunitas)
                ->where('id_user', $idUser)
                ->first();

            if (!$komunitas) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Anda tidak memiliki akses ke komunitas ini'
                ], 403);
            }

            // Cek apakah sudah pernah mendaftar
            $sudahTerdaftar = PendaftaranKegiatan::where('id_komunitas', $request->id_komunitas)
                ->where('id_kegiatan', $request->id_kegiatan)
                ->exists();

            if ($sudahTerdaftar) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Anda sudah terdaftar pada kegiatan ini'
                ], 400);
            }

            $pendaftaran = PendaftaranKegiatan::create([
                'id_komunitas' => $request->id_komunitas,
                'id_kegiatan' => $request->id_kegiatan,
            ]);

            // Load relasi untuk response
            $pendaftaran->load(['kegiatan', 'komunitas']);

            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil mendaftar kegiatan',
                'data' => $pendaftaran
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mendaftar kegiatan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get detail of a registered activity
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $idUser = Auth::user()->id_user;
            
            $pendaftaran = PendaftaranKegiatan::with(['kegiatan', 'komunitas'])
                ->whereHas('komunitas', function($query) use ($idUser) {
                    $query->where('id_user', $idUser);
                })
                ->find($id);

            if (!$pendaftaran) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data pendaftaran tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Detail pendaftaran berhasil diambil',
                'data' => $pendaftaran
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil detail',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Cancel activity registration
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $idUser = Auth::user()->id_user;
            
            $pendaftaran = PendaftaranKegiatan::whereHas('komunitas', function($query) use ($idUser) {
                $query->where('id_user', $idUser);
            })->find($id);

            if (!$pendaftaran) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data pendaftaran tidak ditemukan atau Anda tidak memiliki akses'
                ], 404);
            }

            $pendaftaran->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Pendaftaran kegiatan berhasil dibatalkan'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat membatalkan pendaftaran',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get list of available activities (not yet registered)
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function available()
    {
        try {
            $idUser = Auth::user()->id_user;
            $komunitas = Komunitas::where('id_user', $idUser)->first();

            if (!$komunitas) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data komunitas tidak ditemukan'
                ], 404);
            }

            // Ambil ID kegiatan yang sudah didaftar
            $kegiatanTerdaftar = PendaftaranKegiatan::where('id_komunitas', $komunitas->id_komunitas)
                ->pluck('id_kegiatan')
                ->toArray();

            // Ambil kegiatan yang belum didaftar
            $kegiatanTersedia = Kegiatan::whereNotIn('id_kegiatan', $kegiatanTerdaftar)
                ->orderBy('tanggal_kegiatan', 'desc')
                ->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Daftar kegiatan tersedia berhasil diambil',
                'data' => $kegiatanTersedia
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Check if user's community is already registered for a specific activity
     * 
     * @param int $id_kegiatan
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkRegistration($id_kegiatan)
    {
        try {
            $idUser = Auth::user()->id_user;
            $komunitas = Komunitas::where('id_user', $idUser)->first();

            if (!$komunitas) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data komunitas tidak ditemukan'
                ], 404);
            }

            $isRegistered = PendaftaranKegiatan::where('id_komunitas', $komunitas->id_komunitas)
                ->where('id_kegiatan', $id_kegiatan)
                ->exists();

            return response()->json([
                'status' => 'success',
                'message' => 'Status pendaftaran berhasil dicek',
                'data' => [
                    'is_registered' => $isRegistered
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengecek status pendaftaran',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}