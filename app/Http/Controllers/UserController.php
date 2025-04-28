<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Komunitas;
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
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'komunitas',
        ]);
    
        // Simpan ke tabel alamat
        $alamat = \App\Models\Alamat::create([
            'alamat' => $request->alamat,
            'id_kelurahan' => $request->kelurahan,
            'kode_pos' => $request->kode_pos,
        ]);
    
        // Simpan komunitas
        Komunitas::create([
            'id_user' => $user->id_user,
            'nama' => $request->nama,
            'no_telp' => $request->no_telp,
            'id_alamat' => $alamat->id_alamat,
        ]);
    
        return redirect()->back()->with('success', 'Registrasi berhasil!');
    }
    
    public function getKelurahan($id_kecamatan)
{
    $kelurahan = \App\Models\Kelurahan::where('id_kecamatan', $id_kecamatan)->get();
    return response()->json($kelurahan);
}


public function showRegisterForm()
{
    $kecamatan = \App\Models\Kecamatan::all(); // ambil semua kecamatan dari database

    return view('/register', compact('kecamatan'));
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
        // Ambil hanya pengguna yang memiliki role 'komunitas'
        $komunitas = Komunitas::whereHas('user', function ($query) {
            $query->where('role', 'komunitas');
        })->get();
    
        return view('/admin/view-komunitas', compact('komunitas')); 
    }
}