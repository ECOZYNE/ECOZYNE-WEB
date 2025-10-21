<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\JamOperasional;
use App\Models\PengajuanBankSampah;
use Carbon\Carbon;

class KelolaBankSampahController extends Controller
{
    /**
     * Menampilkan data Bank Sampah yang dikelola oleh user login.
     */
    public function index()
    {
        $user = Auth::user();
        $id_komunitas = $user->komunitas->id_komunitas ?? null;

        if (!$id_komunitas) {
            return redirect()->back()->with('error', 'Akun tidak memiliki komunitas.');
        }

        // Ambil pengajuan bank sampah yang sudah diterima
        $pengajuan = PengajuanBankSampah::where('id_komunitas', $id_komunitas)
            ->where('status', 'diterima')
            ->with(['bankSampah.jamOperasional'])
            ->first();

        if (!$pengajuan || !$pengajuan->bankSampah) {
            return redirect()->back()->with('error', 'Anda belum memiliki Bank Sampah yang disetujui.');
        }

        $bankSampah = $pengajuan->bankSampah;
        $jamOperasional = $bankSampah->jamOperasional->keyBy('hari');

        return view('dashboard.kelola-bank-sampah', compact('pengajuan', 'bankSampah', 'jamOperasional'));
    }

    /**
     * Memperbarui data Bank Sampah.
     */
    public function update(Request $request)
    {
        // 1️⃣ Validasi input utama
        $request->validate([
            'nama_bank_sampah'   => 'required|string|max:255',
            'file_dokumen'       => 'nullable|file|mimes:pdf|max:2048',
            'lokasi_bank_sampah' => 'required|string',
            'latitude'           => 'required|numeric',
            'longitude'          => 'required|numeric',
        ]);

        // 2️⃣ Ambil data komunitas dari user
        $user = Auth::user();
        $id_komunitas = $user->komunitas->id_komunitas ?? null;

        if (!$id_komunitas) {
            return back()->with('error', 'Gagal mengupdate: Akun tidak memiliki komunitas.');
        }

        // 3️⃣ Ambil pengajuan bank sampah yang sudah diterima
        $pengajuan = PengajuanBankSampah::where('id_komunitas', $id_komunitas)
            ->where('status', 'diterima')
            ->with(['bankSampah'])
            ->first();

        if (!$pengajuan || !$pengajuan->bankSampah) {
            return back()->with('error', 'Gagal mengupdate: Bank Sampah tidak ditemukan atau belum disetujui.');
        }

        try {
            // 4️⃣ Update kolom di tabel pengajuan_bank_sampah
            $pengajuan->nama_bank_sampah = $request->nama_bank_sampah;
            $pengajuan->lokasi_bank_sampah = $request->lokasi_bank_sampah;
            $pengajuan->latitude = $request->latitude;
            $pengajuan->longitude = $request->longitude;

            // 5️⃣ Upload file dokumen (optional)
            if ($request->hasFile('file_dokumen')) {
                if ($pengajuan->file_dokumen && Storage::disk('public')->exists($pengajuan->file_dokumen)) {
                    Storage::disk('public')->delete($pengajuan->file_dokumen);
                }

                $path = $request->file('file_dokumen')->store('dokumen_banksampah', 'public');
                $pengajuan->file_dokumen = $path;
            }

            $pengajuan->save();

            // 6️⃣ Update jam operasional di tabel relasi bank_sampah
            $bankSampah = $pengajuan->bankSampah;
            $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

            foreach ($hariList as $hari) {
                $isTutup = $request->input("is_tutup.$hari") == '1';
                $jamBuka = $request->input("jam_buka.$hari");
                $jamTutup = $request->input("jam_tutup.$hari");

                $jamOperasional = $bankSampah->jamOperasional()->firstOrNew(['hari' => $hari]);

                if ($isTutup) {
                    $jamOperasional->is_tutup = 1;
                    $jamOperasional->jam_buka = null;
                    $jamOperasional->jam_tutup = null;
                } else {
                    // Validasi jam buka & tutup
                    if ($jamBuka && $jamTutup) {
                        try {
                            // Terima kedua format (H:i atau H:i:s)
                            $t1 = Carbon::createFromFormat(strlen($jamBuka) === 5 ? 'H:i' : 'H:i:s', $jamBuka);
                            $t2 = Carbon::createFromFormat(strlen($jamTutup) === 5 ? 'H:i' : 'H:i:s', $jamTutup);

                            if ($t2->lessThanOrEqualTo($t1)) {
                                return back()
                                    ->with('error', "Jam tutup harus lebih besar dari jam buka untuk hari $hari.")
                                    ->withInput();
                            }

                            // Simpan ke DB dengan format konsisten
                            $jamOperasional->is_tutup = 0;
                            $jamOperasional->jam_buka = $t1->format('H:i:s');
                            $jamOperasional->jam_tutup = $t2->format('H:i:s');
                        } catch (\Exception $e) {
                            return back()
                                ->with('error', "Format jam tidak valid untuk hari $hari.")
                                ->withInput();
                        }
                    }

                    $jamOperasional->is_tutup = 0;
                    $jamOperasional->jam_buka = $jamBuka;
                    $jamOperasional->jam_tutup = $jamTutup;
                }

                $jamOperasional->save();
            }

            // 7️⃣ Redirect sukses
            return redirect()->route('kelola-bank-sampah.index')->with('success', 'Data Bank Sampah berhasil diperbarui! 🎉');
        } catch (\Exception $e) {
            // Log detail error
            Log::error('Update Bank Sampah Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => collect($request->except(['file_dokumen']))->toArray(),
            ]);

            return back()->with('error', 'Terjadi kesalahan saat memperbarui data. Silakan coba lagi.')->withInput();
        }
    }
}
