<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $kegiatans = Kegiatan::orderBy('tanggal_kegiatan', 'desc')->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Data kegiatan berhasil diambil',
                'data' => $kegiatans
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data kegiatan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $kegiatan = Kegiatan::findOrFail($id);

            return response()->json([
                'status' => 'success',
                'message' => 'Detail kegiatan berhasil diambil',
                'data' => $kegiatan
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kegiatan tidak ditemukan',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Get upcoming events (kegiatan yang akan datang)
     */
    public function upcoming()
    {
        try {
            $kegiatans = Kegiatan::where('tanggal_kegiatan', '>=', now())
                ->orderBy('tanggal_kegiatan', 'asc')
                ->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Data kegiatan mendatang berhasil diambil',
                'data' => $kegiatans
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data kegiatan mendatang',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get latest events (kegiatan terbaru untuk homepage)
     */
    public function latest($limit = 6)
    {
        try {
            $kegiatans = Kegiatan::orderBy('created_at', 'desc')
                ->limit($limit)
                ->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Data kegiatan terbaru berhasil diambil',
                'data' => $kegiatans
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data kegiatan terbaru',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
