@extends('layouts.dashboard')

@section('title', 'Tambah Arikel')

@section('content')
  <div class="card">
    <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Tambah Kegiatan</h5>
    @if (session('success'))
    <script>
      Swal.fire({
      icon: 'success',
      title: 'Sukses!',
      text: '{{ session('success') }}',
      showConfirmButton: true
      });
    </script>
    @endif

    @if (session('error'))
    <script>
      Swal.fire({
      icon: 'error',
      title: 'Gagal!',
      text: '{{ session('error') }}',
      showConfirmButton: true
      });
    </script>
    @endif

    <hr>
    <!-- Formulir tambah kegiatan -->
    <form method="POST" action="{{ route('kegiatan.post') }}" enctype="multipart/form-data">
      @csrf
      <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 mb-3">
        <label for="judul" class="form-label">
          Judul Kegiatan <span class="text-danger">*</span>
        </label>
        <input type="text" class="form-control" name="judul" id="judul" placeholder="Masukkan Judul Kegiatan"
          required>
        </div>

        <div class="col-md-6 mb-3">
        <label for="foto" class="form-label">
          Foto Kegiatan <span class="text-danger">*</span>
        </label>
        <input type="file" class="form-control" name="foto" id="foto" accept=".jpg,.jpeg,.png" required>
        </div>

        <div class="col-md-12 mb-3">
        <label for="isi" class="form-label">
          Deskripsi Kegiatan <span class="text-danger">*</span>
        </label>
        <textarea class="form-control" name="isi" id="isi" rows="6" placeholder="Masukkan Isi Kegiatan"
          required></textarea>
        </div>

        <div class="col-md-4 mb-3">
        <label for="lokasi" class="form-label">
          Lokasi Kegiatan <span class="text-danger">*</span>
        </label>
        <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Masukkan Lokasi Kegiatan"
          required>
        </div>

        <div class="col-md-4 mb-3">
        <label for="kouta" class="form-label">
          Kouta Peserta <span class="text-danger">*</span>
        </label>
        <input type="number" class="form-control" name="kouta" id="kouta" placeholder="Masukkan Kouta Peserta"
          required>
        </div>

        <div class="col-md-4 mb-3">
        <label for="tanggal_kegiatan" class="form-label">
          Tanggal Kegiatan <span class="text-danger">*</span>
        </label>
        <input type="datetime-local" class="form-control" name="tanggal_kegiatan" id="tanggal_kegiatan" required>
        </div>

        <script>
        document.addEventListener("DOMContentLoaded", function () {
          const tanggalInput = document.getElementById('tanggal_kegiatan');

          const now = new Date();
          const formattedNow = now.toISOString().slice(0, 16); // format: YYYY-MM-DDTHH:MM

          tanggalInput.min = formattedNow;
        });
        </script>

      </div>
      <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 mt-4 rounded-2">Buat Kegiatan</button>
      </div>
    </form>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
      const form = document.querySelector("form");
      form.addEventListener("submit", function (event) {
        event.preventDefault(); // Mencegah form dikirim biasa

        let formData = new FormData(this);
        let actionUrl = this.getAttribute("action");
        let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

        fetch(actionUrl, {
        method: "POST",
        body: formData,
        headers: {
          "X-CSRF-TOKEN": csrfToken
        }
        })
        .then(response => response.json().catch(() => ({ error: true, message: "Format respons tidak valid" })))
        .then(data => {
          if (data.success) {
          Swal.fire({
            title: "Berhasil!",
            text: "Kegiatan berhasil ditambahkan!",
            icon: "success",
            timer: 2500,
            showConfirmButton: false
          }).then(() => {
            window.location.href = "/admin/view-kegiatan";
          });
          } else {
          Swal.fire({
            title: "Gagal!",
            text: data.message || "Terjadi kesalahan saat menambahkan kegiatan.",
            icon: "error",
            confirmButtonText: "Coba Lagi"
          });
          }
        })
        .catch(error => {
          console.error("Error:", error);
          Swal.fire({
          title: "Error!",
          text: "Terjadi kesalahan pada server.",
          icon: "error",
          confirmButtonText: "Coba Lagi"
          });
        });
      });
      });
    </script>

    </div>
  </div>
  </div>

@endsection