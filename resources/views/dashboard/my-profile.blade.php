@extends('layouts.dashboard')

@section('title', 'Profil Saya')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mt-4 mb-1">Profil Saya</h5>
            <p class="text-muted">Pastikan data Anda selalu diperbarui agar kami bisa melayani dengan lebih baik.</p>
            <hr>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="row">
                <!-- Kolom Kiri: Form Edit Data Profil -->
                <div class="col-md-8">
                    <form action="{{ route('profil.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Pengguna</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->username }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama</label>
                            <input type="text" class="form-control" name="nama" value="{{ $komunitas->nama ?? '' }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nomor Telepon</label>
                            <input type="text" class="form-control" name="no_telp" value="{{ $komunitas->no_telp ?? '' }}"
                                required>
                        </div>

                        @if($komunitas && $komunitas->pengajuanBankSampah)
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Bank Sampah</label>
                                <input type="text" class="form-control" name="bank_sampah"
                                    value="{{ $komunitas->pengajuanBankSampah->nama_bank_sampah }}" readonly>
                            </div>
                        @endif

                        <button type="submit" class="btn btn-danger mt-2">Simpan</button>
                    </form>
                </div>

                <!-- Kolom Kanan: Form Ubah Password -->
                <div class="col-md-4">
                    <div class="card border">
                        <div class="card-body">
                            <h6 class="fw-semibold mb-3">Ubah Password</h6>
                            <form action="{{ route('ubah-password') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="password_baru" class="form-label">Password Baru</label>
                                    <input type="password" class="form-control" name="password_baru" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password_baru_confirmation" class="form-label">Konfirmasi Password</label>
                                    <input type="password" class="form-control" name="password_baru_confirmation" required>
                                </div>
                                <button type="submit" class="btn btn-danger w-100">Simpan Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection