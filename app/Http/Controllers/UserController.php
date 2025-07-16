<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Point;
use App\Models\Alamat;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Komunitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
   public function register(Request $request)
    {
        return $this->handleRegistration($request, 'public');
    }

    // Method untuk registrasi oleh admin
    public function registerByAdmin(Request $request)
    {
        // Pastikan yang akses adalah admin
        if (Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Unauthorized access!');
        }
        
        return $this->handleRegistration($request, 'admin');
    }

    // Method private untuk handle logic registrasi
    private function handleRegistration(Request $request, $type = 'public')
    {
        $validator = Validator::make($request->all(), [
            'username'  => 'required|string|max:255|unique:user,username',
            'email'     => 'required|email|unique:user,email',
            'no_telp'   => 'required|digits:12|unique:komunitas,no_telp',
            'nama'      => 'required|string|max:255',
            'alamat'    => 'required|string',
            'kelurahan' => 'required|exists:kelurahan,id_kelurahan',
            'kode_pos'  => 'required|digits:5',
            'password'  => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            // Create user
            $user = User::create([
                'username' => $request->username,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => 'komunitas',
            ]);

            // Create alamat
            $alamat = Alamat::create([
                'alamat'       => $request->alamat,
                'id_kelurahan' => $request->kelurahan,
                'kode_pos'     => $request->kode_pos,
            ]);

            // Generate avatar
            $initials = Str::lower(Str::substr(Str::slug($request->nama, ''), 0, 2));
            $avatarUrl = 'https://api.dicebear.com/9.x/initials/svg?seed=' . $initials;

            // Create komunitas
            $komunitas = Komunitas::create([
                'id_user'   => $user->id_user,
                'nama'      => $request->nama,
                'no_telp'   => $request->no_telp,
                'id_alamat' => $alamat->id_alamat,
                'foto'      => $avatarUrl,
            ]);

            // Create initial points
            Point::create([
                'id_komunitas'   => $komunitas->id_komunitas,
                'point'          => 0,
                'expired_point'  => now()->addYear(),
            ]);

            DB::commit();

            // Different success messages based on registration type
            $message = $type === 'admin' 
                ? 'Komunitas berhasil didaftarkan oleh admin!' 
                : 'Registrasi berhasil!';

            return redirect()->back()->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat registrasi: ' . $e->getMessage());
        }
    }

    public function getKelurahan($id_kecamatan)
    {
        $kelurahan = Kelurahan::where('id_kecamatan', $id_kecamatan)->get();
        return response()->json($kelurahan);
    }

    public function showRegisterForm()
    {
        $kecamatan = Kecamatan::all();
        return view('/register', compact('kecamatan'));
    }

    public function showAddKomunitasForm()
    {
        $kecamatan = Kecamatan::all();
        return view('/admin/add-komunitas', compact('kecamatan'));
    }

    // Menampilkan data komunitas untuk modal
    public function showKomunitas($id)
    {
        $komunitas = Komunitas::with(['user', 'alamat.kelurahan.kecamatan'])->find($id);

        if ($komunitas) {
            return response()->json([
                'id'         => $komunitas->id_komunitas,
                'nama'       => $komunitas->nama,
                'no_telp'    => $komunitas->no_telp,
                'alamat'     => $komunitas->alamat->alamat ?? '',
                'kode_pos'   => $komunitas->alamat->kode_pos ?? '',
                'kelurahan'  => $komunitas->alamat->kelurahan->kelurahan ?? '',
                'kecamatan'  => $komunitas->alamat->kelurahan->kecamatan->kecamatan ?? '',
                'email'      => $komunitas->user->email ?? '',
                'username'   => $komunitas->user->username ?? '',
            ]);
        }

        return response()->json(['error' => 'Komunitas tidak ditemukan'], 404);
    }

    public function updateKomunitas(Request $request, $id)
    {
        $request->validate([
            'nama'     => 'required',
            'no_telp'  => 'required',
            'username' => 'required',
            'email'    => 'required|email',
            'alamat'   => 'required',
            'kode_pos' => 'required',
        ]);

        $komunitas = Komunitas::with('user', 'alamat')->find($id);

        if (!$komunitas) {
            return response()->json(['error' => 'Komunitas tidak ditemukan'], 404);
        }

        $komunitas->update([
            'nama'     => $request->nama,
            'no_telp'  => $request->no_telp,
        ]);

        $komunitas->user->update([
            'username' => $request->username,
            'email'    => $request->email,
        ]);

        $komunitas->alamat->update([
            'alamat'   => $request->alamat,
            'kode_pos' => $request->kode_pos,
        ]);

        return response()->json(['success' => 'Data komunitas berhasil diperbarui']);
    }

 public function deleteKomunitas($id)
{
    DB::beginTransaction(); // Start a transaction for atomicity

    try {
        $komunitas = Komunitas::with([
            'user',
            'alamat',
            'point',
            'pendaftaranKegiatan', // Assuming you have this relation
            'pengajuanBankSampah', // Assuming you have this relation
            'penukaran',           // Assuming you have this relation
            'pesanan',             // Assuming you have this relation
            'transaksiSampah'      // Assuming you have this relation
        ])->find($id);

        if (!$komunitas) {
            DB::rollBack();
            return response()->json(['error' => 'Komunitas tidak ditemukan'], 404);
        }

        // 1. Delete records in tables that reference 'komunitas'
        // You need to define these relations in your Komunitas model
        if ($komunitas->pendaftaranKegiatan->count() > 0) {
            $komunitas->pendaftaranKegiatan()->delete();
        }
        if ($komunitas->pengajuanBankSampah->count() > 0) {
            $komunitas->pengajuanBankSampah()->delete();
        }
        if ($komunitas->penukaran->count() > 0) {
            // If penukaran has further children (like transaksi_penukaran),
            // you might need to delete those first or set up cascade on penukaran foreign keys.
            // Based on SQL, transaksi_penukaran HAS ON DELETE CASCADE to penukaran, so just deleting penukaran should work.
            $komunitas->penukaran()->delete();
        }
        if ($komunitas->pesanan->count() > 0) {
            // Similarly, if pesanan has children (like transaksi_produk), delete those first or set cascade.
            $komunitas->pesanan()->delete();
        }
        if ($komunitas->transaksiSampah->count() > 0) {
            $komunitas->transaksiSampah()->delete();
        }
        if ($komunitas->point) { // Point is a single record, not a collection
            $komunitas->point->delete();
        }

        $komunitas->delete();

        $komunitas->pendaftaranKegiatan()->delete();
        $komunitas->pengajuanBankSampah()->delete();
        $komunitas->penukaran()->delete();
        $komunitas->pesanan()->delete();
        $komunitas->transaksiSampah()->delete();
        if ($komunitas->point) {
            $komunitas->point->delete();
        }

        // Now delete Komunitas itself
        $komunitas->delete();
        if ($komunitas->alamat) {
            $komunitas->alamat->delete();
        }
        if ($komunitas->user) {
            $komunitas->user->delete();
        }

        DB::commit();
        return response()->json(['success' => 'Data komunitas berhasil dihapus']);

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Error deleting Komunitas: ' . $e->getMessage()); // Log the actual error
        return response()->json(['error' => 'Terjadi kesalahan saat menghapus komunitas.'], 500);
    }
}
    public function adminProfile()
    {
        $user = Auth::user();

        if ($user->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        return view('admin.my-profile', compact('user'));
    }

   public function updateAdminProfile(Request $request)
{
    /** @var \App\Models\User $user */
    $user = Auth::user();

    if ($user->role !== 'admin') {
        abort(403);
    }

    $request->validate([
        'username' => 'required|string|max:255',
        'email'    => 'required|email|max:255',
    ]);

    $user->update([
        'username' => $request->username,
        'email'    => $request->email,
    ]);

    return redirect()->route('admin.profile')->with('success', 'Profil berhasil diperbarui.');
}

public function updateAdminPassword(Request $request)
{
    /** @var \App\Models\User $user */
    $user = Auth::user();

    if ($user->role !== 'admin') {
        abort(403);
    }

    $request->validate([
        'password_baru' => 'required|min:6|confirmed',
    ]);

    $user->password = Hash::make($request->password_baru);
    $user->save();

    return redirect()->route('admin.profile')->with('success', 'Password berhasil diperbarui.');
}

public function showMyProfile()
{
    $user = Auth::user();
    
    // Load komunitas dengan relasi pengajuan_bank_sampah
    $komunitas = Komunitas::with('pengajuanBankSampah')
                         ->where('id_user', $user->id_user)
                         ->first();

    return view('dashboard.my-profile', compact('user', 'komunitas'));
}

   public function updateMyProfile(Request $request)
{
    $request->validate([
        'nama'     => 'required|string|max:255',
        'email'    => 'required|email|max:255',
        'no_telp'  => 'required|string|max:20',
    ]);

    /** @var \App\Models\User $user */
    $user = Auth::user();
    $komunitas = Komunitas::where('id_user', $user->id_user)->first();

    $user->update([
        'email' => $request->email,
    ]);


        if ($komunitas) {
            $komunitas->update([
                'nama'    => $request->nama,
                'no_telp' => $request->no_telp,
            ]);
        }

        return redirect()->route('profil.index')->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
{
    $request->validate([
        'password_baru' => 'required|min:6|confirmed',
    ]);

    $user = Auth::user();
    
    if (!$user instanceof \App\Models\User) {
        return redirect()->route('login')->with('error', 'Sesi login tidak valid.');
    }
    
    $user->password = Hash::make($request->password_baru);
    $user->save();

    return redirect()->route('profil.index')->with('success', 'Password berhasil diperbarui.');
}

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }

    public function data_pengguna()
    {
        $komunitas = Komunitas::whereHas('user', function ($query) {
            $query->where('role', 'komunitas');
        })->get();

        return view('/admin/index', compact('komunitas'));
    }

    public function data_komunitas()
    {
        $komunitas = Komunitas::whereHas('user', function ($query) {
            $query->where('role', 'komunitas');
        })->get();

        return view('/admin/view-komunitas', compact('komunitas'));
    }
}
