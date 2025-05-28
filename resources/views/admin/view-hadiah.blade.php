@extends('layouts.dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/css/styles-view-hadiah.css') }}" />
@endpush

@section('title', 'Beranda Pengguna')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-2">Data Hadiah</h5>

            <hr>
            <div class="mb-1">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari Hadiah...">
            </div>
            <hr>

            <div class="row" id="hadiahContainer">

            </div>

        </div>
    </div>

    <!-- Modal Edit Hadiah -->
    <div class="modal fade" id="editHadiahModal" tabindex="-1" aria-labelledby="editHadiahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="editHadiahForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editHadiahModalLabel">Edit Hadiah</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_hadiah" id="edit-id-hadiah">

                        <div class="mb-3">
                            <label for="edit-judul" class="form-label">Judul Hadiah</label>
                            <input type="text" name="judul" id="edit-judul" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-foto" class="form-label">Foto Hadiah</label>
                            <div id="currentImageContainer" style="display:none;">
                                <img id="currentImage" src="" alt="Gambar Hadiah" class="img-fluid"
                                    style="max-width: 150px; max-height: 150px; margin-bottom: 10px;">
                            </div>
                            <input type="file" name="foto" id="edit-foto" class="form-control" accept=".jpg, .jpeg, .png">
                        </div>

                        <div class="mb-3">
                            <label for="edit-deskripsi" class="form-label">Deskripsi Hadiah</label>
                            <textarea name="deskripsi" id="edit-deskripsi" rows="4" class="form-control"
                                required></textarea>
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
            $('.edit-hadiah-btn').click(function () {
                let id = $(this).data('id');
                let judul = $(this).data('judul');
                let deskripsi = $(this).data('deskripsi');
                let foto = $(this).data('foto');
                let url = $(this).data('url');

                $('#edit-id-hadiah').val(id);
                $('#edit-judul').val(judul);
                $('#edit-deskripsi').val(deskripsi);
                $('#editHadiahForm').attr('action', url);

                // Menampilkan gambar saat ini di modal
                if (foto) {
                    $('#currentImage').attr('src', '/storage/hadiah/' + foto);
                    $('#currentImageContainer').show();
                } else {
                    $('#currentImageContainer').hide();
                }

                $('#editHadiahModal').modal('show');
            });

            // Fungsi cari hadiah
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

@endsection