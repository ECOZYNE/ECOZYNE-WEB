<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ecozyne | Data Setoran Sampah</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/ecozyne.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <x-loader />
  <x-sidebar-user-super />
  <div class="body-wrapper">
    <x-nav-header-user-super />
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
          <div class="card w-100">
            <div class="card-body p-4">
              <h5 class="card-title fw-semibold mb-4">Data Setoran Sampah</h5>
              <hr>
              <div class="mb-3">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari setoran...">
              </div>

              <div class="table-responsive">
                <table id="dataTable" class="table text-nowrap mb-0 align-middle">
                  <thead class="text-dark fs-4">
                    <tr>
                      <th>
                        <h6 class="fw-semibold mb-0">Id</h6>
                      </th>
                      <th>
                        <h6 class="fw-semibold mb-0">Username</h6>
                      </th>
                      <th>
                        <h6 class="fw-semibold mb-0">Berat Sampah (kg)</h6>
                      </th>
                      <th>
                        <h6 class="fw-semibold mb-0">Tanggal Setor</h6>
                      </th>
                    
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Data dummy setoran sampah -->
                    <tr>
                      <td>
                        <h6 class="fw-semibold mb-0">1</h6>
                      </td>
                      <td>
                        <p class="mb-0 fw-normal">john_doe</p>
                      </td>
                      <td>
                        <p class="mb-0 fw-normal">25</p>
                      </td>
                      <td>
                        <p class="mb-0 fw-normal">2025-05-01</p>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <h6 class="fw-semibold mb-0">2</h6>
                      </td>
                      <td>
                        <p class="mb-0 fw-normal">jane_doe</p>
                      </td>
                      <td>
                        <p class="mb-0 fw-normal">30</p>
                      </td>
                      <td>
                        <p class="mb-0 fw-normal">2025-05-02</p>
                      </td>
                    </tr>
                    <!-- Tambahkan lebih banyak data sesuai kebutuhan -->
                  </tbody>
                </table>
              </div>

              <!-- Pagination control -->
              <div class="d-flex justify-content-between align-items-center mt-3">
                <button class="btn btn-outline-secondary btn-sm" id="prevPage">Sebelumnya</button>
                <span id="pageInfo" class="fw-semibold"></span>
                <button class="btn btn-outline-secondary btn-sm" id="nextPage">Berikutnya</button>
              </div>

            </div>
          </div>
        </div>
      </div>

      <!-- Modal Edit -->
      <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
          <form id="editForm">
            @csrf
            @method('PUT')
            <div class="modal-content">
              <div class="modal-header">
                <h5>Edit Setoran Sampah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <input type="hidden" id="setoran_id">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-control mb-3">
                <label for="berat" class="form-label">Berat Sampah (kg)</label>
                <input type="number" id="berat" name="berat" class="form-control mb-3">
                <label for="tanggal_setor" class="form-label">Tanggal Setor</label>
                <input type="date" id="tanggal_setor" name="tanggal_setor" class="form-control mb-3">
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>

  <!-- Scripts -->
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>

  <script>
    function deleteSetoran(id) {
      if (confirm('Yakin ingin menghapus setoran sampah ini?')) {
        // Ganti dengan URL untuk menghapus setoran
        $.ajax({
          url: `/admin/setoran/${id}`,
          type: 'DELETE',
          data: { _token: '{{ csrf_token() }}' },
          success: function (res) {
            alert(res.success);
            location.reload();
          },
          error: function () {
            alert('Gagal menghapus setoran sampah');
          }
        });
      }
    }

    function editSetoran(id) {
      // Ganti dengan URL untuk mendapatkan data setoran berdasarkan id
      $.get(`/admin/setoran/${id}`, function (data) {
        $('#setoran_id').val(data.id);
        $('#username').val(data.username);
        $('#berat').val(data.berat);
        $('#tanggal_setor').val(data.tanggal_setor);
        $('#editModal').modal('show');
      });
    }

    $('#editForm').submit(function (e) {
      e.preventDefault();  // Mencegah form submit secara default
      const id = $('#setoran_id').val();  // Ambil id setoran
      const data = $(this).serialize();  // Ambil data form yang telah diisi

      $.ajax({
        url: `/admin/setoran/${id}`,  // URL untuk melakukan update data setoran
        type: 'PUT',
        data: data,
        success: function (response) {
          Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: response.success,  // Menampilkan pesan sukses dari response
            showConfirmButton: true
          }).then(() => {
            $('#editModal').modal('hide');  // Menutup modal setelah sukses
            location.reload();  // Reload halaman
          });
        },
        error: function (xhr) {
          // Jika gagal, tampilkan error
          Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: 'Gagal memperbarui data setoran sampah.',  // Pesan error
            showConfirmButton: true
          });
        }
      });
    });

    document.addEventListener('DOMContentLoaded', function () {
      let rowsPerPage = 10;
      let table = document.querySelector('#dataTable tbody');
      let rows = Array.from(table.querySelectorAll('tr'));
      let currentPage = 1;
      let totalPages = Math.ceil(rows.length / rowsPerPage);

      function displayRows() {
        rows.forEach((row, index) => {
          row.style.display = (index >= (currentPage - 1) * rowsPerPage && index < currentPage * rowsPerPage) ? '' : 'none';
        });
        document.getElementById('pageInfo').textContent = `Halaman ${currentPage} dari ${totalPages}`;
      }

      document.getElementById('prevPage').addEventListener('click', function () {
        if (currentPage > 1) {
          currentPage--;
          displayRows();
        }
      });

      document.getElementById('nextPage').addEventListener('click', function () {
        if (currentPage < totalPages) {
          currentPage++;
          displayRows();
        }
      });

      document.getElementById('searchInput').addEventListener('keyup', function () {
        let filter = this.value.toLowerCase();
        rows.forEach(row => {
          let text = row.textContent.toLowerCase();
          row.style.display = text.includes(filter) ? '' : 'none';
        });
      });

      displayRows();
    });
  </script>
</body>

</html>
