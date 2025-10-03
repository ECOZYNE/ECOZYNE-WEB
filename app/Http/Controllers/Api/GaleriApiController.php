<?php

namespace App\Http\Controllers\Api;

use App\Models\Galeri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class GaleriApiController extends Controller
{
    /**
     * Display a listing of galeri.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $galeris = Galeri::latest()->get()->map(function ($galeri) {
                return [
                    'id' => $galeri->id_galeri,
                    'foto_url' => $galeri->foto ? asset('storage/galeri/' . $galeri->foto) : null,
                    'deskripsi' => $galeri->deskripsi,
                    'created_at' => $galeri->created_at->format('Y-m-d H:i:s'),
                    'updated_at' => $galeri->updated_at->format('Y-m-d H:i:s'),
                ];
            });

            return response()->json([
                'success' => true,
                'message' => 'Data galeri berhasil diambil',
                'data' => $galeris
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data galeri',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified galeri.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $galeri = Galeri::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Detail galeri berhasil diambil',
                'data' => [
                    'id' => $galeri->id_galeri,
                    'foto_url' => $galeri->foto ? asset('storage/galeri/' . $galeri->foto) : null,
                    'deskripsi' => $galeri->deskripsi,
                    'created_at' => $galeri->created_at->format('Y-m-d H:i:s'),
                    'updated_at' => $galeri->updated_at->format('Y-m-d H:i:s'),
                ]
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Galeri tidak ditemukan'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil detail galeri',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get latest galeri with optional limit.
     *
     * @param  int|null  $limit
     * @return \Illuminate\Http\JsonResponse
     */
    public function latest($limit = 6)
    {
        try {
            $galeris = Galeri::latest()
                ->take($limit)
                ->get()
                ->map(function ($galeri) {
                    return [
                        'id' => $galeri->id_galeri,
                        'foto_url' => $galeri->foto ? asset('storage/galeri/' . $galeri->foto) : null,
                        'deskripsi' => $galeri->deskripsi,
                        'created_at' => $galeri->created_at->format('Y-m-d H:i:s'),
                    ];
                });

            return response()->json([
                'success' => true,
                'message' => "Berhasil mengambil {$limit} galeri terbaru",
                'data' => $galeris
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil galeri terbaru',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}