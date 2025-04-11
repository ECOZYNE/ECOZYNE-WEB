<!doctype html>
<html lang="en">

<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ecozyne | Tambah Galeri</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/ecozyne.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

  @include('components.loader')
  <x-sidebar-admin />

  <div class="body-wrapper">
    @include('components.header')

    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title fw-semibold mb-4">Tambah Galeri</h5>
          <hr>

          <form method="POST" action="{{ route('galeri.post') }}" enctype="multipart/form-data">
            @csrf
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="foto" class="form-label">Foto</label>
                  <input type="file" class="form-control" name="foto" id="foto" required>
                </div>

                <div class="col-md-6 mb-3">
                  <label for="deskripsi" class="form-label">Deskripsi</label>
                  <input type="text" class="form-control" name="deskripsi" id="deskripsi" required>
                </div>
              </div>

              <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 mt-4 rounded-2">Upload Foto</button>
            </div>
          </form>

          <script>
            document.addEventListener("DOMContentLoaded", function () {
              document.querySelector("form").addEventListener("submit", function (event) {
                event.preventDefault();

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
                .then(response => response.json())
                .then(data => {
                  if (data.success) {
                    Swal.fire({
                      title: "Berhasil!",
                      text: "Foto berhasil ditambahkan ke galeri.",
                      icon: "success",
                      timer: 3500,
                      showConfirmButton: false
                    }).then(() => {
                      window.location.href = "/admin/view-galeri";
                    });
                  } else {
                    Swal.fire("Gagal", data.message || "Terjadi kesalahan.", "error");
                  }
                })
                .catch(error => {
                  console.error(error);
                  Swal.fire("Error", "Terjadi kesalahan server.", "error");
                });
              });
            });
          </script>

        </div>
      </div>
    </div>
  </div>

  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
</body>

</html>
