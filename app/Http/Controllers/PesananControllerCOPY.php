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

class PesananControllerCOPY extends Controller
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

    public function konfirmasiPesanan()
    {
        $user = Auth::user(); // ambil user yang sedang login

        // pastikan user punya relasi komunitas
        $komunitas = $user->komunitas;

        if (!$komunitas) {
            return redirect()->back()->with('error', 'Akun Anda tidak terdaftar sebagai komunitas.');
        }

        // ambil pengajuan bank sampah yang diterima
        $pengajuan = $komunitas->pengajuanBankSampah()->where('status', 'diterima')->first();

        // ambil bank sampah dari pengajuan
        $bankSampah = $pengajuan?->bank_sampah;

        // ambil id-nya
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

        // 1. Ensure the user is authenticated and is a community member
        if (!$user || !$user->komunitas) {
            return redirect()->back()->with('error', 'Akun Anda tidak terdaftar sebagai komunitas.');
        }

        // 2. Get the Bank Sampah ID managed by the logged-in community
        $bankSampah = $user->komunitas->pengajuanBankSampah()->where('status', 'diterima')->first()?->bank_sampah;

        if (!$bankSampah) {
            return redirect()->back()->with('error', 'Anda tidak mengelola bank sampah yang disetujui.');
        }

        $idBankSampah = $bankSampah->id_bank_sampah;

        // 3. Query orders where status is 'diterima' AND the order is for THIS bank sampah
        $pesananDiterima = Pesanan::with(['transaksiProduk.produk', 'komunitas.user']) // Eager load user for username
            ->where('id_bank_sampah', $idBankSampah) // Filter by the bank sampah ID
            ->where('status_pesanan', 'diterima') // Filter by 'diterima' status
            ->latest() // Order by latest orders
            ->get();

        return view('dashboard.view-pesanan-produk', compact('pesananDiterima'));
    }


    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diterima,ditolak'
        ]);

        $newStatus = $request->status;
        $user = Auth::user();

        // Verifikasi bahwa user adalah pemilik bank sampah yang sah
        if (!$user || !$user->komunitas) {
            return redirect()->back()->with('error', 'Akses ditolak. Anda bukan komunitas.');
        }

        $bankSampah = $user->komunitas->pengajuanBankSampah()->where('status', 'diterima')->first()?->bank_sampah;

        if (!$bankSampah) {
            return redirect()->back()->with('error', 'Akses ditolak. Anda tidak mengelola bank sampah.');
        }

        DB::beginTransaction(); // Mulai transaksi

        try {
            // Cari pesanan yang ditujukan untuk bank sampah milik user yang sedang login
            $pesanan = Pesanan::with('transaksiProduk')
                ->where('id_pesanan', $id)
                ->where('id_bank_sampah', $bankSampah->id_bank_sampah)
                ->lockForUpdate() // Kunci row untuk mencegah race condition
                ->first();

            if (!$pesanan) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Pesanan tidak ditemukan atau bukan milik Anda.');
            }

            // Jika status sudah bukan 'menunggu', jangan proses lagi
            if ($pesanan->status_pesanan !== 'menunggu') {
                DB::rollBack();
                return redirect()->back()->with('error', 'Status pesanan ini sudah diubah sebelumnya.');
            }

            // LOGIKA UTAMA: Jika pesanan ditolak, kembalikan stok produk
            if ($newStatus === 'ditolak') {
                foreach ($pesanan->transaksiProduk as $transaksi) {
                    // Gunakan increment untuk operasi yang aman
                    Produk::where('id_produk', $transaksi->id_produk)->increment('stok', $transaksi->jumlah);
                }
            }

            // Update status pesanan
            $pesanan->status_pesanan = $newStatus;
            $pesanan->save();

            DB::commit(); // Selesaikan transaksi jika semua berhasil

            $message = $newStatus === 'diterima'
                ? 'Pesanan berhasil diterima!'
                : 'Pesanan berhasil ditolak dan stok produk telah dikembalikan!';

            return redirect()->back()->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua perubahan jika terjadi error
            Log::error('Gagal update status pesanan: ' . $e->getMessage()); // Catat error
            return redirect()->back()->with('error', 'Terjadi kesalahan pada sistem. Silakan coba lagi.');
        }
    }

   public function updateOrderStatus(Request $request, $id)
    {
        // Log request data for debugging
        Log::info("Incoming updateOrderStatus request for ID: {$id}", $request->all());

        try {
            // Validate the request data
            $request->validate([
                'status' => 'required|in:dikemas,dikirim,selesai'
            ]);

            $newStatus = $request->status;
            $user = Auth::user();

            // 1. Authorization check: Is the user logged in and a community?
            if (!$user || !$user->komunitas) {
                Log::warning("Unauthorized attempt to update order status. User not a community.", ['user_id' => $user->id ?? 'guest']);
                return response()->json([
                    'success' => false,
                    'message' => 'Akses ditolak. Anda bukan komunitas.',
                    'sweet_alert' => [
                        'type' => 'error',
                        'title' => 'Akses Ditolak!',
                        'message' => 'Anda harus login sebagai komunitas untuk memperbarui status pesanan.',
                        'toast' => true,
                    ]
                ], 403);
            }

            // 2. Authorization check: Does the user manage an approved bank sampah?
            $bankSampah = $user->komunitas->pengajuanBankSampah()->where('status', 'diterima')->first()?->bank_sampah;

            if (!$bankSampah) {
                Log::warning("Unauthorized attempt to update order status. User does not manage an approved bank sampah.", ['user_id' => $user->id]);
                return response()->json([
                    'success' => false,
                    'message' => 'Akses ditolak. Anda tidak mengelola bank sampah yang disetujui.',
                    'sweet_alert' => [
                        'type' => 'error',
                        'title' => 'Akses Ditolak!',
                        'message' => 'Anda tidak mengelola bank sampah yang disetujui.',
                        'toast' => true,
                    ]
                ], 403);
            }

            DB::beginTransaction();

            // 3. Find the order with locking and verify ownership
            $pesanan = Pesanan::where('id_pesanan', $id)
                ->where('id_bank_sampah', $bankSampah->id_bank_sampah)
                ->lockForUpdate() // Lock the row to prevent race conditions during update
                ->first();

            if (!$pesanan) {
                DB::rollBack();
                Log::warning("Order not found or not owned by the bank sampah for ID: {$id}", ['bank_sampah_id' => $bankSampah->id_bank_sampah]);
                return response()->json([
                    'success' => false,
                    'message' => 'Pesanan tidak ditemukan atau bukan milik Anda.',
                    'sweet_alert' => [
                        'type' => 'error',
                        'title' => 'Gagal!',
                        'message' => 'Pesanan tidak ditemukan atau Anda tidak memiliki izin untuk mengubahnya.',
                        'toast' => true,
                    ]
                ], 404);
            }

            Log::info("Pesanan found. Current status: {$pesanan->status_pesanan}, New status requested: {$newStatus}", ['pesanan_id' => $id]);

            // 4. Validate correct status transition
            $statusFlow = [
                'diterima' => 'dikemas',
                'dikemas' => 'dikirim',
                'dikirim' => 'selesai'
            ];

            // Check if the requested new status is a valid next step from the current status
            if (!isset($statusFlow[$pesanan->status_pesanan]) || $statusFlow[$pesanan->status_pesanan] !== $newStatus) {
                DB::rollBack();
                $errorMessage = 'Status pesanan tidak dapat diubah ke ' . $newStatus . ' dari status saat ini: ' . $pesanan->status_pesanan . '. Pastikan Anda mengikuti alur status yang benar.';
                Log::warning($errorMessage, ['pesanan_id' => $id, 'current_status' => $pesanan->status_pesanan, 'requested_status' => $newStatus]);
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage,
                    'sweet_alert' => [
                        'type' => 'warning',
                        'title' => 'Alur Status Salah!',
                        'message' => $errorMessage,
                        'toast' => true,
                    ]
                ], 400);
            }

            // 5. Update the order status
            $pesanan->status_pesanan = $newStatus;
            $pesanan->save();

            DB::commit(); // Commit the transaction

            $statusMessages = [
                'dikemas' => 'Pesanan berhasil diubah ke status Dikemas!',
                'dikirim' => 'Pesanan berhasil diubah ke status Dikirim!',
                'selesai' => 'Pesanan berhasil diselesaikan!'
            ];

            Log::info("Order status updated successfully for ID: {$id}. New status: {$newStatus}");

            return response()->json([
                'success' => true,
                'message' => $statusMessages[$newStatus] ?? 'Status pesanan berhasil diupdate!',
                'new_status' => $newStatus,
                'sweet_alert' => [
                    'type' => 'success',
                    'title' => 'Berhasil!',
                    'message' => $statusMessages[$newStatus] ?? 'Status pesanan berhasil diupdate!',
                    'toast' => true,
                ]
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors specifically
            Log::error('Validation error in updateOrderStatus: ' . $e->getMessage(), ['errors' => $e->errors()]);
            return response()->json([
                'success' => false,
                'message' => 'Data yang dikirim tidak valid.',
                'errors' => $e->errors(),
                'sweet_alert' => [
                    'type' => 'error',
                    'title' => 'Validasi Gagal!',
                    'message' => 'Pastikan Anda memilih status yang valid.',
                    'toast' => true,
                ]
            ], 422); // Unprocessable Entity
        } catch (\Exception $e) {
            DB::rollBack(); // Ensure rollback on any other exception
            Log::error('Failed to update order status for ID: ' . $id . '. Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all(),
                'user_id' => Auth::id()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem. Silakan coba lagi. (ERR: ' . substr($e->getMessage(), 0, 50) . '...)', // Show a snippet of error for user awareness
                'sweet_alert' => [
                    'type' => 'error',
                    'title' => 'Gagal!',
                    'message' => 'Terjadi kesalahan internal pada sistem. Mohon coba lagi nanti atau hubungi administrator.',
                    'toast' => true,
                ]
            ], 500); // Internal Server Error
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
}