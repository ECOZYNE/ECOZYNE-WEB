<?php

namespace App\Http\Controllers;

use App\Models\Hadiah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HadiahController extends Controller
{
    // Menampilkan semua hadiah
    public function index()
    {
        $hadiahList = Hadiah::latest()->get();
        return view('admin.view-hadiah', compact('hadiahList'));
    }

    // Menampilkan form tambah hadiah
    public function create()
    {
        return view('admin.add-hadiah');
    }

    // Simpan hadiah baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_hadiah' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'stok' => 'required|integer|min:0',
            'poin_per_item' => 'required|integer|min:0',
        ]);

        DB::beginTransaction();

        try {
            if (!$request->hasFile('foto')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Foto harus diunggah.',
                ]);
            }

            $imageName = $request->file('foto')->hashName();
            $request->file('foto')->storeAs('hadiah', $imageName, 'public');

            Hadiah::create([
                'nama_hadiah' => $request->nama_hadiah,
                'deskripsi' => $request->deskripsi,
                'foto' => $imageName,
                'stok' => $request->stok,
                'point_satuan' => $request->poin_per_item,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Hadiah berhasil ditambahkan.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan hadiah. ' . $e->getMessage(),
            ]);
        }
    }

    // Menampilkan form edit
    public function show($id)
    {
        $hadiah = Hadiah::findOrFail($id);
        return view('admin.edit-hadiah', compact('hadiah'));
    }

    // Update hadiah
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_hadiah' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'stok' => 'required|integer|min:0',
            'poin_per_item' => 'required|integer|min:0',
        ]);

        $hadiah = Hadiah::findOrFail($id);

        DB::beginTransaction();

        try {
            if ($request->hasFile('foto')) {
                if (Storage::disk('public')->exists('hadiah/' . $hadiah->foto)) {
                    Storage::disk('public')->delete('hadiah/' . $hadiah->foto);
                }

                $imageName = $request->file('foto')->hashName();
                $request->file('foto')->storeAs('hadiah', $imageName, 'public');
                $hadiah->foto = $imageName;
            }

            $hadiah->nama_hadiah = $request->nama_hadiah;
            $hadiah->deskripsi = $request->deskripsi;
            $hadiah->stok = $request->stok;
            $hadiah->point_satuan = $request->poin_per_item;
            $hadiah->save();

            DB::commit();

            return redirect()->route('hadiah.index')->with('success', 'Hadiah berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('hadiah.index')->with('error', 'Gagal memperbarui hadiah: ' . $e->getMessage());
        }
    }

    // Hapus hadiah
    public function destroy($id)
    {
        $hadiah = Hadiah::findOrFail($id);

        DB::beginTransaction();

        try {
            if (Storage::disk('public')->exists('hadiah/' . $hadiah->foto)) {
                Storage::disk('public')->delete('hadiah/' . $hadiah->foto);
            }

            $hadiah->delete();

            DB::commit();

            return redirect()->route('hadiah.index')->with('success', 'Hadiah berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus hadiah: ' . $e->getMessage());
        }
    }
}
