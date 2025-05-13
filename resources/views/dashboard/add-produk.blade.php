<!doctype html>
<html lang="en">

<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ecozyne | Tambah Produk</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/ecozyne.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
  <!-- SweetAlert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Tambahkan Bootstrap Icons jika belum ada -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>

  <x-loader />

  <x-sidebar-user-super />

  <!--  Main wrapper -->
  <div class="body-wrapper">

    <x-nav-header-user-super />

    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title fw-semibold mb-4">Tambah Produk</h5>

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
          <!-- Formulir Tambah Produk -->
          <form method="POST" action="" enctype="multipart/form-data">
            @csrf
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="nama_produk" class="form-label">Nama Produk</label>
                  <input type="text" class="form-control" name="nama_produk" id="nama_produk" placeholder="Masukkan Nama Produk"
                    required>
                </div>

                <div class="col-md-6 mb-3">
                  <label for="foto" class="form-label">Foto Produk</label>
                  <input type="file" class="form-control" name="foto" id="foto" accept=".jpg, .jpeg, .png" required>
                </div>

                <div class="col-md-12 mb-3">
                  <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                  <textarea class="form-control" name="deskripsi" id="deskripsi" rows="6" placeholder="Masukkan Deskripsi Produk"
                    required></textarea>
                </div>

                <div class="col-md-6 mb-3">
                  <label for="stok" class="form-label">Stok Produk</label>
                  <input type="number" class="form-control" name="stok" id="stok" placeholder="Masukkan Stok Produk" required>
                </div>

                <div class="col-md-6 mb-3">
                  <label for="harga" class="form-label">Harga Produk</label>
                  <input type="number" class="form-control" name="harga" id="harga" placeholder="Masukkan Harga Produk" required>
                </div>
              </div>
              <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 mt-4 rounded-2">Tambah Produk</button>
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
                        text: "Produk berhasil ditambahkan!",
                        icon: "success",
                        timer: 2500, // Menutup otomatis dalam 2,5 detik
                        showConfirmButton: false
                      }).then(() => {
                        window.location.href = "/admin/view-produk"; // Redirect setelah swal selesai
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

        </div>
      </div>
    </div>

  </div>
  </div>

  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
</body>

</html>
