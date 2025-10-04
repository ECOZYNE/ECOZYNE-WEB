<?php

namespace App\Http\Controllers\Api;

use App\Models\Hadiah;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HadiahApiController extends Controller
{
    /**
     * Get all hadiah
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $hadiahList = Hadiah::latest()->get();

            return response()->json([
                'success' => true,
                'message' => 'Data hadiah berhasil diambil',
                'data' => $hadiahList
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data hadiah',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get hadiah by ID
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $hadiah = Hadiah::find($id);

            if (!$hadiah) {
                return response()->json([
                    'success' => false,
                    'message' => 'Hadiah tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Detail hadiah berhasil diambil',
                'data' => $hadiah
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil detail hadiah',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get hadiah yang tersedia (stok > 0)
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function available()
    {
        try {
            $hadiahList = Hadiah::where('stok', '>', 0)
                ->latest()
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Data hadiah tersedia berhasil diambil',
                'data' => $hadiahList
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data hadiah tersedia',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get latest hadiah with optional limit
     * 
     * @param int|null $limit
     * @return \Illuminate\Http\JsonResponse
     */
    public function latest($limit = null)
    {
        try {
            $query = Hadiah::latest();

            if ($limit) {
                $query->limit($limit);
            }

            $hadiahList = $query->get();

            return response()->json([
                'success' => true,
                'message' => 'Data hadiah terbaru berhasil diambil',
                'data' => $hadiahList
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data hadiah terbaru',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get hadiah sorted by point (ascending)
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function byPoint()
    {
        try {
            $hadiahList = Hadiah::orderBy('point_satuan', 'asc')->get();

            return response()->json([
                'success' => true,
                'message' => 'Data hadiah berhasil diambil berdasarkan point',
                'data' => $hadiahList
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data hadiah berdasarkan point',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}