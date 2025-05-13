<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ecozyne | Tambah Setoran sampah</title>
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
          <h5 class="card-title fw-semibold mb-4">Tambah Setoran Sampah</h5>
          <hr>

          <!-- Formulir Pendaftaran -->
          <form method="POST" action="/register-post">
            @csrf
            <div class="row">
              <!-- Kolom pertama untuk mencari username -->
              <div class="col-md-6 mb-3">
                <label for="usernameSearch" class="form-label">Cari Username</label>
                <input type="text" class="form-control" name="usernameSearch" id="usernameSearch" placeholder="Cari username" onkeyup="searchUsername()" required>
              </div>

              <!-- Kolom kedua untuk memasukkan berat sampah -->
              <div class="col-md-6 mb-3">
                <label for="beratSampah" class="form-label">Berat Sampah (kg)</label>
                <input type="number" class="form-control" name="berat_sampah" id="beratSampah" placeholder="Masukkan berat sampah" min="0" required>
              </div>
            </div>

        

          <!-- Data dummy (cari username) -->
          <div id="dummyData" class="mt-4" style="display: none;">
            <h6>Data Penyetor:</h6>
            <table class="table">
              <thead>
                <tr>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Telp</th>
                </tr>
              </thead>
              <tbody id="usernameResults">
                <tr>
                  <td>john_doe</td>
                  <td>john@example.com</td>
                  <td>081234567890</td>
                </tr>
                <tr>
                  <td>jane_smith</td>
                  <td>jane@example.com</td>
                  <td>089876543210</td>
                </tr>
                <tr>
                  <td>alex_w</td>
                  <td>alex@example.com</td>
                  <td>087654321098</td>
                </tr>
              </tbody>
            </table>
          </div>

          <button type="submit" class="btn btn-primary w-100 py-2 fs-4 mb-4 mt-4 rounded-2">Buat Storan</button>
        </form>

          <script>
            // Fungsi untuk mencari username
            function searchUsername() {
              var input, filter, table, tr, td, i, txtValue;
              input = document.getElementById("usernameSearch");
              filter = input.value.toUpperCase();
              table = document.getElementById("dummyData");
              tr = table.getElementsByTagName("tr")[0].getElementsByTagName("tr");

              // Tampilkan tabel jika ada input
              if (filter.length > 0) {
                table.style.display = "block";
              } else {
                table.style.display = "none";
              }

              var rows = document.getElementById('usernameResults').rows;

              // Loop melalui semua baris tabel dan sembunyikan yang tidak sesuai dengan pencarian
              for (i = 0; i < rows.length; i++) {
                td = rows[i].getElementsByTagName("td")[0]; // Kolom username
                if (td) {
                  txtValue = td.textContent || td.innerText;
                  if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    rows[i].style.display = "";
                  } else {
                    rows[i].style.display = "none";
                  }
                }
              }
            }
          </script>

          <script>
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    showConfirmButton: true,
                    confirmButtonText: 'OK'
                });
            @elseif (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: "{{ session('error') }}",
                    showConfirmButton: true,
                    confirmButtonText: 'OK'
                });
            @endif
        </script>
        
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
