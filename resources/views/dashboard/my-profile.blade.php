@extends('layouts.dashboard')

@section('title', 'Pengajuan Bank Sampah')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mt-4 mb-1">Profil Saya</h5>
        <p class="text-muted">Pastikan data yang Anda masukkan selalu diperbarui agar kami bisa melayani Anda dengan lebih baik.</p>

        <hr>

        <!-- Formulir Pengajuan -->
        <form id="pengajuanForm" enctype="multipart/form-data">
            <div class="row">
                <!-- Form Data -->
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Pengguna</label>
                        <input type="text" class="form-control" value="nabil2203" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama</label>
                        <input type="text" class="form-control" name="nama" value="Nabil Aditya">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control" name="email" value="nabiladitya2203@gmail.com">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nomor Telepon</label>
                        <input type="text" class="form-control" name="no_telp" value="081270080123">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Bank Sampah</label>
                        <input type="text" class="form-control" name="nama_bank_sampah" id="nama_bank_sampah">
                    </div>

                    <button type="submit" class="btn btn-danger mt-4">Simpan</button>
                </div>

                <!-- Foto Profil -->
                <div class="col-md-4 text-center">
                    <img src="{{ asset('assets/images/profile/users.png') }}" alt="Foto Profil" class="rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                    <div class="mb-2">
                        <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('file_dokumen').click()">Pilih Gambar</button>
                    </div>
                    <p class="text-muted small">Ukuran gambar: maks. 15 MB<br>Format gambar: .JPG, .JPEG, .PNG</p>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('pengajuanForm').addEventListener('submit', function(e) {
        const namaBankSampah = document.getElementById('nama_bank_sampah').value.trim();
        const fileDokumen = document.getElementById('file_dokumen').files.length;

        if (namaBankSampah === '' || fileDokumen === 0) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Harap lengkapi form sebelum mengajukan.'
            });
        } else {
            e.preventDefault(); // hapus ini nanti kalau pakai backend
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Form berhasil disubmit (simulasi)'
            });
        }
    });
</script>
@endpush
