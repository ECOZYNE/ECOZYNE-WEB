<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ecozyne | Data Produk</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/ecozyne.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/styles-view-produk.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
</head>

<body>

    <x-loader />
    <x-sidebar-user-super />

    <!-- Main wrapper -->
    <div class="body-wrapper">
        <x-nav-header-user-super />

        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-2">Data Produk</h5>

                    <hr>
                    <div class="mb-1">
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari Produk...">
                    </div>
                    <hr>

                    <!-- Dummy data produk -->
                    <div class="row" id="produkContainer">
                        <!-- Produk 1 -->
                        <div class="col-md-4 mb-4 hadiah-card">
                            <div class="card">
                                <img src="{{ asset('assets2/img/hadiah/produk1.jpeg') }}" class="card-img-top" alt="Produk 1">
                                <div class="card-body">
                                    <h5 class="card-title hadiah-title">Produk 1</h5>
                                    <p class="card-text hadiah-teks">Deskripsi singkat produk 1. Stok: 20 | Harga: Rp 50,000</p>
                                    <button class="btn btn-primary edit-produk-btn" data-id="1" data-judul="Produk 1" 
                                            data-deskripsi="Deskripsi singkat produk 1." data-harga="50000"
                                            data-stok="20" data-foto="dummy-product.jpg">
                                        Edit Produk
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Produk 2 -->
                        <div class="col-md-4 mb-4 hadiah-card">
                            <div class="card">
                                <img src="{{ asset('assets2/img/hadiah/produk6.png') }}" class="card-img-top" alt="Produk 2">
                                <div class="card-body">
                                    <h5 class="card-title hadiah-title">Produk 2</h5>
                                    <p class="card-text hadiah-teks">Deskripsi singkat produk 2. Stok: 15 | Harga: Rp 75,000</p>
                                    <button class="btn btn-primary edit-produk-btn" data-id="2" data-judul="Produk 2" 
                                            data-deskripsi="Deskripsi singkat produk 2." data-harga="75000"
                                            data-stok="15" data-foto="dummy-product.jpg">
                                        Edit Produk
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Produk 3 -->
                        <div class="col-md-4 mb-4 hadiah-card">
                            <div class="card">
                                <img src="{{ asset('assets2/img/hadiah/produk7.png') }}" class="card-img-top" alt="Produk 3">
                                <div class="card-body">
                                    <h5 class="card-title hadiah-title">Produk 3</h5>
                                    <p class="card-text hadiah-teks">Deskripsi singkat produk 3. Stok: 30 | Harga: Rp 100,000</p>
                                    <button class="btn btn-primary edit-produk-btn" data-id="3" data-judul="Produk 3" 
                                            data-deskripsi="Deskripsi singkat produk 3." data-harga="100000"
                                            data-stok="30" data-foto="dummy-product.jpg">
                                        Edit Produk
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Produk -->
    <div class="modal fade" id="editProdukModal" tabindex="-1" aria-labelledby="editProdukModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="editProdukForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProdukModalLabel">Edit Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_produk" id="edit-id-produk">

                        <div class="mb-3">
                            <label for="edit-judul" class="form-label">Nama Produk</label>
                            <input type="text" name="judul" id="edit-judul" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-foto" class="form-label">Foto Produk</label>
                            <div id="currentImageContainer" style="display:none;">
                                <img id="currentImage" src="" alt="Gambar Produk" class="img-fluid"
                                    style="max-width: 150px; max-height: 150px; margin-bottom: 10px;">
                            </div>
                            <input type="file" name="foto" id="edit-foto" class="form-control" accept=".jpg, .jpeg, .png">
                        </div>
                        
                        <div class="mb-3">
                            <label for="edit-deskripsi" class="form-label">Deskripsi Produk</label>
                            <textarea name="deskripsi" id="edit-deskripsi" rows="4" class="form-control" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="edit-harga" class="form-label">Harga Produk</label>
                            <input type="number" name="harga" id="edit-harga" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-stok" class="form-label">Stok Produk</label>
                            <input type="number" name="stok" id="edit-stok" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>

    <script>
        $(document).ready(function () {
            // Handle klik tombol edit
            $('.edit-produk-btn').click(function () {
                let id = $(this).data('id');
                let judul = $(this).data('judul');
                let deskripsi = $(this).data('deskripsi');
                let harga = $(this).data('harga');
                let stok = $(this).data('stok');
                let foto = $(this).data('foto');

                $('#edit-id-produk').val(id);
                $('#edit-judul').val(judul);
                $('#edit-deskripsi').val(deskripsi);
                $('#edit-harga').val(harga);
                $('#edit-stok').val(stok);

                // Menampilkan gambar saat ini di modal
                if (foto) {
                    $('#currentImage').attr('src', '/storage/produk/' + foto);
                    $('#currentImageContainer').show();
                } else {
                    $('#currentImageContainer').hide();
                }

                $('#editProdukModal').modal('show');
            });

            // Fungsi cari produk
            $('#searchInput').on('input', function () {
                let input = $(this).val().toLowerCase();
                $('.hadiah-card').each(function () {
                    let title = $(this).find('.hadiah-title').text().toLowerCase();
                    let content = $(this).find('.hadiah-teks').text().toLowerCase();
                    if (title.includes(input) || content.includes(input)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>

</body>

</html>
