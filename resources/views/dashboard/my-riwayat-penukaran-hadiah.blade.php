<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ecozyne | Data Komunitas</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/ecozyne.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <style>
        .table-responsive {
            overflow-x: auto;
            white-space: nowrap;
            scrollbar-color: #ccc transparent;
            scrollbar-width: thin;
        }

        .table-responsive::-webkit-scrollbar {
            height: 6px;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background-color: #888;
            border-radius: 3px;
        }

        .table-responsive::-webkit-scrollbar-track {
            background-color: transparent;
        }

        .table-responsive {
            -webkit-overflow-scrolling: touch;
            touch-action: pan-x;
        }
    </style>
</head>

<body>
    <x-loader />
    <x-sidebar-user />

    <!--  Main wrapper -->
    <div class="body-wrapper">
        <x-nav-header-user />

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">Penukaran Hadiah Saya</h5>
                            <hr>

                            <!-- Search Input -->
                            <div class="mb-3">
                                <input type="text" id="searchInput" class="form-control" placeholder="Cari data...">
                            </div>

                            <!-- Table -->
                            <div class="table-responsive">
                                <table id="dataTable" class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Produk</th>
                                            <th>Jumlah</th>
                                            <th>Total Harga</th>
                                        
                                            <th>Status Penukaran</th>
                                            <th>Tanggal Penukaran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <!-- ... awal dokumen tidak diubah ... -->
                                    <tbody>
                                        <!-- Pesanan 1 -->
                                        <tr>
                                            <td>1</td>
                                            <td>Beras 2 Kg</td>
                                            <td>2</td>
                                            <td>Rp40.000</td>
                                         
                                            <td>Selesai</td>
                                            <td>2025-05-01</td>
                                            <td>
                                                <span class="badge bg-success">Pesanan selesai</span>
                                            </td>
                                        </tr>

                                        <!-- Pesanan 2 -->
                                        <tr>
                                            <td>2</td>
                                            <td>sabun Organik</td>
                                            <td>1</td>
                                            <td>Rp80.000</td>
                                         
                                            <td>Selesai</td>
                                            <td>2025-04-28</td>
                                            <td>
                                                <span class="badge bg-success">Pesanan selesai</span>
                                            </td>
                                        </tr>

                                        <!-- Pesanan 3 -->
                                        <tr>
                                            <td>3</td>
                                            <td>Kompos Cair</td>
                                            <td>5</td>
                                            <td>Rp100.000</td>
                                     
                                            <td>Selesai</td>
                                            <td>2025-04-25</td>
                                            <td>
                                                <span class="badge bg-success">Pesanan selesai</span>
                                            </td>
                                        </tr>

                                        <!-- Pesanan 4 -->
                                        <tr>
                                            <td>4</td>
                                            <td>Minyak Goreng</td>
                                            <td>1</td>
                                            <td>Rp30.000</td>
                                       
                                            <td>Selesai</td>
                                            <td>2025-04-20</td>
                                            <td>
                                                <span class="badge bg-success">Pesanan selesai</span>
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>

                            <!-- Modal Edit Komunitas -->
                            <div class="modal fade" id="editModal" tabindex="-1">
                                <div class="modal-dialog">
                                    <form id="editForm">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5>Edit Komunitas</h5>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" id="komunitas_id">
                                                <label for="nama" class="form-label">Nama Lengkap</label>
                                                <input type="text" id="nama" name="nama" class="form-control mb-3">
                                                <label for="no_telp" class="form-label">Nomor Telepon</label>
                                                <input type="text" id="no_telp" name="no_telp"
                                                    class="form-control mb-3">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" id="username" name="username"
                                                    class="form-control mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" id="email" name="email" class="form-control mb-3">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <input type="text" id="alamat" name="alamat" class="form-control mb-3">
                                                <label for="kode_pos" class="form-label">Kode Pos</label>
                                                <input type="text" id="kode_pos" name="kode_pos"
                                                    class="form-control mb-3">
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

                            <!-- Script -->
                            <script>
                                function deleteKomunitas(id) {
                                    if (confirm('Yakin ingin menghapus komunitas ini?')) {
                                        $.ajax({
                                            url: `/admin/komunitas/${id}`,
                                            type: 'DELETE',
                                            data: {
                                                _token: '{{ csrf_token() }}'
                                            },
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
                                    e.preventDefault();
                                    const id = $('#komunitas_id').val();
                                    const data = $(this).serialize();

                                    $.ajax({
                                        url: `/admin/komunitas/${id}`,
                                        type: 'PUT',
                                        data: data,
                                        success: function (response) {
                                            alert(response.success);
                                            $('#editModal').modal('hide');
                                            location.reload();
                                        },
                                        error: function (xhr) {
                                            alert('Gagal update data');
                                        }
                                    });
                                });

                                document.addEventListener('DOMContentLoaded', function () {
                                    let table = document.querySelector('#dataTable tbody');
                                    let rows = Array.from(table.querySelectorAll('tr'));

                                    document.getElementById('searchInput').addEventListener('keyup', function () {
                                        let filter = this.value.toLowerCase();
                                        rows.forEach(row => {
                                            let text = row.textContent.toLowerCase();
                                            row.style.display = text.includes(filter) ? '' : 'none';
                                        });
                                    });
                                });
                            </script>

                        </div>
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