<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
    
        DB::beginTransaction();
    
        try {
            // Periksa apakah ada file foto yang di-upload
            if ($request->hasFile('foto')) {
                // Ambil nama file yang dihasilkan dari upload foto
                $imageName = $request->file('foto')->hashName();
                // Simpan file foto ke dalam folder 'galeri' di storage
                $request->file('foto')->storeAs('galeri', $imageName, 'public');
    
                // Simpan data galeri ke dalam database
                Galeri::create([
                    'foto' => $imageName,  // Simpan nama file foto yang baru
                    'deskripsi' => $request->deskripsi,  // Simpan deskripsi
                ]);
    
                DB::commit();
    
                return response()->json([
                    'success' => true,
                    'message' => 'Foto berhasil ditambahkan ke galeri.',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Foto harus diunggah.',
                ]);
            }
    
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route(route: 'add-galeri')->with('success', 'Foto berhasil ditambahkan ke galeri.');
        }
    }
    
    

      // Menampilkan detail galeri untuk edit
      public function show($id)
      {
          $galeri = galeri::findOrFail($id);
          return view('admin.edit-galeri', compact('galeri'));
      }
      public function update(Request $request, $id_galeri)
      {
          $request->validate([
              'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10240', // max 10MB
              'deskripsi' => 'required|string|max:255',
          ]);
      
          $galeri = Galeri::findOrFail($id_galeri);
      
          DB::beginTransaction();
      
          try {
              // Cek jika ada foto baru
              if ($request->hasFile('foto')) {
                  // Hapus foto lama jika ada
                  if (Storage::disk('public')->exists("galeri/{$galeri->foto}")) {
                      Storage::disk('public')->delete("galeri/{$galeri->foto}");
                  }
      
                  // Upload foto baru
                  $imageName = $request->file('foto')->hashName();
                  $request->file('foto')->storeAs('galeri', $imageName, 'public');
                  $galeri->foto = $imageName;
              }
      
              // Update data galeri (deskripsi dan foto)
              $galeri->deskripsi = $request->deskripsi;
              $galeri->save();
      
              DB::commit();
      
              return redirect()->route('galeri.index')->with('success', 'Galeri berhasil diperbarui.');
          } catch (\Exception $e) {
              DB::rollBack();
              return redirect()->route('galeri.index')->with('error', 'Gagal memperbarui galeri: ' . $e->getMessage());
          }
      }
      
  
      // Hapus galeri
      public function destroy($id)
      {
          $galeri = galeri::findOrFail($id);
  
          DB::beginTransaction();
  
          try {
              // Hapus foto dari storage
              Storage::disk('public')->delete('galeri/' . $galeri->foto);
  
              // Hapus data dari database
              $galeri->delete();
  
              DB::commit();
  
              return redirect()->route('galeri.index')->with('success', 'Kegiatan berhasil dihapus.');
  
          } catch (\Exception $e) {
              DB::rollBack();
              return back()->with('error', 'Gagal menghapus galeri. ' . $e->getMessage());
          }
      }
  }
  
