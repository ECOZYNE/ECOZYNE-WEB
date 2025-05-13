<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ecozyne | Data Galeri</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/ecozyne.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/styles-view-galeri.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
</head>

<body>
    <x-loader />
    <x-sidebar-admin />

    <!--  Main wrapper -->
    <div class="body-wrapper">
        <x-nav-header-admin />

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <!-- Ganti bagian card-body -->
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">Data Bank Sampah</h5>
                            <hr>

                            <!-- Search Input -->
                            <div class="mb-3">
                                <input type="text" id="searchInput" class="form-control"
                                    placeholder="Cari bank sampah...">
                            </div>

                            <!-- Table -->
                            <div class="table-responsive">
                                <table id="dataTable" class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Bank Sampah</th>
                                            <th>Alamat</th>
                                            <th>No. Telepon</th>
                                            <th>Dokumen</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Bank Sampah Hijau Lestari</td>
                                            <td>Jl. Bunga Raya No.88, Batam</td>
                                            <td>081234567890</td>
                                            <td>
                                                <a href="/dokumen/hijau_lestari.pdf" target="_blank"
                                                    class="btn btn-sm btn-info">
                                                    <i class="fas fa-file-pdf"></i> View PDF
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-danger" onclick="deleteBankSampah(1)">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Bank Sampah Bersih Indah</td>
                                            <td>Jl. Cendana No.14, Batam</td>
                                            <td>082345678901</td>
                                            <td>
                                                <a href="/dokumen/bersih_indah.pdf" target="_blank"
                                                    class="btn btn-sm btn-info">
                                                    <i class="fas fa-file-pdf"></i> View PDF
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-danger" onclick="deleteBankSampah(2)">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Bank Sampah Sejahtera</td>
                                            <td>Jl. Hang Lekir No.30, Batam</td>
                                            <td>083456789012</td>
                                            <td>
                                                <a href="/dokumen/sejahtera.pdf" target="_blank"
                                                    class="btn btn-sm btn-info">
                                                    <i class="fas fa-file-pdf"></i> View PDF
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-danger" onclick="deleteBankSampah(3)">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>                                    
                                </table>
                            </div>

    <!-- Script -->
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>

    <script>
        $(document).ready(function () {
            // Fungsi pencarian
            $('#searchInput').on('input', function () {
                const query = $(this).val().toLowerCase();
                $('.galeri-card').each(function () {
                    const deskripsi = $(this).find('.galeri-deskripsi').text().toLowerCase();
                    $(this).toggle(deskripsi.includes(query));
                });
            });

            // Isi modal edit
            $('.edit-galeri-btn').on('click', function () {
                const id = $(this).data('id');
                const deskripsi = $(this).data('deskripsi');
                const foto = $(this).data('foto');
                const url = $(this).data('url');

                $('#editGaleriForm').attr('action', url);
                $('#edit-deskripsi').val(deskripsi);
                $('#edit-id-galeri').val(id);

                if (foto) {
                    $('#currentGaleriImage').attr('src', '/storage/galeri/' + foto);
                    $('#currentGaleriImageContainer').show();
                } else {
                    $('#currentGaleriImageContainer').hide();
                }

                $('#editGaleriModal').modal('show');
            });
        });
    </script>
</body>

</html>
