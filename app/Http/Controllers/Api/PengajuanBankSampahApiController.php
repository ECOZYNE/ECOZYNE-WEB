<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\PengajuanBankSampah;
use Exception;

class PengajuanBankSampahApiController extends Controller
{
    /**
     * Get pengajuan bank sampah for authenticated user's komunitas
     */
    public function index()
    {
        try {
            $user = Auth::user();

            if (!$user || !$user->komunitas) {
                return response()->json([
                    'success' => false,
                    'message' => 'Akun tidak memiliki komunitas'
                ], 404);
            }

            $id_komunitas = $user->komunitas->id_komunitas;

            $pengajuan = PengajuanBankSampah::where('id_komunitas', $id_komunitas)
                ->with('komunitas')
                ->latest()
                ->get();

            $lastPengajuan = $pengajuan->first();

            $canSubmitNewApplication = true;
            $rejectionNote = null;

            if ($lastPengajuan) {
                if (in_array($lastPengajuan->status, ['diproses', 'diterima'])) {
                    $canSubmitNewApplication = false;
                } elseif ($lastPengajuan->status === 'ditolak') {
                    $rejectionNote = $lastPengajuan->catatan;
                }
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'pengajuan' => $pengajuan,
                    'last_pengajuan' => $lastPengajuan,
                    'can_submit_new_application' => $canSubmitNewApplication,
                    'rejection_note' => $rejectionNote
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
     * Store a newly created pengajuan
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();

            if (!$user || !$user->komunitas) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Akun tidak memiliki komunitas'
                ], 404);
            }

            $lastPengajuan = PengajuanBankSampah::where('id_komunitas', $user->komunitas->id_komunitas)
                ->latest()
                ->first();

            if ($lastPengajuan && in_array($lastPengajuan->status, ['diproses', 'diterima'])) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Anda sudah memiliki pengajuan yang sedang diproses atau sudah diterima'
                ], 422);
            }

            $validator = validator($request->all(), [
                'nama_bank_sampah' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('pengajuan_bank_sampah')->where(function ($query) {
                        return $query->where('status', '!=', 'ditolak');
                    }),
                ],
                'file_dokumen' => 'required|mimes:pdf|max:15360',
                'lokasi_bank_sampah' => 'required|string',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Upload file
            $filePath = $request->file('file_dokumen')->store('dokumen_pengajuan', 'public');

            // Simpan data
            $pengajuan = PengajuanBankSampah::create([
                'id_komunitas'        => $user->komunitas->id_komunitas,
                'nama_bank_sampah'    => $request->nama_bank_sampah,
                'file_dokumen'        => $filePath,
                'lokasi_bank_sampah'  => $request->lokasi_bank_sampah,
                'latitude'            => $request->latitude,
                'longitude'           => $request->longitude,
                'catatan'             => null,
                'status'              => 'diproses',
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pengajuan berhasil dikirim',
                'data' => $pengajuan->load('komunitas')
            ], 201);
        } catch (Exception $e) {
            DB::rollBack();

            if (isset($filePath) && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified pengajuan
     */
    public function show($id)
    {
        try {
            $user = Auth::user();

            if (!$user || !$user->komunitas) {
                return response()->json([
                    'success' => false,
                    'message' => 'Akun tidak memiliki komunitas'
                ], 404);
            }

            $pengajuan = PengajuanBankSampah::where('id_komunitas', $user->komunitas->id_komunitas)
                ->where('id_pengajuan_bank_sampah', $id)
                ->with('komunitas')
                ->first();

            if (!$pengajuan) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pengajuan tidak ditemukan'
                ], 404);
            }

            // Generate full URL for file_dokumen
            if ($pengajuan->file_dokumen) {
                $pengajuan->file_dokumen_url = Storage::url($pengajuan->file_dokumen);
            }

            return response()->json([
                'success' => true,
                'data' => $pengajuan
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get status of latest pengajuan
     */
    public function status()
    {
        try {
            $user = Auth::user();

            if (!$user || !$user->komunitas) {
                return response()->json([
                    'success' => false,
                    'message' => 'Akun tidak memiliki komunitas'
                ], 404);
            }

            $lastPengajuan = PengajuanBankSampah::where('id_komunitas', $user->komunitas->id_komunitas)
                ->latest()
                ->first();

            if (!$lastPengajuan) {
                return response()->json([
                    'success' => true,
                    'data' => [
                        'has_pengajuan' => false,
                        'can_submit' => true,
                        'message' => 'Belum ada pengajuan'
                    ]
                ], 200);
            }

            $canSubmit = !in_array($lastPengajuan->status, ['diproses', 'diterima']);

            return response()->json([
                'success' => true,
                'data' => [
                    'has_pengajuan' => true,
                    'can_submit' => $canSubmit,
                    'status' => $lastPengajuan->status,
                    'catatan' => $lastPengajuan->catatan,
                    'pengajuan' => $lastPengajuan
                ]
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
