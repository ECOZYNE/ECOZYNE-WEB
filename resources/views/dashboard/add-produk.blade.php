@extends('layouts.dashboard')

@section('title', 'Dahboard Pengguna')

@section('content')
  <div class="card">
    <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Tambah Produk</h5>
    <hr>
    <!-- Formulir Tambah Produk -->
    <form method="POST" action="" enctype="multipart/form-data">
      @csrf
      <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 mb-3">
        <label for="nama_produk" class="form-label">Nama Produk <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="nama_produk" id="nama_produk"
          placeholder="Masukkan Nama Produk" required>
        </div>

        <div class="col-md-6 mb-3">
        <label for="foto" class="form-label">Foto Produk <span class="text-danger">*</span></label>
        <input type="file" class="form-control" name="foto" id="foto" accept=".jpg, .jpeg, .png" required>
        </div>

        <div class="col-md-12 mb-3">
        <label for="deskripsi" class="form-label">Deskripsi Produk <span class="text-danger">*</span></label>
        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="6"
          placeholder="Masukkan Deskripsi Produk" required></textarea>
        </div>

        <div class="col-md-6 mb-3">
        <label for="stok" class="form-label">Stok Produk <span class="text-danger">*</span></label>
        <input type="number" class="form-control" name="stok" id="stok" placeholder="Masukkan Stok Produk" required>
        </div>

        <div class="col-md-6 mb-3">
        <label for="harga" class="form-label">Harga Produk <span class="text-danger">*</span></label>
        <input type="number" class="form-control" name="harga" id="harga" placeholder="Masukkan Harga Produk"
          required>
        </div>
      </div>
      <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 mt-4 rounded-2">Tambah Produk</button>
      </div>
    </form>
    </div>
  </div>

@endsection

  @push('scripts')

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
          text: "Produk berhasil ditambahkan!",
          icon: "success",
          confirmButtonText: "OK"
        }).then(() => {
          // Reset form setelah berhasil
          document.querySelector("form").reset();
          // Tetap di halaman add-produk, tidak redirect
        });
        } else {
        Swal.fire({
          title: "Gagal!",
          text: data.message || "Terjadi kesalahan saat menambahkan produk.",
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
    @endpush