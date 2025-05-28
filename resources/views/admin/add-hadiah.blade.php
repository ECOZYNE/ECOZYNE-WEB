@extends('layouts.dashboard')

@section('title', 'Tambah Hadiah')

@section('content')
  <div class="card">
    <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Tambah Hadiah</h5>
    <hr>
    <!-- Formulir Pendaftaran -->
    <form method="POST" action="{{ route('artikel.post') }}" enctype="multipart/form-data">
      @csrf
      <div class="container-fluid">
      <div class="row">

        <div class="col-md-6 mb-3">
        <label for="nama_hadiah" class="form-label">Nama Hadiah</label>
        <input type="text" class="form-control" name="nama_hadiah" id="nama_hadiah"
          placeholder="Masukkan Nama Hadiah" required>
        </div>

        <div class="col-md-6 mb-3">
        <label for="foto" class="form-label">Foto</label>
        <input type="file" class="form-control" name="foto" id="foto" required>
        </div>

        <div class="col-md-6 mb-3">
        <label for="stok" class="form-label">Stok</label>
        <input type="number" class="form-control" name="stok" id="stok" placeholder="Masukkan Stok" required>
        </div>

        <div class="col-md-6 mb-3">
        <label for="poin_per_item" class="form-label">Poin Per Item</label>
        <input type="number" class="form-control" name="poin_per_item" id="poin_per_item"
          placeholder="Masukkan Poin Per Item" required>
        </div>

        <div class="col-md-12 mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="5" placeholder="Masukkan Deskripsi"
          required></textarea>
        </div>

      </div>
      <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 mt-4 rounded-2">Buat Hadiah</button>
      </div>
    </form>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
      document.querySelector("form").addEventListener("submit", function (event) {
        event.preventDefault(); // Mencegah pengiriman form default

        let formData = new FormData(this);
        let actionUrl = this.getAttribute("action");
        let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content"); // Ambil dari meta

        fetch(actionUrl, {
        method: "POST",
        body: formData,
        headers: {
          "X-CSRF-TOKEN": csrfToken
        }
        })
        .then(response => response.json().catch(() => ({ error: true, message: "Format respons tidak valid" }))) // Tangani error jika response bukan JSON
        .then(data => {
          if (data.success) {
          Swal.fire({
            title: "Berhasil!",
            text: "Artikel berhasil ditambahkan!",
            icon: "success",
            timer: 3500, // Menutup otomatis dalam 3,5 detik
            showConfirmButton: false
          }).then(() => {
            window.location.href = "/admin/view-hadiah"; // Redirect setelah swal selesai
          });
          } else {
          Swal.fire({
            title: "Gagal!",
            text: data.message || "Terjadi kesalahan saat menambahkan data.",
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
  </div>
  </div>
@endsection