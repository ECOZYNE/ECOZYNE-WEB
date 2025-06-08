@extends('layouts.dashboard')

@section('title', 'Data Komunitas')

@section('content')
    <div class="col-lg-12 d-flex align-items-stretch">
          <div class="card w-100">
            <div class="card-body p-4">
              <h5 class="card-title fw-semibold mb-4">Data Komunitas</h5>
              <hr>
              <div class="mb-3">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari komunitas...">
              </div>

              <div class="table-responsive">
                <table id="dataTable" class="table text-nowrap mb-0 align-middle">
                  <thead class="text-dark fs-4">
                    <tr>
                      <th>
                        <h6 class="fw-semibold mb-0">No</h6>
                      </th>
                      <th>
                        <h6 class="fw-semibold mb-0">Nama Pengguna</h6>
                      </th>
                      <th>
                        <h6 class="fw-semibold mb-0">Email</h6>
                      </th>
                      <th>
                        <h6 class="fw-semibold mb-0">No Telp</h6>
                      </th>
                      <th>
                        <h6 class="fw-semibold mb-0">Aksi</h6>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($komunitas as $data_pengguna)
            <tr>
              <td>
              <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
              </td>
              <td>
              <p class="mb-0 fw-normal">{{ $data_pengguna->user->username }}</p>
              </td>
              <td>
              <p class="mb-0 fw-normal">{{ $data_pengguna->user->email }}</p>
              </td>
              <td>
              <p class="mb-0 fw-normal">{{ $data_pengguna->no_telp }}</p>
              </td>
              <td>
              <div class="d-flex align-items-center gap-2">
                <button class="btn btn-sm btn-warning"
                onclick="editKomunitas({{ $data_pengguna->id_komunitas }})">
                <i class="fas fa-edit"></i>
                </button>
                <button class="btn btn-sm btn-danger"
                onclick="deleteKomunitas({{ $data_pengguna->id_komunitas }})">
                <i class="fas fa-trash"></i>
                </button>
              </div>
              </td>
            </tr>
          @endforeach
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
                <h5>Edit Komunitas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <input type="hidden" id="komunitas_id">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" class="form-control mb-3">
                <label for="no_telp" class="form-label">Nomor Telepon</label>
                <input type="text" id="no_telp" name="no_telp" class="form-control mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-control mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" id="alamat" name="alamat" class="form-control mb-3">
                <label for="kode_pos" class="form-label">Kode Pos</label>
                <input type="number" id="kode_pos" name="kode_pos" class="form-control mb-3">
                <label for="kelurahan" class="form-label">Kelurahan</label>
                <input type="text" id="kelurahan" class="form-control mb-3" readonly>
                <label for="kecamatan" class="form-label">Kecamatan</label>
                <input type="text" id="kecamatan" class="form-control mb-3" readonly>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </div>
          </form>

        </div>
      </div>
@endsection

@push('scripts')
  <script>
    function deleteKomunitas(id) {
      if (confirm('Yakin ingin menghapus komunitas ini?')) {
        $.ajax({
          url: `/admin/komunitas/${id}`,
          type: 'DELETE',
          data: { _token: '{{ csrf_token() }}' },
          success: function (res) {
            alert(res.success);
            location.reload();
          },
          error: function () {
            alert('Gagal menghapus komunitas');
          }
        });
      }
    }

    function editKomunitas(id) {
      $.get(`/admin/komunitas/${id}`, function (data) {
        $('#komunitas_id').val(data.id);
        $('#nama').val(data.nama);
        $('#no_telp').val(data.no_telp);
        $('#username').val(data.username);
        $('#email').val(data.email);
        $('#alamat').val(data.alamat);
        $('#kode_pos').val(data.kode_pos);
        $('#kelurahan').val(data.kelurahan);
        $('#kecamatan').val(data.kecamatan);
        $('#editModal').modal('show');
      });
    }

    $('#editForm').submit(function (e) {
      e.preventDefault();  // Mencegah form submit secara default
      const id = $('#komunitas_id').val();  // Ambil id komunitas
      const data = $(this).serialize();  // Ambil data form yang telah diisi

      $.ajax({
        url: `/admin/komunitas/${id}`,  // URL untuk melakukan update data komunitas
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
            text: 'Gagal memperbarui data komunitas.',  // Pesan error
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
@endpush