<?php

namespace App\Http\Controllers;

use App\Models\kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kegiatans = kegiatan::latest()->get();
        return view('admin.view-kegiatan', compact('kegiatans'));
    }


     // Menampilkan form tambah kegiatan
     public function create()
     {
         return view('admin.add-kegiatan'); // Pastikan file ini ada di resources/views/admin/add-kegiatan.blade.php
     }


   // Menyimpan kegiatan baru
   public function kegiatan(Request $request)
   {
       $request->validate([
           'judul' => 'required|string|max:255',
           'foto' => 'required|image|mimes:jpeg,png,jpg|max:15360', // 15 MB (15360 KB)
           'isi' => 'required|string',
       ]);

       try {
           $imageName = $request->file('foto')->hashName(); // Ambil nama acak hasil hash
           $request->file('foto')->storeAs('kegiatan', $imageName, 'public'); // Simpan di folder kegiatan

           // Simpan hanya nama file-nya ke database
           

           kegiatan::create([
               'judul' => $request->judul,
               'foto' => $imageName, // hanya nama file
               'isi' => $request->isi,
           ]);
           

           return response()->json(['success' => true, 'message' => 'Kegiatan berhasil ditambahkan.']);

       } catch (\Exception $e) {
           return response()->json(['success' => false, 'message' => 'Gagal menambahkan kegiatan. ' . $e->getMessage()], 500);
       }
   }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(kegiatan $kegiatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kegiatan $kegiatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, kegiatan $kegiatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(kegiatan $kegiatan)
    {
        //
    }
}
