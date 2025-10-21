<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BankSampah;
use Illuminate\Http\Request;
use Exception;

class BankSampahApiController extends Controller
{
    /**
     * Display a listing of all bank sampah
     */
    public function index(Request $request)
    {
        try {
            $query = BankSampah::with(['komunitas', 'pengajuanBankSampah']);

            // Filter by status if provided
            if ($request->has('status')) {
                $query->whereHas('pengajuanBankSampah', function ($q) use ($request) {
                    $q->where('status', $request->status);
                });
            }

            // Search by name
            if ($request->has('search')) {
                $query->where('nama_bank_sampah', 'like', '%' . $request->search . '%');
            }

            // Filter by location (within radius)
            if ($request->has('latitude') && $request->has('longitude') && $request->has('radius')) {
                $lat = $request->latitude;
                $lng = $request->longitude;
                $radius = $request->radius; // in kilometers

                $query->selectRaw("
                    *,
                    ( 6371 * acos( cos( radians(?) ) * 
                    cos( radians( latitude ) ) * 
                    cos( radians( longitude ) - radians(?) ) + 
                    sin( radians(?) ) * 
                    sin( radians( latitude ) ) ) ) AS distance
                ", [$lat, $lng, $lat])
                    ->having('distance', '<', $radius)
                    ->orderBy('distance');
            }

            // Pagination
            $perPage = $request->get('per_page', 10);
            $bankSampah = $query->paginate($perPage);

            return response()->json([
                'success' => true,
                'data' => $bankSampah
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified bank sampah
     */
    public function show($id)
    {
        try {
            $bankSampah = BankSampah::with(['komunitas', 'pengajuanBankSampah', 'produk'])
                ->find($id);

            if (!$bankSampah) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bank sampah tidak ditemukan'
                ], 404);
            }

            // Calculate distance if lat/lng provided
            if (request()->has('latitude') && request()->has('longitude')) {
                $lat = request()->latitude;
                $lng = request()->longitude;

                $distance = $this->calculateDistance(
                    $lat,
                    $lng,
                    $bankSampah->latitude,
                    $bankSampah->longitude
                );

                $bankSampah->distance = round($distance, 2);
            }

            return response()->json([
                'success' => true,
                'data' => $bankSampah
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get nearest bank sampah
     */
    public function nearest(Request $request)
    {
        try {
            $validator = validator($request->all(), [
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'limit' => 'nullable|integer|min:1|max:50'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $lat = $request->latitude;
            $lng = $request->longitude;
            $limit = $request->get('limit', 5);

            $bankSampah = BankSampah::with(['komunitas', 'pengajuanBankSampah'])
                ->selectRaw("
                    *,
                    ( 6371 * acos( cos( radians(?) ) * 
                    cos( radians( latitude ) ) * 
                    cos( radians( longitude ) - radians(?) ) + 
                    sin( radians(?) ) * 
                    sin( radians( latitude ) ) ) ) AS distance
                ", [$lat, $lng, $lat])
                ->orderBy('distance')
                ->limit($limit)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $bankSampah
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get bank sampah with products
     */
    public function withProducts($id)
    {
        try {
            $bankSampah = BankSampah::with(['komunitas', 'produk' => function ($query) {
                $query->where('stok', '>', 0)->orderBy('created_at', 'desc');
            }])->find($id);

            if (!$bankSampah) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bank sampah tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $bankSampah
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get statistics for specific bank sampah
     */
    public function statistics($id)
    {
        try {
            $bankSampah = BankSampah::find($id);

            if (!$bankSampah) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bank sampah tidak ditemukan'
                ], 404);
            }

            $totalProduk = $bankSampah->produk()->count();
            $totalStok = $bankSampah->produk()->sum('stok');
            $totalTransaksi = $bankSampah->transaksiSampah()->count();
            $totalBeratSampah = $bankSampah->transaksiSampah()->sum('berat');

            return response()->json([
                'success' => true,
                'data' => [
                    'bank_sampah' => $bankSampah,
                    'statistics' => [
                        'total_produk' => $totalProduk,
                        'total_stok' => $totalStok,
                        'total_transaksi' => $totalTransaksi,
                        'total_berat_sampah' => $totalBeratSampah
                    ]
                ]
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Calculate distance between two coordinates using Haversine formula
     */
    private function calculateDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371; // Radius bumi dalam kilometer

        $latDiff = deg2rad($lat2 - $lat1);
        $lngDiff = deg2rad($lng2 - $lng1);

        $a = sin($latDiff / 2) * sin($latDiff / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($lngDiff / 2) * sin($lngDiff / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;

        return $distance;
    }
}
