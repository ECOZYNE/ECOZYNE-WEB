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

    // Menampilkan form edit artikel
    public function edit($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('admin.edit-artikel', compact('artikel'));
    }

    // Update artikel
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:15360', // 15 MB
            'isi' => 'required|string',
        ]);

        $artikel = Artikel::findOrFail($id);

        DB::beginTransaction();

        try {
            // Cek jika ada foto baru
            if ($request->hasFile('foto')) {
                // Hapus foto lama jika ada
                if (Storage::disk('public')->exists("artikel/{$artikel->foto}")) {
                    Storage::disk('public')->delete("artikel/{$artikel->foto}");
                }

                // Upload foto baru
                $imageName = $request->file('foto')->hashName();
                $request->file('foto')->storeAs('artikel', $imageName, 'public');
                $artikel->foto = $imageName;
            }

            // Update data artikel
            $artikel->judul = $request->judul;
            $artikel->isi = $request->isi;
            $artikel->save();

            DB::commit();

            return redirect()->route('artikel.index')->with('success', 'Artikel berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('artikel.index')->with('error', 'Gagal memperbarui artikel. ' . $e->getMessage());
        }
    }

    // Hapus artikel
    public function destroy($id)
    {
        $artikel = Artikel::findOrFail($id);

        DB::beginTransaction();

        try {
            // Hapus foto artikel
            if (Storage::disk('public')->exists("artikel/{$artikel->foto}")) {
                Storage::disk('public')->delete("artikel/{$artikel->foto}");
            }

            // Hapus artikel
            $artikel->delete();

            DB::commit();

            return redirect()->route('artikel.index')->with('success', 'Artikel berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('artikel.index')->with('error', 'Gagal menghapus artikel. ' . $e->getMessage());
        }
    }
}
