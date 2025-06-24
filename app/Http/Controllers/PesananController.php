<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\transaksi_produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon; // Import Carbon untuk formatting tanggal

class PesananController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        if (!$user || !$user->komunitas) {
            return redirect()->back()->with('error', 'Akun Anda tidak terdaftar sebagai komunitas.');
        }

        $pesanan = Pesanan::with(['transaksiProduk.produk', 'bankSampah'])
            ->where('id_komunitas', $user->komunitas->id_komunitas)
            ->latest()
            ->get();

        // Kirim variabel $pesanan ke blade
        return view('dashboard.my-pesanan-produk', compact('pesanan'));
    }


    /**
     * Store a newly created resource in storage (Handle Product Purchase).
     */
    public function storePurchase(Request $request)
    {
        // Remove dd() for production - only for debugging
        // dd($request->all());

        // 1. Validate the request
        $request->validate([
            'product_id' => 'required|exists:produk,id_produk',
            'quantity' => 'required|integer|min:1',
        ]);

        $userId = Auth::id();
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        DB::beginTransaction();

        try {
            // Find the product with locking to prevent race conditions
            $product = Produk::with('bankSampah.pengajuanBankSampah.komunitas')->lockForUpdate()->find($productId);

            if (!$product) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Produk tidak ditemukan.',
                    'sweet_alert' => [
                        'type' => 'error',
                        'title' => 'Gagal!',
                        'message' => 'Produk tidak ditemukan.',
                        'toast' => true,
                    ]
                ], 404);
            }

            // Get the Komunitas model for the authenticated user
            $komunitasPembeli = Auth::user()->komunitas;

            if (!$komunitasPembeli) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Akun Anda tidak terdaftar sebagai komunitas pembeli.',
                    'sweet_alert' => [
                        'type' => 'error',
                        'title' => 'Akses Ditolak!',
                        'message' => 'Anda harus login sebagai komunitas untuk melakukan pemesanan produk.',
                        'toast' => true,
                    ]
                ], 403);
            }

            // NEW VALIDATION: Check if buyer is trying to purchase from their own bank sampah
            $bankSampahPemilik = $product->bankSampah->pengajuanBankSampah->komunitas ?? null;

            if ($bankSampahPemilik && $bankSampahPemilik->id_komunitas === $komunitasPembeli->id_komunitas) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak dapat membeli produk dari bank sampah yang Anda kelola sendiri.',
                    'sweet_alert' => [
                        'type' => 'warning',
                        'title' => 'Pembelian Tidak Diizinkan!',
                        'message' => 'Anda tidak dapat membeli produk dari bank sampah yang Anda kelola sendiri.',
                        'toast' => true,
                    ]
                ], 403);
            }

            // Check if stock is available
            if ($product->stok < $quantity) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Stok produk tidak mencukupi. Sisa stok: ' . $product->stok,
                    'sweet_alert' => [
                        'type' => 'warning',
                        'title' => 'Stok Tidak Cukup!',
                        'message' => 'Jumlah yang Anda pesan melebihi stok yang tersedia. Sisa stok: ' . $product->stok,
                        'toast' => true,
                    ]
                ], 400);
            }

            // Check if stock is 0 (redundant with previous check but good for explicit message)
            if ($product->stok == 0) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Produk sudah habis (stok = 0).',
                    'sweet_alert' => [
                        'type' => 'error',
                        'title' => 'Stok Habis!',
                        'message' => 'Maaf, produk ini sudah habis stoknya.',
                        'toast' => true,
                    ]
                ], 400);
            }

            // Calculate total price for this item (for record keeping)
            $totalHargaProduk = $product->harga * $quantity;

            // Create a new order (Pesanan) - COD System
            $pesanan = Pesanan::create([
                'id_komunitas' => $komunitasPembeli->id_komunitas,
                'id_bank_sampah' => $product->id_bank_sampah,
                'status_pesanan' => 'menunggu',
                'status_pembayaran' => 0, // Set to 0 for COD (Cash on Delivery)
            ]);

            // Save the product details in the pivot table (transaksi_produk)
            // Harga disimpan sebagai total harga (harga satuan × quantity)
            $totalHargaItem = $product->harga * $quantity;

            transaksi_produk::create([
                'id_pesanan' => $pesanan->id_pesanan,
                'id_produk' => $productId,
                'jumlah' => $quantity,
                'harga' => $totalHargaItem, // Simpan total harga, bukan harga satuan
            ]);

            // Deduct stock from the product
            $product->stok -= $quantity;
            $product->save();

            // No need to deduct balance for COD system

            DB::commit(); // Commit the transaction

            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil dibuat! Pembayaran akan dilakukan saat pengambilan (COD).',
                'data' => [
                    'id_pesanan' => $pesanan->id_pesanan,
                    'total_harga' => $totalHargaProduk,
                    'sisa_stok' => $product->stok,
                    'metode_pembayaran' => 'COD (Cash on Delivery)'
                ],
                'sweet_alert' => [
                    'type' => 'success',
                    'title' => 'Berhasil!',
                    'message' => 'Pesanan Anda telah berhasil dibuat. Silakan tunggu konfirmasi dari Bank Sampah.',
                    'toast' => true,
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback on error

            // Log the error for debugging purposes
            Log::error('Purchase failed: ' . $e->getMessage(), [
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem. Silakan coba lagi.',
                'sweet_alert' => [
                    'type' => 'error',
                    'title' => 'Gagal!',
                    'message' => 'Terjadi kesalahan pada sistem. Mohon coba lagi nanti.',
                    'toast' => true,
                ]
            ], 500);
        }
    }

    // Method untuk halaman konfirmasi pesanan (menangani status menunggu -> diterima/ditolak)
    public function konfirmasiPesanan()
    {
        $user = Auth::user();
        
        if (!$user || !$user->komunitas) {
            return redirect()->back()->with('error', 'Akun Anda tidak terdaftar sebagai komunitas.');
        }

        $komunitas = $user->komunitas;
        $pengajuan = $komunitas->pengajuanBankSampah()->where('status', 'diterima')->first();
        $bankSampah = $pengajuan?->bank_sampah;
        $idBankSampah = $bankSampah?->id_bank_sampah;

        $pesanan = [];

        if ($idBankSampah) {
            $pesanan = Pesanan::where('status_pesanan', 'menunggu')
                ->where('id_bank_sampah', $idBankSampah)
                ->with([
                    'komunitas',
                    'transaksiProduk.produk' => function ($q) use ($idBankSampah) {
                        $q->where('id_bank_sampah', $idBankSampah);
                    }
                ])
                ->get();
        }

        return view('dashboard.konfirmasi-pesanan-produk', compact('pesanan'));
    }

    /**
     * Display accepted orders for the logged-in Bank Sampah.
     * This method will display orders that have been accepted by this bank sampah.
     */
     public function viewAcceptedOrders()
    {
        $user = Auth::user();

        if (!$user || !$user->komunitas) {
            return redirect()->back()->with('error', 'Akun Anda tidak terdaftar sebagai komunitas.');
        }

        $bankSampah = $user->komunitas->pengajuanBankSampah()->where('status', 'diterima')->first()?->bank_sampah;

        if (!$bankSampah) {
            return redirect()->back()->with('error', 'Anda tidak mengelola bank sampah yang disetujui.');
        }

        $idBankSampah = $bankSampah->id_bank_sampah;

        $pesananDiterima = Pesanan::with(['transaksiProduk.produk', 'komunitas.user'])
            ->where('id_bank_sampah', $idBankSampah)
            ->whereIn('status_pesanan', ['diterima', 'dikemas', 'dikirim', 'selesai'])
            ->latest()
            ->get();

        return view('dashboard.view-pesanan-produk', compact('pesananDiterima'));
    }

      public function updateStatusKonfirmasi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diterima,ditolak'
        ]);

        $newStatus = $request->status;
        $user = Auth::user();

        if (!$user || !$user->komunitas) {
            return redirect()->back()->with('error', 'Akses ditolak. Anda bukan komunitas.');
        }

        $bankSampah = $user->komunitas->pengajuanBankSampah()->where('status', 'diterima')->first()?->bank_sampah;

        if (!$bankSampah) {
            return redirect()->back()->with('error', 'Akses ditolak. Anda tidak mengelola bank sampah.');
        }

        DB::beginTransaction();

        try {
            $pesanan = Pesanan::with('transaksiProduk')
                ->where('id_pesanan', $id)
                ->where('id_bank_sampah', $bankSampah->id_bank_sampah)
                ->where('status_pesanan', 'menunggu') // Hanya bisa dari status menunggu
                ->lockForUpdate()
                ->first();

            if (!$pesanan) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Pesanan tidak ditemukan atau sudah diproses sebelumnya.');
            }

            // Jika pesanan ditolak, kembalikan stok produk
            if ($newStatus === 'ditolak') {
                foreach ($pesanan->transaksiProduk as $transaksi) {
                    Produk::where('id_produk', $transaksi->id_produk)->increment('stok', $transaksi->jumlah);
                }
            }

            // Update status pesanan
            $pesanan->status_pesanan = $newStatus;
            $pesanan->save();

            DB::commit();

            $message = $newStatus === 'diterima' 
                ? 'Pesanan berhasil diterima!' 
                : 'Pesanan berhasil ditolak dan stok produk telah dikembalikan!';

            return redirect()->back()->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal update status konfirmasi pesanan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem. Silakan coba lagi.');
        }
    }


    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:dikemas,dikirim,selesai'
        ]);

        $newStatus = $request->status;
        $user = Auth::user();

        if (!$user || !$user->komunitas) {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak. Anda bukan komunitas.',
                'sweet_alert' => [
                    'type' => 'error',
                    'title' => 'Akses Ditolak!',
                    'message' => 'Anda harus login sebagai komunitas untuk melakukan tindakan ini.',
                    'toast' => true,
                ]
            ], 403);
        }

        $bankSampah = $user->komunitas->pengajuanBankSampah()->where('status', 'diterima')->first()?->bank_sampah;

        if (!$bankSampah) {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak. Anda tidak mengelola bank sampah.',
                'sweet_alert' => [
                    'type' => 'error',
                    'title' => 'Akses Ditolak!',
                    'message' => 'Anda tidak mengelola bank sampah yang disetujui.',
                    'toast' => true,
                ]
            ], 403);
        }

        DB::beginTransaction();

        try {
            $pesanan = Pesanan::where('id_pesanan', $id)
                ->where('id_bank_sampah', $bankSampah->id_bank_sampah)
                ->whereIn('status_pesanan', ['diterima', 'dikemas', 'dikirim']) // Hanya status yang bisa diupdate
                ->lockForUpdate()
                ->first();

            if (!$pesanan) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Pesanan tidak ditemukan atau tidak dapat diupdate.',
                    'sweet_alert' => [
                        'type' => 'error',
                        'title' => 'Gagal!',
                        'message' => 'Pesanan tidak ditemukan atau sudah selesai.',
                        'toast' => true,
                    ]
                ], 404);
            }

            // Validasi flow status
            $allowedTransitions = [
                'diterima' => ['dikemas'],
                'dikemas' => ['dikirim'],
                'dikirim' => ['selesai']
            ];

            if (!in_array($newStatus, $allowedTransitions[$pesanan->status_pesanan] ?? [])) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Transisi status tidak valid.',
                    'sweet_alert' => [
                        'type' => 'error',
                        'title' => 'Gagal!',
                        'message' => 'Tidak dapat mengubah status dari ' . $pesanan->status_pesanan . ' ke ' . $newStatus,
                        'toast' => true,
                    ]
                ], 400);
            }

            // Update status pesanan
            $pesanan->status_pesanan = $newStatus;

            // Jika status menjadi selesai, update status pembayaran menjadi 1 (lunas)
            if ($newStatus === 'selesai') {
                $pesanan->status_pembayaran = 1;
            }

            $pesanan->save();

            DB::commit();

            $statusLabels = [
                'dikemas' => 'Dikemas',
                'dikirim' => 'Dikirim',
                'selesai' => 'Selesai'
            ];

            $message = 'Status pesanan berhasil diperbarui menjadi ' . $statusLabels[$newStatus] . '.';
            
            if ($newStatus === 'selesai') {
                $message .= ' Pembayaran telah ditandai sebagai lunas.';
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'sweet_alert' => [
                    'type' => 'success',
                    'title' => 'Berhasil!',
                    'message' => $message,
                    'toast' => true,
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal update status pesanan: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem. Silakan coba lagi.',
                'sweet_alert' => [
                    'type' => 'error',
                    'title' => 'Gagal!',
                    'message' => 'Terjadi kesalahan pada sistem. Mohon coba lagi nanti.',
                    'toast' => true,
                ]
            ], 500);
        }
    }



    /**
     * Cancel a user's product order and return stock.
     */
    public function batalkan(Request $request, $id)
    {
        $user = Auth::user();

        // Ensure the user is authenticated and is a community member
        if (!$user || !$user->komunitas) {
            return redirect()->back()->with('error', 'Anda harus login sebagai komunitas untuk membatalkan pesanan.');
        }

        DB::beginTransaction();

        try {
            // Find the order, ensuring it belongs to the authenticated user's community
            $pesanan = Pesanan::with('transaksiProduk.produk')
                ->where('id_pesanan', $id)
                ->where('id_komunitas', $user->komunitas->id_komunitas)
                ->lockForUpdate() // Lock the row to prevent race conditions
                ->first();

            if (!$pesanan) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Pesanan tidak ditemukan atau Anda tidak memiliki izin untuk membatalkannya.');
            }

            // Only allow cancellation if the order is still "menunggu" (pending)
            if ($pesanan->status_pesanan !== 'menunggu') {
                DB::rollBack();
                return redirect()->back()->with('error', 'Pesanan ini tidak dapat dibatalkan karena statusnya sudah tidak menunggu.');
            }

            // Return stock for each product in the order
            foreach ($pesanan->transaksiProduk as $transaksi) {
                // Increment product stock
                Produk::where('id_produk', $transaksi->id_produk)->increment('stok', $transaksi->jumlah);
            }

            // Update order status to 'dibatalkan'
            $pesanan->status_pesanan = 'dibatalkan';
            $pesanan->save();

            DB::commit();

            return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan dan stok produk telah dikembalikan.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal membatalkan pesanan: ' . $e->getMessage(), [
                'pesanan_id' => $id,
                'user_id' => $user->id,
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membatalkan pesanan. Silakan coba lagi.');
        }
    }

       public function viewCompletedOrders()
    {
        $user = Auth::user();

        // Ensure the user is authenticated and is a community member
        if (!$user || !$user->komunitas) {
            return redirect()->back()->with('error', 'Akun Anda tidak terdaftar sebagai komunitas.');
        }

        // Retrieve completed orders for the authenticated community
        $pesananSelesai = Pesanan::with(['transaksiProduk.produk', 'bankSampah'])
            ->where('id_komunitas', $user->komunitas->id_komunitas)
            ->where('status_pesanan', 'selesai')
            ->latest()
            ->get();

        // Pass the completed orders to the view
        return view('dashboard.my-riwayat-pesanan-produk', compact('pesananSelesai'));
    }

    public function viewBankSampahCompletedOrders()
{
    $user = Auth::user();

    // Ensure the user is authenticated and is a community member
    if (!$user || !$user->komunitas) {
        return redirect()->back()->with('error', 'Akun Anda tidak terdaftar sebagai komunitas.');
    }

    // Get the Bank Sampah managed by the authenticated user's community
    $bankSampah = $user->komunitas->pengajuanBankSampah()->where('status', 'diterima')->first()?->bank_sampah;

    if (!$bankSampah) {
        return redirect()->back()->with('error', 'Anda tidak mengelola bank sampah yang disetujui.');
    }

    $idBankSampah = $bankSampah->id_bank_sampah;

    // Retrieve completed orders for this specific Bank Sampah
    $pesananSelesaiBankSampah = Pesanan::with(['transaksiProduk.produk', 'komunitas.user'])
        ->where('id_bank_sampah', $idBankSampah)
        ->where('status_pesanan', 'selesai')
        ->latest()
        ->get();

    // Pass the completed orders to the existing 'riwayat-pesanan-produk' view
    return view('dashboard.riwayat-pesanan-produk', compact('pesananSelesaiBankSampah'));
}
}