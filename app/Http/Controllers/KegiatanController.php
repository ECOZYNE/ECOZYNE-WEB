<?php

namespace App\Http\Controllers;

use App\Models\kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:15360', // 15 MB
            'isi' => 'required|string',
            'lokasi' => 'required|string',
            'waktu' => 'required|date_format:Y-m-d\TH:i|after_or_equal:now',
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
                'waktu' => $request->waktu,
            ]);

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Kegiatan berhasil ditambahkan.']);

        } catch (\Exception $e) {
            DB::rollBack();
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
