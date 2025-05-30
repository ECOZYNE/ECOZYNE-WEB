<?php

namespace App\Http\Controllers;

use App\Models\hadiah;
use Illuminate\Http\Request;

class HadiahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hadiahList = Hadiah::all();
        return view('admin.view-hadiah', compact('hadiahList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $validated = $request->validate([
        'nama_hadiah' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'stok' => 'required|integer|min:0',
        'poin_satuan' => 'required|integer|min:0',
    ]);

    $path = null;
    if ($request->hasFile('foto')) {
        $foto = $request->file('foto');
        $filename = time() . '_' . $foto->getClientOriginalName();
        $path = $foto->storeAs('hadiah', $filename, 'public');
    }

    hadiah::create([
        'nama_hadiah' => $validated['nama_hadiah'],
        'deskripsi' => $validated['deskripsi'],
        'foto' => $path,
        'stok' => $validated['stok'],
        'point_satuan' => $validated['poin_satuan'],
    ]);

    return redirect()->back()->with('success', 'Hadiah berhasil ditambahkan!');
}


    /**
     * Display the specified resource.
     */
    public function show(hadiah $hadiah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(hadiah $hadiah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, hadiah $hadiah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(hadiah $hadiah)
    {
        //
    }
}
