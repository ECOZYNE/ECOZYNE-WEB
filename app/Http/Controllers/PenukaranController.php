<?php

namespace App\Http\Controllers;

use App\Models\Point;
use App\Models\Hadiah;
use App\Models\Komunitas;
use App\Models\Penukaran;
use Illuminate\Http\Request;
use App\Models\transaksi_penukaran;
use Illuminate\Support\Facades\Auth;

class PenukaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
 public function tukar(Request $request)
{
    $request->validate([
        'id_hadiah' => 'required|exists:hadiah,id_hadiah',
        'jumlah' => 'required|integer|min:1',
    ]);

    $user = Auth::user();
    $komunitas = Komunitas::where('id_user', $user->id_user)->first();
    if (!$komunitas) {
        return back()->with('error', 'Anda belum tergabung dalam komunitas.');
    }

    $hadiah = Hadiah::find($request->id_hadiah);
    $jumlah = $request->jumlah;
    $totalPoint = $hadiah->point_satuan * $jumlah;

    // cek point komunitas
    $point = Point::where('id_komunitas', $komunitas->id_komunitas)->first();
    if (!$point || $point->point < $totalPoint) {
        return back()->with('error', 'Poin tidak mencukupi.');
    }

    if ($hadiah->stok < $jumlah) {
        return back()->with('error', 'Stok hadiah tidak mencukupi.');
    }

    // Buat entri penukaran
    Penukaran::create([
        'id_komunitas' => $komunitas->id_komunitas,
        'id_hadiah' => $hadiah->id_hadiah,
        'jumlah' => $jumlah,
        'status_penukaran' => 'dikonfirmasi', 'dikemas', 'dikirim', 'selesai', 'dibatalkan',
    ]);

    return back()->with('success', 'Permintaan penukaran dikirim dan menunggu persetujuan.');
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
    public function show(Penukaran $penukaran)
    {
        //
    }

public function updateStatus(Request $request, $id)
{
    $penukaran = Penukaran::findOrFail($id);
    $penukaran->status_penukaran = $request->status;
    $penukaran->save();

    if ($request->status === 'diterima') {
        $komunitas = $penukaran->komunitas;
        $hadiah = $penukaran->hadiah;
        $jumlah = $penukaran->jumlah;
        $totalPoint = $hadiah->point_satuan * $jumlah;

        // Kurangi stok hadiah
        $hadiah->stok -= $jumlah;
        $hadiah->save();

        // Kurangi point komunitas
        $point = Point::where('id_komunitas', $komunitas->id_komunitas)->first();
        $point->point -= $totalPoint;
        $point->save();

        // Buat entri transaksi_penukaran
        transaksi_penukaran::create([
            'id_penukaran' => $penukaran->id_penukaran,
            'id_hadiah' => $hadiah->id_hadiah,
            'jumlah' => $jumlah,
            'point_satuan' => $hadiah->point_satuan,
        ]);
    }

    return back()->with('success', 'Status penukaran diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penukaran $penukaran)
    {
        //
    }
}
