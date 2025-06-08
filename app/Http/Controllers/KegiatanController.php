<?php

namespace App\Http\Controllers;

use App\Models\kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{

public function dataPesertaKegiatan()
{
    $kegiatans = Kegiatan::withCount('pendaftaran')->get();
    return view('admin.view-peserta-kegiatan', compact('kegiatans'));
}

// KegiatanController.php
public function semuaKegiatan()
{
    $semuaKegiatan = Kegiatan::orderBy('id_kegiatan', 'desc')->get();
return view('kegiatan', compact('semuaKegiatan'));
}


    // Tampil semua kegiatan
    public function index()
    {
        $kegiatans = kegiatan::latest()->get();
        return view('admin.view-kegiatan', compact('kegiatans'));
    }

    // Menampilkan form tambah kegiatan
    public function create()
    {
        return view('admin.add-kegiatan');
    }

    // Menyimpan kegiatan baru
    public function kegiatan(Request $request)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'foto' => 'required|image|mimes:jpeg,png,jpg|max:15360',
        'isi' => 'required|string',
        'lokasi' => 'required|string',
        'kouta' => 'required|integer|min:0|max:99999999999',
        'tanggal_kegiatan' => 'required|date_format:Y-m-d\TH:i|after_or_equal:now',
    ]);

    DB::beginTransaction();

    try {
        $imageName = $request->file('foto')->hashName();
        $request->file('foto')->storeAs('kegiatan', $imageName, 'public');

        kegiatan::create([
            'judul' => $request->judul,
            'foto' => $imageName,
            'isi' => $request->isi,
            'lokasi' => $request->lokasi,
            'kouta' => $request->kouta,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
        ]);

        DB::commit();

        // Redirect dengan pesan sukses
        return redirect()->route('kegiatan.form')->with('success', 'Kegiatan berhasil ditambahkan.');
    } catch (\Exception $e) {
        DB::rollBack();

        // Redirect dengan pesan error
        return redirect()->route('kegiatan.form')->with('error', 'Gagal menambahkan kegiatan. ' . $e->getMessage());
    }
}

    // Menampilkan detail kegiatan untuk edit
    public function show($id)
    {
        $kegiatan = kegiatan::findOrFail($id);
        return view('admin.edit-kegiatan', compact('kegiatan'));
    }
    public function update(Request $request, $id_kegiatan)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:15360', // 15 MB
            'isi'   => 'required|string', 
            'lokasi' => 'required|string|max:255',
            'kouta' => 'required|integer|min:0|max:99999999999',
            'tanggal_kegiatan' => 'required|date', 
        ]);
    
        $kegiatan = Kegiatan::findOrFail($id_kegiatan);
    
        DB::beginTransaction();
    
        try {
            // Cek jika ada foto baru
            if ($request->hasFile('foto')) {
                // Hapus foto lama jika ada
                if (Storage::disk('public')->exists("kegiatan/{$kegiatan->foto}")) {
                    Storage::disk('public')->delete("kegiatan/{$kegiatan->foto}");
                }
    
                // Upload foto baru
                $imageName = $request->file('foto')->hashName();
                $request->file('foto')->storeAs('kegiatan', $imageName, 'public');
                $kegiatan->foto = $imageName;
            }
    
            // Update data kegiatan
            $kegiatan->judul = $request->judul;
            $kegiatan->isi = $request->isi;
            $kegiatan->lokasi = $request->lokasi;
            $kegiatan->kouta = $request->kouta;
            $kegiatan->tanggal_kegiatan = $request->tanggal_kegiatan;
            $kegiatan->save();
    
            DB::commit();
    
            return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
    
            return redirect()->route('kegiatan.index')->with('error', 'Gagal memperbarui kegiatan. ' . $e->getMessage());
        }
    }

    // Hapus kegiatan
    public function destroy($id)
    {
        $kegiatan = kegiatan::findOrFail($id);

        DB::beginTransaction();

        try {
            // Hapus foto dari storage
            Storage::disk('public')->delete('kegiatan/' . $kegiatan->foto);

            // Hapus data dari database
            $kegiatan->delete();

            DB::commit();

            return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus kegiatan. ' . $e->getMessage());
        }
    }
}
