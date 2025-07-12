<?php

namespace App\Http\Controllers;

use App\Models\Hadiah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HadiahController extends Controller
{
    public function index()
    {
        $hadiahList = Hadiah::latest()->get();
        return view('admin.view-hadiah', compact('hadiahList'));
    }

    public function create()
    {
        return view('admin.add-hadiah');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_hadiah' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:15360',
            'stok' => 'required|integer|min:0',
            'point_satuan' => 'required|integer|min:0',
        ], [
            'nama_hadiah.required' => 'Nama hadiah wajib diisi',
            'nama_hadiah.max' => 'Nama hadiah maksimal 255 karakter',
            'deskripsi.required' => 'Deskripsi wajib diisi',
            'foto.required' => 'Foto wajib diupload',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format foto harus jpeg, png, atau jpg',
            'foto.max' => 'Ukuran foto maksimal 15MB',
            'stok.required' => 'Stok wajib diisi',
            'stok.integer' => 'Stok harus berupa angka',
            'stok.min' => 'Stok tidak boleh kurang dari 0',
            'point_satuan.required' => 'Poin satuan wajib diisi',
            'point_satuan.integer' => 'Poin satuan harus berupa angka',
            'point_satuan.min' => 'Poin satuan tidak boleh kurang dari 0',
        ]);

        DB::beginTransaction();

        try {
            // Upload foto
            $imageName = $request->file('foto')->hashName();
            $request->file('foto')->storeAs('hadiah', $imageName, 'public');

            // Sanitasi input
            $namaHadiah = strip_tags(trim($request->nama_hadiah));
            $deskripsi = strip_tags(trim($request->deskripsi));

            // Simpan data hadiah
            Hadiah::create([
                'nama_hadiah' => $namaHadiah,
                'deskripsi' => $deskripsi,
                'foto' => $imageName,
                'stok' => $request->stok,
                'point_satuan' => $request->point_satuan,
            ]);

            DB::commit();

            return response()->json([
                'success' => true, 
                'message' => 'Hadiah berhasil ditambahkan!'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false, 
                'message' => 'Data tidak valid!',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            DB::rollBack();
            
            // Hapus file yang sudah diupload jika terjadi error
            if (isset($imageName) && Storage::disk('public')->exists('hadiah/' . $imageName)) {
                Storage::disk('public')->delete('hadiah/' . $imageName);
            }
            
            return response()->json([
                'success' => false, 
                'message' => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.'
            ], 500);
        }
    }

    public function show($id)
    {
        $hadiah = Hadiah::findOrFail($id);
        return view('admin.edit-hadiah', compact('hadiah'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_hadiah' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'stok' => 'required|integer|min:0',
            'point_satuan' => 'required|integer|min:0',
        ], [
            'nama_hadiah.required' => 'Nama hadiah wajib diisi',
            'nama_hadiah.max' => 'Nama hadiah maksimal 255 karakter',
            'deskripsi.required' => 'Deskripsi wajib diisi',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format foto harus jpeg, png, atau jpg',
            'foto.max' => 'Ukuran foto maksimal 2MB',
            'stok.required' => 'Stok wajib diisi',
            'stok.integer' => 'Stok harus berupa angka',
            'stok.min' => 'Stok tidak boleh kurang dari 0',
            'point_satuan.required' => 'Poin satuan wajib diisi',
            'point_satuan.integer' => 'Poin satuan harus berupa angka',
            'point_satuan.min' => 'Poin satuan tidak boleh kurang dari 0',
        ]);

        $hadiah = Hadiah::findOrFail($id);

        DB::beginTransaction();

        try {
            $oldImage = $hadiah->foto;
            $imageName = $oldImage; // Default to old image

            // Update foto jika ada file baru
            if ($request->hasFile('foto')) {
                // Hapus foto lama jika ada
                if ($oldImage && Storage::disk('public')->exists('hadiah/' . $oldImage)) {
                    Storage::disk('public')->delete('hadiah/' . $oldImage);
                }
                
                // Upload foto baru
                $imageName = $request->file('foto')->hashName();
                $request->file('foto')->storeAs('hadiah', $imageName, 'public');
            }

            // Sanitasi input dan update data
            $hadiah->update([
                'nama_hadiah' => strip_tags(trim($request->nama_hadiah)),
                'deskripsi' => strip_tags(trim($request->deskripsi)),
                'foto' => $imageName,
                'stok' => $request->stok,
                'point_satuan' => $request->point_satuan,
            ]);

            DB::commit();

            // Check if request is AJAX
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Hadiah berhasil diperbarui!'
                ]);
            }

            return redirect()->route('hadiah.index')->with('success', 'Hadiah berhasil diperbarui!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            
            // Hapus foto baru jika upload gagal
            if (isset($imageName) && $imageName !== $oldImage && Storage::disk('public')->exists('hadiah/' . $imageName)) {
                Storage::disk('public')->delete('hadiah/' . $imageName);
            }
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak valid!',
                    'errors' => $e->errors()
                ], 422);
            }

            return redirect()->route('hadiah.index')->with('error', 'Data tidak valid. Silakan periksa kembali input Anda.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            // Hapus foto baru jika upload gagal
            if (isset($imageName) && $imageName !== $oldImage && Storage::disk('public')->exists('hadiah/' . $imageName)) {
                Storage::disk('public')->delete('hadiah/' . $imageName);
            }
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat memperbarui data. Silakan coba lagi.'
                ], 500);
            }
            
            return redirect()->route('hadiah.index')->with('error', 'Terjadi kesalahan saat memperbarui data. Silakan coba lagi.');
        }
    }

    public function destroy($id)
    {
        $hadiah = Hadiah::findOrFail($id);

        DB::beginTransaction();

        try {
            // Hapus foto dari storage jika ada
            if ($hadiah->foto && Storage::disk('public')->exists('hadiah/' . $hadiah->foto)) {
                Storage::disk('public')->delete('hadiah/' . $hadiah->foto);
            }

            // Hapus data dari database
            $hadiah->delete();

            DB::commit();

            // Check if request is AJAX
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Hadiah berhasil dihapus!'
                ]);
            }

            return redirect()->route('hadiah.index')->with('success', 'Hadiah berhasil dihapus!');

        } catch (\Exception $e) {
            DB::rollBack();
            
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghapus hadiah. ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->route('hadiah.index')->with('error', 'Gagal menghapus hadiah. ' . $e->getMessage());
        }
    }
}