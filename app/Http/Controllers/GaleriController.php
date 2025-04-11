<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function create()
    {
        return view('admin.add-galeri');
    }

    public function index()
    {
        $galeris = Galeri::latest()->get();
        return view('admin.view-galeri', compact('galeris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:10240', // max 10MB
            'deskripsi' => 'required|string|max:255',
        ]);

        try {
            $imageName = $request->file('foto')->hashName();
            $request->file('foto')->storeAs('galeri', $imageName, 'public');

            Galeri::create([
                'foto' => $imageName,
                'deskripsi' => $request->deskripsi,
            ]);

            return response()->json(['success' => true, 'message' => 'Foto berhasil ditambahkan.']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menambahkan foto: ' . $e->getMessage()], 500);
        }
    }
}