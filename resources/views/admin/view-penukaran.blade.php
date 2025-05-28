@extends('layouts.dashboard')

@section('title', 'Data Penukaran Hadiah')

@section('content')

    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Data Penukaran Hadiah</h5>
                <hr>
                <div class="mb-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari data...">
                </div>

                <div class="table-responsive">

                    <table id="dataTable" class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th>
                                    <h6 class="fw-semibold mb-0">No</h6>
                                </th>
                                <th>
                                    <h6 class="fw-semibold mb-0">Nama Penukar</h6>
                                </th>
                                <th>
                                    <h6 class="fw-semibold mb-0">Nama Barang</h6>
                                </th>
                                <th>
                                    <h6 class="fw-semibold mb-0">Jumlah Barang</h6>
                                </th>
                                <th>
                                    <h6 class="fw-semibold mb-0">Point</h6>
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
                                <td>andi</td>
                                <td>Ecozyme Cair</td>
                                <td>2</td>
                                <td>100</td>
                                <td>Jl. Raden Patah No. 10, Lubuk Baja</td>
                                <td>07 Mei 2025</td> <!-- Tambahan -->
                                <td><span class="badge bg-info" id="status-1">Dikirim</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown">
                                            Aksi
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#" onclick="ubahStatus(1, 'Selesai')">Tandai
                                                    Selesai</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>sitinur</td>
                                <td>Ecozyme Padat</td>
                                <td>5</td>
                                <td>250</td>
                                <td>Jl. Sudirman No. 22, Batu Aji</td>
                                <td>06 Mei 2025</td> <!-- Tambahan -->
                                <td><span class="badge bg-info" id="status-2">Dikirim</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown">
                                            Aksi
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#" onclick="ubahStatus(2, 'Selesai')">Tandai
                                                    Selesai</a>
                                            </li>
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

@endsection