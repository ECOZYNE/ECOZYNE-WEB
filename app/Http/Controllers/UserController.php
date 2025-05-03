<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Komunitas;
use App\Models\Alamat;
use App\Models\Kelurahan;
use App\Models\Kecamatan;
use App\Models\Point;
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
    $komunitas = Komunitas::with('user', 'alamat')->find($id);
    if ($komunitas) {
        return response()->json([
            'id' => $komunitas->id_komunitas,
            'nama' => $komunitas->nama,
            'no_telp' => $komunitas->no_telp,
            'alamat' => $komunitas->alamat->alamat, // Sesuaikan jika Anda membutuhkan data alamat lebih lengkap
        ]);
    }
    return response()->json(['error' => 'Komunitas tidak ditemukan'], 404);
}

// Hapus komunitas
public function deleteKomunitas($id)
{
    $komunitas = Komunitas::find($id);
    if ($komunitas) {
        $komunitas->delete();
        return response()->json(['success' => 'Komunitas berhasil dihapus']);
    }
    return response()->json(['error' => 'Komunitas tidak ditemukan'], 404);
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
