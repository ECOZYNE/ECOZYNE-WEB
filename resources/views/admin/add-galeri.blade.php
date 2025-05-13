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

  <x-loader />

  <x-sidebar-admin /> 

  <!--  Main wrapper -->
  <div class="body-wrapper">

    <x-nav-header-admin />


    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title fw-semibold mb-4">Tambah Galeri</h5>
          <hr>

          <form id="galeri-form" enctype="multipart/form-data">
            @csrf
            <div class="container-fluid">
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control" name="foto" id="foto" accept=".jpg,.jpeg,.png" required placeholder="Pilih foto galeri">
                  </div>
                  
                  
                    <div class="col-md-6 mb-3">
                      <label for="deskripsi" class="form-label">Deskripsi singkat</label>
                      <input type="text" class="form-control" name="deskripsi" id="deskripsi" required placeholder="Masukkan deskripsi singkat galeri">
                    </div>
                  </div>                  

              <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 mt-4 rounded-2">Buat Galeri</button>
            </div>
          </form>

          <script>
            document.addEventListener("DOMContentLoaded", function () {
              const form = document.querySelector("#galeri-form");
          
              form.addEventListener("submit", function (event) {
                event.preventDefault();
          
                let formData = new FormData(form);
                let actionUrl = "{{ route('galeri.post') }}";
                let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
          
                fetch(actionUrl, {
                  method: "POST",
                  body: formData,
                  headers: {
                    "X-CSRF-TOKEN": csrfToken
                  }
                })
                .then(async (response) => {
                  if (!response.ok) {
                    if (response.status === 422) {
                      const data = await response.json();
                      let messages = Object.values(data.errors).flat().join('\n');
                      throw new Error(messages);
                    } else {
                      throw new Error("Terjadi kesalahan pada server.");
                    }
                  }
                  return response.json();
                })
                .then(data => {
                  Swal.fire({
                    title: "Berhasil!",
                    text: data.message,
                    icon: "success",
                    timer: 2500,
                    showConfirmButton: false
                  }).then(() => {
                    window.location.href = "/admin/view-galeri";
                  });
                })
                .catch(error => {
                  Swal.fire("Gagal", error.message || "Terjadi kesalahan.", "error");
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
