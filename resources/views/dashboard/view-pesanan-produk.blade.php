<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ecozyne | Data Pesanan Produk</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/ecozyne.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<script>
    function ubahStatus(id, statusBaru) {
        const statusElem = document.getElementById(`status-${id}`);
        statusElem.textContent = statusBaru;
        statusElem.className = 'badge bg-success'; // ubah warna badge
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: `Status pesanan #${id} telah diubah menjadi "${statusBaru}"`,
            timer: 1500,
            showConfirmButton: false
        });

        // Tambahkan AJAX di sini jika ingin simpan ke server
    }
</script>


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
                            <h5 class="card-title fw-semibold mb-4">Data Pesanan Produk</h5>
                            <hr>
                            <div class="mb-3">
                                <input type="text" id="searchInput" class="form-control"
                                    placeholder="Cari data...">
                            </div>

                            <div class="table-responsive">

                                <table id="dataTable" class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th>
                                                <h6 class="fw-semibold mb-0">No</h6>
                                            </th>
                                            <th>
                                                <h6 class="fw-semibold mb-0">Username Pemesan</h6>
                                            </th>
                                            <th>
                                                <h6 class="fw-semibold mb-0">Nama Barang</h6>
                                            </th>
                                            <th>
                                                <h6 class="fw-semibold mb-0">Jumlah Barang</h6>
                                            </th>
                                            <th>
                                                <h6 class="fw-semibold mb-0">Harga</h6>
                                            </th>
                                            <th>
                                                <h6 class="fw-semibold mb-0">Alamat Komunitas</h6>
                                            </th>
                                            <th>
                                                <h6 class="fw-semibold mb-0">Tanggal</h6>
                                            </th> <!-- Tambahan -->
                                            <th>
                                                <h6 class="fw-semibold mb-0">Status</h6>
                                            </th>
                                            <th>
                                                <h6 class="fw-semibold mb-0">Aksi</h6>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                          <td>1</td>
                                          <td>andi123</td>
                                          <td>Ecozyme Cair</td>
                                          <td>2</td>
                                          <td>Rp50.000</td>
                                          <td>Jl. Raden Patah No. 10, Lubuk Baja</td>
                                          <td>07 Mei 2025</td> <!-- Tambahan -->
                                          <td><span class="badge bg-info" id="status-1">Dikirim</span></td>
                                          <td>
                                            <div class="dropdown">
                                              <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                Aksi
                                              </button>
                                              <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#" onclick="ubahStatus(1, 'Selesai')">Tandai Selesai</a></li>
                                              </ul>
                                            </div>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>2</td>
                                          <td>sitinur</td>
                                          <td>Ecozyme Padat</td>
                                          <td>5</td>
                                          <td>Rp125.000</td>
                                          <td>Jl. Sudirman No. 22, Batu Aji</td>
                                          <td>06 Mei 2025</td> <!-- Tambahan -->
                                          <td><span class="badge bg-info" id="status-2">Dikirim</span></td>
                                          <td>
                                            <div class="dropdown">
                                              <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                Aksi
                                              </button>
                                              <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#" onclick="ubahStatus(2, 'Selesai')">Tandai Selesai</a></li>
                                              </ul>
                                            </div>
                                          </td>
                                        </tr>
                                      </tbody>
                                    
                            </div>

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
</body>

</html>