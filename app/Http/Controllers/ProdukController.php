<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Komunitas;
use App\Models\PengajuanBankSampah;
use App\Models\BankSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProdukController extends Controller
{
    /**
     * Get the authenticated user's Bank Sampah ID.
     *
     * @return int|null
     */
    private function getAuthBankSampahId()
    {
        $user = Auth::user();
        if (!$user) {
            return null; // Not authenticated
        }

        $komunitas = $user->komunitas;
        if (!$komunitas) {
            return null; // User not linked to a Komunitas
        }

        $pengajuanBankSampahDisetujui = $komunitas->pengajuanBankSampah()
                                                  ->where('status', 'diterima')
                                                  ->first();

        if (!$pengajuanBankSampahDisetujui || !$pengajuanBankSampahDisetujui->bank_sampah) {
            return null; // No approved Bank Sampah application or Bank Sampah data missing
        }

        return $pengajuanBankSampahDisetujui->bank_sampah->id_bank_sampah;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $idBankSampahProduk = $this->getAuthBankSampahId();

        if (!$idBankSampahProduk) {
            // Redirect or show an error if the user is not a valid Bank Sampah
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk mengelola produk Bank Sampah.');
        }

        // Mendapatkan produk yang diurutkan berdasarkan tanggal pembuatan terbaru
        // Filter produk berdasarkan id_bank_sampah milik pengguna yang login
        $produk = Produk::where('id_bank_sampah', $idBankSampahProduk)
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('dashboard.view-produk', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $idBankSampahProduk = $this->getAuthBankSampahId();

        if (!$idBankSampahProduk) {
            return redirect()->back()->with('error', 'Anda harus memiliki pengajuan Bank Sampah yang disetujui untuk menambahkan produk.');
        }

        return view('dashboard.add-produk');
    }

    /**
     * Store a newly created resource in storage.
     */
  public function store(Request $request)
{
    $idBankSampahProduk = $this->getAuthBankSampahId();

    // Validasi otentikasi pengguna dan Bank Sampah
    if (!Auth::check()) {
        $message = 'Anda harus login untuk menambahkan produk.';
        return $request->ajax() ? response()->json(['success' => false, 'message' => $message], 401) : redirect()->back()->with('error', $message)->withInput();
    }

    if (!$idBankSampahProduk) {
        $message = 'Akun Anda tidak terhubung dengan Bank Sampah yang disetujui untuk menambah produk.';
        return $request->ajax() ? response()->json(['success' => false, 'message' => $message], 403) : redirect()->back()->with('error', $message)->withInput();
    }

    // Validasi input form
    $request->validate([
        'nama_produk' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'harga' => 'required|numeric|min:1000',
        'stok' => 'required|integer|min:1',
        'foto' => 'required|image|mimes:jpeg,jpg,png|max:2048' // Max 2MB
    ], [
        'nama_produk.required' => 'Nama produk wajib diisi.',
        'nama_produk.max' => 'Nama produk tidak boleh lebih dari 255 karakter.',
        'deskripsi.required' => 'Deskripsi produk wajib diisi.',
        'harga.required' => 'Harga produk wajib diisi.',
        'harga.numeric' => 'Harga produk harus berupa angka.',
        'harga.min' => 'Harga produk tidak boleh kurang dari 0.',
        'stok.required' => 'Stok produk wajib diisi.',
        'stok.integer' => 'Stok produk harus berupa angka.',
        'stok.min' => 'Stok produk tidak boleh kurang dari 0.',
        'foto.required' => 'Foto produk wajib diupload.',
        'foto.image' => 'File harus berupa gambar.',
        'foto.mimes' => 'Format foto harus JPEG, JPG, atau PNG.',
        'foto.max' => 'Ukuran foto maksimal 2MB.'
    ]);

    DB::beginTransaction(); // Mulai transaksi database

    try {
        $fotoName = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = $foto->hashName();
            $foto->storeAs('produk', $fotoName, 'public');
        }

        // Sanitasi input sebelum disimpan ke database
        $namaProduk = strip_tags(trim($request->nama_produk));
        $deskripsi = strip_tags(trim($request->deskripsi));

        Produk::create([
            'id_bank_sampah' => $idBankSampahProduk, // Use the authenticated user's bank_sampah_id
            'nama_produk' => $namaProduk,
            'deskripsi' => $deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'foto' => $fotoName
        ]);

        DB::commit(); // Commit transaksi jika berhasil

        $message = 'Produk berhasil ditambahkan!';
        // Ubah bagian ini - hapus redirect dan hanya return JSON response
        return $request->ajax() ? response()->json(['success' => true, 'message' => $message]) : redirect()->back()->with('success', $message);

    } catch (\Illuminate\Validation\ValidationException $e) {
        DB::rollBack(); // Rollback transaksi jika validasi gagal
        if (isset($fotoName) && Storage::disk('public')->exists('produk/' . $fotoName)) {
            Storage::disk('public')->delete('produk/' . $fotoName);
        }
        return $request->ajax() ? response()->json(['success' => false, 'message' => 'Data tidak valid!', 'errors' => $e->errors()], 422) : redirect()->back()->withErrors($e->errors())->withInput();
    }
    catch (\Exception $e) {
        DB::rollBack(); // Rollback transaksi jika ada error lain
        Log::error('Error adding product: ' . $e->getMessage());

        if (isset($fotoName) && Storage::disk('public')->exists('produk/' . $fotoName)) {
            Storage::disk('public')->delete('produk/' . $fotoName);
        }

        $message = 'Terjadi kesalahan saat menyimpan data produk. Silakan coba lagi.';
        return $request->ajax() ? response()->json(['success' => false, 'message' => $message], 500) : redirect()->back()->with('error', $message)->withInput();
    }
}

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        $idBankSampahProduk = $this->getAuthBankSampahId();

        if (!$idBankSampahProduk || $produk->id_bank_sampah !== $idBankSampahProduk) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk melihat produk ini.');
        }
        return view('dashboard.show-produk', compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        $idBankSampahProduk = $this->getAuthBankSampahId();

        if (!$idBankSampahProduk || $produk->id_bank_sampah !== $idBankSampahProduk) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk mengedit produk ini.');
        }
        return view('dashboard.edit-produk', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $idBankSampahProduk = $this->getAuthBankSampahId();

        if (!$idBankSampahProduk) {
            $message = 'Anda tidak memiliki akses untuk memperbarui produk ini.';
            return $request->ajax() ? response()->json(['success' => false, 'message' => $message], 403) : redirect()->back()->with('error', $message)->withInput();
        }

        $produk = Produk::findOrFail($id);

        // Ensure the product belongs to the authenticated user's Bank Sampah
        if ($produk->id_bank_sampah !== $idBankSampahProduk) {
            $message = 'Anda tidak memiliki izin untuk memperbarui produk ini.';
            return $request->ajax() ? response()->json(['success' => false, 'message' => $message], 403) : redirect()->back()->with('error', $message)->withInput();
        }

        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:1000',
            'stok' => 'required|integer|min:1',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048' // Max 2MB, nullable karena bisa tidak diubah
        ], [
            'nama_produk.required' => 'Nama produk wajib diisi.',
            'nama_produk.max' => 'Nama produk tidak boleh lebih dari 255 karakter.',
            'deskripsi.required' => 'Deskripsi produk wajib diisi.',
            'harga.required' => 'Harga produk wajib diisi.',
            'harga.numeric' => 'Harga produk harus berupa angka.',
            'harga.min' => 'Harga produk tidak boleh kurang dari 0.',
            'stok.required' => 'Stok produk wajib diisi.',
            'stok.integer' => 'Stok produk harus berupa angka.',
            'stok.min' => 'Stok produk tidak boleh kurang dari 0.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format foto harus JPEG, JPG, atau PNG.',
            'foto.max' => 'Ukuran foto maksimal 2MB.'
        ]);

        DB::beginTransaction(); // Mulai transaksi database

        try {
            $oldFotoName = $produk->foto; // Simpan nama foto lama
            $currentFotoName = $oldFotoName; // Default ke nama foto lama

            if ($request->hasFile('foto')) {
                // Hapus foto lama dari storage jika ada dan merupakan file yang valid
                if ($oldFotoName && Storage::disk('public')->exists('produk/' . $oldFotoName)) {
                    Storage::disk('public')->delete('produk/' . $oldFotoName);
                }

                $foto = $request->file('foto');
                $currentFotoName = $foto->hashName();
                $foto->storeAs('produk', $currentFotoName, 'public');
            }

            // Sanitasi input sebelum update
            $produk->nama_produk = strip_tags(trim($request->nama_produk));
            $produk->deskripsi = strip_tags(trim($request->deskripsi));
            $produk->harga = $request->harga;
            $produk->stok = $request->stok;
            $produk->foto = $currentFotoName; // Update dengan nama foto baru atau lama
            $produk->save();

            DB::commit(); // Commit transaksi jika berhasil

            $message = 'Produk berhasil diperbarui!';
            return $request->ajax() ? response()->json(['success' => true, 'message' => $message]) : redirect()->route('produk.index')->with('success', $message);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack(); // Rollback transaksi jika validasi gagal
            if (isset($currentFotoName) && $currentFotoName !== $oldFotoName && Storage::disk('public')->exists('produk/' . $currentFotoName)) {
                Storage::disk('public')->delete('produk/' . $currentFotoName);
            }
            return $request->ajax() ? response()->json(['success' => false, 'message' => 'Data tidak valid!', 'errors' => $e->errors()], 422) : redirect()->back()->withErrors($e->errors())->withInput();
        }
        catch (\Exception $e) {
            DB::rollBack(); // Rollback transaksi jika ada error lain
            Log::error('Error updating product (ID: ' . $id . '): ' . $e->getMessage());

            if (isset($currentFotoName) && $currentFotoName !== $oldFotoName && Storage::disk('public')->exists('produk/' . $currentFotoName)) {
                Storage::disk('public')->delete('produk/' . $currentFotoName);
            }

            $message = 'Terjadi kesalahan saat memperbarui data produk. Silakan coba lagi.';
            return $request->ajax() ? response()->json(['success' => false, 'message' => $message], 500) : redirect()->back()->with('error', $message)->withInput();
        }
    }

   public function destroy(Request $request, $id) // Tambahkan Request $request
    {
        $idBankSampahProduk = $this->getAuthBankSampahId();

        if (!$idBankSampahProduk) {
            $message = 'Anda tidak memiliki akses untuk menghapus produk.';
            // Jika request via AJAX, kirim JSON. Jika tidak, redirect.
            return $request->ajax()
                ? response()->json(['success' => false, 'message' => $message], 403)
                : redirect()->route('produk.index')->with('error', $message);
        }

        DB::beginTransaction(); // Mulai transaksi database

        try {
            $produk = Produk::findOrFail($id);

            // Pastikan produk milik Bank Sampah pengguna yang terautentikasi
            if ($produk->id_bank_sampah !== $idBankSampahProduk) {
                $message = 'Anda tidak memiliki izin untuk menghapus produk ini.';
                DB::rollBack(); // Batalkan transaksi jika tidak berizin
                return $request->ajax()
                    ? response()->json(['success' => false, 'message' => $message], 403)
                    : redirect()->route('produk.index')->with('error', $message);
            }

            $fotoToDelete = $produk->foto; // Simpan nama foto untuk dihapus nanti

            $produk->delete(); // Hapus entri dari database

            // Hapus foto dari storage setelah berhasil menghapus dari DB
            if ($fotoToDelete && Storage::disk('public')->exists('produk/' . $fotoToDelete)) {
                Storage::disk('public')->delete('produk/' . $fotoToDelete);
            }

            DB::commit(); // Commit transaksi jika berhasil

            $message = 'Produk berhasil dihapus!';
           
            return redirect()->route('produk.index')->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaksi jika terjadi error
            Log::error('Error deleting product (ID: ' . $id . '): ' . $e->getMessage());

            $message = 'Tidak dapat menghapus produk. produk telah memeiliki transaksi';
           
            return redirect()->route('produk.index')->with('error', $message);
        }
    }
}