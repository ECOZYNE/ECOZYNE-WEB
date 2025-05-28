@extends('layouts.dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/css/styles-view-artikel.css') }}" />
@endpush

@section('title', 'Data Artikel')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-2">Data Artikel</h5>

            <hr>
            <div class="mb-1">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari Artikel...">
            </div>
            <hr>

            <div class="row" id="artikelContainer">
                @foreach($artikels as $artikel)
                    <div class="col-sm-6 col-xl-3 mt-4 artikel-card">
                        <div class="card overflow-hidden rounded-2 h-100">
                            <div class="position-relative">
                                <a href="{{ route('artikel.show', $artikel->id_artikel) }}">
                                    <img src="{{ asset('storage/artikel/' . $artikel->foto) }}"
                                        class="card-img-top rounded-0 img-fluid artikel-img" alt="{{ $artikel->judul }}">
                                </a>
                            </div>
                            <div class="card-body pt-3 p-4 d-flex flex-column">
                                <h6 class="fw-semibold fs-4 artikel-title">{{ $artikel->judul }}</h6>
                                <p class="text-muted artikel-date">{{ $artikel->created_at }}</p>
                                <p class="text-muted artikel-teks">{{ $artikel->isi }}</p>

                                <div class="d-flex gap-2 mt-auto">
                                    <!-- Tombol Edit dengan data- -->
                                    <!-- Tombol Edit rapi pakai icon fa kecil -->
                                    <a href="javascript:void(0);" class="btn btn-warning w-50 edit-artikel-btn"
                                        data-id="{{ $artikel->id_artikel }}" data-judul="{{ $artikel->judul }}"
                                        data-isi="{{ $artikel->isi }}" data-foto="{{ $artikel->foto }}"
                                        data-url="{{ route('artikel.update', $artikel->id_artikel) }}">
                                        <i class="fas fa-pen"></i> Edit
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('artikel.destroy', $artikel->id_artikel) }}" method="POST"
                                        class="w-50" onsubmit="return confirm('Yakin mau hapus artikel ini?')">
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

    <!-- Modal Edit Artikel -->
    <div class="modal fade" id="editArtikelModal" tabindex="-1" aria-labelledby="editArtikelModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="editArtikelForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editArtikelModalLabel">Edit Artikel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_artikel" id="edit-id-artikel">

                        <div class="mb-3">
                            <label for="edit-judul" class="form-label">Judul Artikel</label>
                            <input type="text" name="judul" id="edit-judul" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-foto" class="form-label">Foto Artikel</label>
                            <div id="currentImageContainer" style="display:none;">
                                <img id="currentImage" src="" alt="Gambar Artikel" class="img-fluid"
                                    style="max-width: 150px; max-height: 150px; margin-bottom: 10px;">
                            </div>
                            <input type="file" name="foto" id="edit-foto" class="form-control" accept=".jpg, .jpeg, .png">
                        </div>

                        <div class="mb-3">
                            <label for="edit-isi" class="form-label">Isi Artikel</label>
                            <textarea name="isi" id="edit-isi" rows="4" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Handle klik tombol edit
            $('.edit-artikel-btn').click(function () {
                let id = $(this).data('id');
                let judul = $(this).data('judul');
                let isi = $(this).data('isi');
                let foto = $(this).data('foto'); // Menambahkan data foto
                let url = $(this).data('url');

                $('#edit-id-artikel').val(id);
                $('#edit-judul').val(judul);
                $('#edit-isi').val(isi);
                $('#editArtikelForm').attr('action', url);

                // Menampilkan gambar saat ini di modal
                if (foto) {
                    $('#currentImage').attr('src', '/storage/artikel/' + foto);
                    $('#currentImageContainer').show();
                } else {
                    $('#currentImageContainer').hide();
                }

                $('#editArtikelModal').modal('show');
            });

            // Fungsi cari artikel
            $('#searchInput').on('input', function () {
                let input = $(this).val().toLowerCase();
                $('.artikel-card').each(function () {
                    let title = $(this).find('.artikel-title').text().toLowerCase();
                    let content = $(this).find('.artikel-teks').text().toLowerCase();
                    if (title.includes(input) || content.includes(input)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>

@endsection