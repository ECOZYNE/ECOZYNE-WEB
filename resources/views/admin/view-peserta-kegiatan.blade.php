<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ecozyne | Data Komunitas</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/ecozyne.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <x-loader />
    <x-sidebar-admin />
    <div class="body-wrapper">
        <x-nav-header-admin />
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">Data Pendaftar Kegiatan</h5>
                            <hr>

                            <div class="mb-3">
                                <input type="text" class="form-control" id="searchInput"
                                    placeholder="Cari kegiatan atau peserta...">
                            </div>


                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kegiatan</th>
                                            <th>Jumlah Pendaftar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Pelatihan Eco Enzyme</td>
                                            <td>3</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#modalKegiatan1">
                                                    Detail
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Workshop Daur Ulang</td>
                                            <td>2</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#modalKegiatan2">
                                                    Detail
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Modal untuk Kegiatan 1 -->
                            <div class="modal fade" id="modalKegiatan1" tabindex="-1"
                                aria-labelledby="modalKegiatan1Label" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalKegiatan1Label">Peserta: Pelatihan Eco
                                                Enzyme</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Tutup"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th>Username</th>
                                                        <th>Email</th>
                                                        <th>No Telp</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Andi Saputra</td>
                                                        <td>andi_saputra</td>
                                                        <td>andi@example.com</td>
                                                        <td>081234567890</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Rina Marlina</td>
                                                        <td>rina123</td>
                                                        <td>rina@example.com</td>
                                                        <td>081298765432</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Fadli Ramadhan</td>
                                                        <td>fadli_eco</td>
                                                        <td>fadli@example.com</td>
                                                        <td>081377788899</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
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
        document.addEventListener('DOMContentLoaded', function () {
          const searchInput = document.getElementById('searchInput');
          const rows = document.querySelectorAll('table tbody tr');
      
          searchInput.addEventListener('keyup', function () {
            const keyword = this.value.toLowerCase();
            rows.forEach(row => {
              const text = row.textContent.toLowerCase();
              row.style.display = text.includes(keyword) ? '' : 'none';
            });
          });
        });
      </script>
      
</body>

</html>