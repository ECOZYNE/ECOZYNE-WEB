@extends('layouts.dashboard')

@section('title', 'Konfirmasi Penukaran Hadiah')

@section('content')
   <div class="col-lg-12 d-flex align-items-stretch">
          <div class="card w-100">
            <div class="card-body p-4">
              <h5 class="card-title fw-semibold mb-4">Data Konfirmasi Penukaran Hadiah</h5>
              <hr>
              <div class="mb-3">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari pemesan...">
              </div>

              <div class="table-responsive">
                <table id="dataTable" class="table text-nowrap mb-0 align-middle">
                  <thead class="text-dark fs-4">
                    <tr>
                      <th><h6 class="fw-semibold mb-0">No</h6></th>
                      <th><h6 class="fw-semibold mb-0">Nama Penukar</h6></th>
                      <th><h6 class="fw-semibold mb-0">Nama Produk</h6></th>
                      <th><h6 class="fw-semibold mb-0">Jumlah</h6></th>
                      <th><h6 class="fw-semibold mb-0">Point</h6></th>
                      <th><h6 class="fw-semibold mb-0">Aksi</h6></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Andi</td>
                      <td>Ecozyme Cair</td>
                      <td>2</td>
                      <td>200</td>
                      <td>
                        <div class="dropdown">
                          <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="actionDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Aksi
                          </button>
                          <ul class="dropdown-menu" aria-labelledby="actionDropdown">
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="terimaPesanan('Andi Saputra')">Terima</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="tolakPesanan('Andi Saputra')">Tolak</a></li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Sitinur</td>
                      <td>Ecozyme Padat</td>
                      <td>5</td>
                      <td>150</td>
                      <td>
                        <div class="dropdown">
                          <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="actionDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Aksi
                          </button>
                          <ul class="dropdown-menu" aria-labelledby="actionDropdown">
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="terimaPesanan('Siti Nurhaliza')">Terima</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="tolakPesanan('Siti Nurhaliza')">Tolak</a></li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

        </div>
      </div>

    </div>
  </div>

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
  </script>

@endsection