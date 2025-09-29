<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelApiController extends Controller
{
    // GET /api/artikels
    public function index()
    {
        $artikels = Artikel::latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'List data artikel',
            'data' => $artikels
        ], 200);
    }

    // GET /api/artikels/{id}
    public function show($id)
    {
        $artikel = Artikel::find($id);

        if (!$artikel) {
            return response()->json([
                'status' => false,
                'message' => 'Artikel tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Detail artikel',
            'data' => $artikel
        ], 200);
    }
}
