<?php

namespace App\Http\Controllers;

use App\Models\transaksi_penukaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TransaksiPenukaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index()
    {
        $transaksis = transaksi_penukaran::with(['penukaran.komunitas', 'hadiah'])->latest()->get();
        return view('admin.transaksi.index', compact('transaksis'));
    }

    // Untuk komunitas melihat histori penukaran mereka
    public function myTransactions()
    {
        $komunitasId = Auth::user()->komunitas->id_komunitas;
        $transaksis = transaksi_penukaran::whereHas('penukaran', function ($q) use ($komunitasId) {
            $q->where('id_komunitas', $komunitasId);
        })->with(['hadiah'])->latest()->get();

        return view('komunitas.transaksi.index', compact('transaksis'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(transaksi_penukaran $transaksi_penukaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(transaksi_penukaran $transaksi_penukaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, transaksi_penukaran $transaksi_penukaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(transaksi_penukaran $transaksi_penukaran)
    {
        //
    }
}
