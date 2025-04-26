<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    // Menampilkan semua artikel
    public function index()
    {
        $artikels = Artikel::latest()->get();
        return view('admin.view-artikel', compact('artikels'));
    }

    // Menampilkan form tambah artikel
    public function create()
    {
        return view('admin.add-artikel');
    }

    // Menyimpan artikel baru dengan transaksi database
    public function artikel(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:15360', // 15 MB
            'isi' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            // Upload file
            $imageName = $request->file('foto')->hashName();
            $request->file('foto')->storeAs('artikel', $imageName, 'public');

            // Simpan ke database
            Artikel::create([
                'judul' => $request->judul,
                'foto' => $imageName,
                'isi' => $request->isi,
            ]);

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Artikel berhasil ditambahkan.']);

        } catch (\Exception $e) {
            DB::rollBack();

            // Jika file sudah sempat diupload, hapus kembali
            if (isset($imageName) && Storage::disk('public')->exists("artikel/$imageName")) {
                Storage::disk('public')->delete("artikel/$imageName");
            }

            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan artikel. ' . $e->getMessage()
            ], 500);
        }
    }

    // Menampilkan artikel berdasarkan ID
    public function show($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('admin.view-artikel', compact('artikel'));
    }

    // Placeholder untuk store (tidak digunakan)
    public function store(Request $request)
    {
        //
    }

    // Form edit artikel (belum diisi)
    public function edit(Artikel $artikel)
    {
        //
    }

    // Update artikel (belum diisi)
    public function update(Request $request, Artikel $artikel)
    {
        //
    }

    // Hapus artikel (belum diisi)
    public function destroy(Artikel $artikel)
    {
        //
    }
}
