<?php

namespace App\Http\Controllers;

use App\Models\Komik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KomikController extends Controller
{
    // Menampilkan semua komik
    public function index()
    {
        $komiks = Komik::latest()->get();
        return view('admin.view-komik', compact('komiks'));
    }

    // Menampilkan form tambah komik
    public function create()
    {
        return view('admin.add-komik');
    }

    // Menyimpan komik baru
    public function store(Request $request)
    {
        $request->validate([
            'judul'      => 'required|string|max:255',
            'penulis'    => 'required|string|max:255',
            'cover'      => 'required|image|mimes:jpeg,jpg,png|max:5120',
            'file_pdf'   => 'required|mimes:pdf|max:102400',
            'jml_halaman'=> 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            // Upload Cover
            $coverFile = $request->file('cover');
            $coverName = $coverFile->hashName();
            $coverFile->storeAs('komik-cover', $coverName, 'public');

            // Upload PDF
            $pdfFile = $request->file('file_pdf');
            $pdfName = $pdfFile->hashName();
            $pdfFile->storeAs('komik', $pdfName, 'public');

            // Simpan ke DB
            Komik::create([
                'judul'       => $request->judul,
                'penulis'     => $request->penulis,
                'cover'       => $coverName,
                'file_pdf'    => $pdfName,
                'jml_halaman' => $request->jml_halaman,
            ]);

            DB::commit();

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Komik berhasil ditambahkan.'
                ]);
            }

            return redirect()->route('komik.index')->with('success', 'Komik berhasil ditambahkan.');
            
        } catch (\Exception $e) {
            DB::rollBack();

            if (isset($coverName) && Storage::disk('public')->exists("komik-cover/$coverName")) {
                Storage::disk('public')->delete("komik-cover/$coverName");
            }
            if (isset($pdfName) && Storage::disk('public')->exists("komik/$pdfName")) {
                Storage::disk('public')->delete("komik/$pdfName");
            }

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menambahkan komik. ' . $e->getMessage()
                ], 500);
            }

            return redirect()->route('komik.index')->with('error', 'Gagal menambahkan komik. '.$e->getMessage());
        }
    }

    // Menampilkan detail komik
    public function show($id)
    {
        $komik = Komik::findOrFail($id);
        return view('admin.show-komik', compact('komik'));
    }

    // Form edit komik
    public function edit($id)
    {
        $komik = Komik::findOrFail($id);
        return view('admin.edit-komik', compact('komik'));
    }

    // Update komik
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'       => 'required|string|max:255',
            'penulis'     => 'required|string|max:255',
            'cover'       => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
            'file_pdf' => 'nullable|mimes:pdf|max:102400',
            'jml_halaman' => 'nullable|integer|min:1',
        ]);

        $komik = Komik::findOrFail($id);

        DB::beginTransaction();

        try {
            // Upload Cover Baru (jika ada)
            if ($request->hasFile('cover')) {
                // Hapus cover lama
                if (Storage::disk('public')->exists("komik-cover/{$komik->cover}")) {
                    Storage::disk('public')->delete("komik-cover/{$komik->cover}");
                }

                // Upload cover baru
                $coverFile = $request->file('cover');
                $coverName = $coverFile->hashName();
                $coverFile->storeAs('komik-cover', $coverName, 'public');
                $komik->cover = $coverName;
            }

            // Upload PDF Baru (jika ada)
            if ($request->hasFile('file_pdf')) {
                // Hapus file lama
                if (Storage::disk('public')->exists("komik/{$komik->file_pdf}")) {
                    Storage::disk('public')->delete("komik/{$komik->file_pdf}");
                }

                // Upload file baru
                $pdfFile = $request->file('file_pdf');
                $pdfName = $pdfFile->hashName();
                $pdfFile->storeAs('komik', $pdfName, 'public');
                $komik->file_pdf = $pdfName;
            }

            $komik->judul       = $request->judul;
            $komik->penulis     = $request->penulis;
            $komik->jml_halaman = $request->jml_halaman ?? $komik->jml_halaman;
            $komik->save();

            DB::commit();

            // Support AJAX
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Komik berhasil diperbarui.'
                ]);
            }

            return redirect()->route('komik.index')->with('success', 'Komik berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal memperbarui komik. ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->route('komik.index')->with('error', 'Gagal memperbarui komik. '.$e->getMessage());
        }
    }

    // Hapus komik
    public function destroy($id)
    {
        $komik = Komik::findOrFail($id);

        DB::beginTransaction();

        try {
            // Hapus cover
            if (Storage::disk('public')->exists("komik-cover/{$komik->cover}")) {
                Storage::disk('public')->delete("komik-cover/{$komik->cover}");
            }

            // Hapus file PDF
            if (Storage::disk('public')->exists("komik/{$komik->file_pdf}")) {
                Storage::disk('public')->delete("komik/{$komik->file_pdf}");
            }

            $komik->delete();

            DB::commit();

            return redirect()->route('komik.index')->with('success', 'Komik berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('komik.index')->with('error', 'Gagal menghapus komik. '.$e->getMessage());
        }
    }
}