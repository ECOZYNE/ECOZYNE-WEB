<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ecozyne | Data Galeri</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/ecozyne.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/styles-view-artikel.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
</head>

<body>

    <x-loader />
    <x-sidebar-admin />

    <!-- Main wrapper -->
    <div class="body-wrapper">
        <x-nav-header-admin />

        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-3">Data Galeri</h5>
                    
                    <hr>
                    <div class="mb-1">
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari Artikel...">
                    </div>
                    <hr>

                    <!-- Kontainer Galeri -->
                    <div class="row" id="artikelContainer">
                        @foreach($galeris as $galeri)
                            <div class="col-sm-6 col-xl-3 mt-4 artikel-card">
                                <div class="card overflow-hidden rounded-2 h-100">
                                    <div class="position-relative">
                                        <img src="{{ asset('storage/galeri/' . $galeri->foto) }}"
                                            class="card-img-top rounded-0 img-fluid artikel-img" alt="Foto Galeri">
                                    </div>
                                    <div class="card-body pt-3 p-4 d-flex flex-column">
                                        <p class="text-muted galeri-date">{{ $galeri->created_at->format('d M Y') }}</p>
                                        <p class="text-muted galeri-deskripsi">{{ $galeri->deskripsi }}</p>

                                        <div class="d-flex gap-2 mt-auto">
                                            <!-- Tombol Edit -->
                                            <button class="btn btn-warning w-50 edit-galeri-btn"
                                                    data-id="{{ $galeri->id_galeri }}"
                                                    data-deskripsi="{{ $galeri->deskripsi }}"
                                                    data-foto="{{ $galeri->foto }}"
                                                    data-url="{{ route('galeri.update', $galeri->id_galeri) }}">
                                                <i class="fas fa-pen"></i> Edit
                                            </button>

                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('galeri.destroy', $galeri->id_galeri) }}"
                                                  method="POST" class="w-50"
                                                  onsubmit="return confirm('Yakin ingin menghapus galeri ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger w-100">
                                                    <i class="fa fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Galeri -->
    <div class="modal fade" id="modalTambahGaleri" tabindex="-1" aria-labelledby="modalTambahGaleriLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('galeri.post') }}" method="POST" enctype="multipart/form-data" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Galeri</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" name="foto" class="form-control" required accept=".jpg,.jpeg,.png">
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <input type="text" name="deskripsi" class="form-control" required maxlength="255">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Galeri -->
    <div class="modal fade" id="editGaleriModal" tabindex="-1" aria-labelledby="editGaleriModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editGaleriForm" method="POST" enctype="multipart/form-data" class="modal-content">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Galeri</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id-galeri">

                    <div class="mb-3">
                        <label for="edit-deskripsi" class="form-label">Deskripsi</label>
                        <input type="text" name="deskripsi" id="edit-deskripsi" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-foto" class="form-label">Foto Baru (opsional)</label>
                        <div id="currentGaleriImageContainer" style="display: none;">
                            <img id="currentGaleriImage" src="" alt="Foto Lama" class="img-fluid mb-2" style="max-width: 150px;">
                        </div>
                        <input type="file" name="foto" id="edit-foto" class="form-control" accept=".jpg,.jpeg,.png">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
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
                $('.artikel-card').each(function () {
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
