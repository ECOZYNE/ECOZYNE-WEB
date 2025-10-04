<?php

namespace App\Http\Controllers\Api;

use App\Models\Komik;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class KomikApiController extends Controller
{
    /**
     * Menampilkan semua komik
     * GET /api/komik
     */
    public function index()
    {
        try {
            $komiks = Komik::latest()->get()->map(function ($komik) {
                return [
                    'id' => $komik->id,
                    'judul' => $komik->judul,
                    'penulis' => $komik->penulis,
                    'cover_url' => $komik->cover 
                        ? asset('storage/komik-cover/' . $komik->cover) 
                        : null,
                    'file_pdf_url' => $komik->file_pdf 
                        ? asset('storage/komik/' . $komik->file_pdf) 
                        : null,
                    'jml_halaman' => $komik->jml_halaman,
                    'created_at' => $komik->created_at->format('Y-m-d H:i:s'),
                ];
            });

            return response()->json([
                'success' => true,
                'message' => 'Data komik berhasil diambil',
                'data' => $komiks
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data komik',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menampilkan detail komik
     * GET /api/komik/{id}
     */
    public function show($id)
    {
        try {
            $komik = Komik::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Detail komik berhasil diambil',
                'data' => [
                    'id' => $komik->id,
                    'judul' => $komik->judul,
                    'penulis' => $komik->penulis,
                    'cover_url' => $komik->cover 
                        ? asset('storage/komik-cover/' . $komik->cover) 
                        : null,
                    'file_pdf_url' => $komik->file_pdf 
                        ? asset('storage/komik/' . $komik->file_pdf) 
                        : null,
                    'jml_halaman' => $komik->jml_halaman,
                    'created_at' => $komik->created_at->format('Y-m-d H:i:s'),
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Komik tidak ditemukan',
                'error' => $e->getMessage()
            ], 404);
        }
    }
}