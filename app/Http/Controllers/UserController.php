<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Point;
use App\Models\Alamat;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Komunitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // Validasi tetap seperti biasa
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'komunitas',
        ]);

        $alamat = Alamat::create([
            'alamat'       => $request->alamat,
            'id_kelurahan' => $request->kelurahan,
            'kode_pos'     => $request->kode_pos,
        ]);

        $komunitas = Komunitas::create([
            'id_user'   => $user->id_user,
            'nama'      => $request->nama,
            'no_telp'   => $request->no_telp,
            'id_alamat' => $alamat->id_alamat,
        ]);
        
        Point::create([
            'id_komunitas'   => $komunitas->id_komunitas,
            'point'          => 0,
            'expired_point'  => now()->addYear(),
        ]);
        

        return redirect()->back()->with('success', 'Registrasi berhasil!');
    }

    public function getKelurahan($id_kecamatan)
    {
        $kelurahan = Kelurahan::where('id_kecamatan', $id_kecamatan)->get();
        return response()->json($kelurahan);
    }

    public function showRegisterForm()
    {
        $kecamatan = Kecamatan::all();
        return view('/register', compact('kecamatan'));
    }

    public function showAddKomunitasForm()
    {
        $kecamatan = Kecamatan::all();
        return view('/admin/add-komunitas', compact('kecamatan'));
    }

// Menampilkan data komunitas untuk modal
public function showKomunitas($id)
{
    $komunitas = Komunitas::with(['user', 'alamat.kelurahan.kecamatan'])->find($id);

    if ($komunitas) {
        return response()->json([
            'id' => $komunitas->id_komunitas,
            'nama' => $komunitas->nama,
            'no_telp' => $komunitas->no_telp,
            'alamat' => $komunitas->alamat->alamat ?? '',
            'kode_pos' => $komunitas->alamat->kode_pos ?? '',
            'kelurahan' => $komunitas->alamat->kelurahan->kelurahan ?? '',
            'kecamatan' => $komunitas->alamat->kelurahan->kecamatan->kecamatan ?? '',
            'email' => $komunitas->user->email ?? '',
            'username' => $komunitas->user->username ?? '',
        ]);
    }

    return response()->json(['error' => 'Komunitas tidak ditemukan'], 404);
}


    public function updateKomunitas(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'nama' => 'required',
            'no_telp' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'kode_pos' => 'required',
        ]);

        // Ambil komunitas berdasarkan ID
        $komunitas = Komunitas::with('user', 'alamat')->find($id);

        // Jika komunitas tidak ditemukan, kembalikan error
        if (!$komunitas) {
            return response()->json(['error' => 'Komunitas tidak ditemukan'], 404);
        }

        // Update data komunitas
        $komunitas->update([
            'nama' => $request->nama,
            'no_telp' => $request->no_telp,
        ]);

        // Update data user
        $komunitas->user->update([
            'username' => $request->username,
            'email' => $request->email,
        ]);

        // Update data alamat
        $komunitas->alamat->update([
            'alamat' => $request->alamat,
            'kode_pos' => $request->kode_pos,
        ]);

        // Kembalikan response sukses
        return response()->json(['success' => 'Data komunitas berhasil diperbarui']);
    }




// Hapus komunitas
public function deleteKomunitas($id)
{
    // Cek apakah ID diterima dengan benar
    Log::info('Delete Komunitas ID: ' . $id);

    // Ambil data komunitas beserta relasi yang dibutuhkan
    $komunitas = Komunitas::with(['user', 'alamat', 'point'])->find($id);

    // Cek apakah data komunitas ditemukan
    if (!$komunitas) {
        return response()->json(['error' => 'Komunitas tidak ditemukan'], 404);
    }

    // Hapus relasi terkait jika ada
    if ($komunitas->point) {
        $komunitas->point->delete();
    }

    if ($komunitas->alamat) {
        $komunitas->alamat->delete();
    }

    if ($komunitas->user) {
        $komunitas->user->delete();
    }

    // Hapus data komunitas itu sendiri
    $komunitas->delete();

    // Kembalikan response sukses
    return response()->json(['success' => 'Data komunitas berhasil dihapus']);
}




    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }

    public function data_pengguna()
    {
        $komunitas = Komunitas::whereHas('user', function ($query) {
            $query->where('role', 'komunitas');
        })->get();

        return view('/admin/index', compact('komunitas'));
    }

    public function data_komunitas()
    {
        $komunitas = Komunitas::whereHas('user', function ($query) {
            $query->where('role', 'komunitas');
        })->get();

        return view('/admin/view-komunitas', compact('komunitas'));
    }
}
