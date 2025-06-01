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
                <input type="text" id="searchHadiahInput" class="form-control" placeholder="Cari hadiah...">
            </div>
            <hr>

            <div class="row" id="hadiahContainer">
               @foreach($hadiahs as $hadiah)
                    <div class="col-sm-6 col-xl-3 mt-4 hadiah-card">
                        <div class="card overflow-hidden rounded-2 h-100">
                            <div class="position-relative">
                                <img src="{{ asset('storage/hadiah/' . $hadiah->foto) }}"
                                    class="card-img-top rounded-0 img-fluid hadiah-img" alt="{{ $hadiah->nama_hadiah }}">
                            </div>
                            <div class="card-body pt-3 p-4 d-flex flex-column">
                                <h6 class="fw-semibold fs-4 hadiah-title">{{ $hadiah->nama_hadiah }}</h6>
                                <p class="text-muted hadiah-deskripsi">{{ $hadiah->deskripsi }}</p>
                                <p class="text-muted hadiah-stok">Stok: {{ $hadiah->stok }}</p>
                                <p class="text-muted hadiah-point">Point: {{ $hadiah->point_satuan }}</p>

                                <div class="d-flex gap-2 mt-auto">
                                    <a href="javascript:void(0);" class="btn btn-warning w-50 edit-hadiah-btn"
                                        data-id="{{ $hadiah->id }}" data-nama_hadiah="{{ $hadiah->nama_hadiah }}"
                                        data-deskripsi="{{ $hadiah->deskripsi }}" data-stok="{{ $hadiah->stok }}"
                                        data-point_satuan="{{ $hadiah->point_satuan }}" data-foto="{{ $hadiah->foto }}"
                                        data-url="{{ route('hadiah.update', $hadiah->id) }}">
                                        <i class="fas fa-pen"></i> Edit
                                    </a>

                                    <form action="{{ route('hadiah.destroy', $hadiah->id) }}" method="POST" class="w-50"
                                        onsubmit="return confirm('Yakin mau hapus hadiah ini?')">
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
                            <label for="edit-nama-hadiah" class="form-label">Nama Hadiah</label>
                            <input type="text" name="nama_hadiah" id="edit-nama-hadiah" class="form-control" required>
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

                        <div class="mb-3">
                            <label for="edit-stok" class="form-label">Stok</label>
                            <input type="number" name="stok" id="edit-stok" class="form-control" required min="0">
                        </div>

                        <div class="mb-3">
                            <label for="edit-point_satuan" class="form-label">Point Satuan</label>
                            <input type="number" name="point_satuan" id="edit-point_satuan" class="form-control" required
                                min="0">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            // Handle klik tombol edit
            $('.edit-hadiah-btn').click(function () {
                let id = $(this).data('id');
                let nama_hadiah = $(this).data('nama_hadiah');
                let deskripsi = $(this).data('deskripsi');
                let stok = $(this).data('stok');
                let point_satuan = $(this).data('point_satuan');
                let foto = $(this).data('foto');
                let url = $(this).data('url');

                $('#edit-id-hadiah').val(id);
                $('#edit-nama-hadiah').val(nama_hadiah);
                $('#edit-deskripsi').val(deskripsi);
                $('#edit-stok').val(stok);
                $('#edit-point_satuan').val(point_satuan);
                $('#editHadiahForm').attr('action', url);

                // Menampilkan gambar saat ini di modal jika ada
                if (foto) {
                    $('#currentImage').attr('src', '/storage/hadiah/' + foto);
                    $('#currentImageContainer').show();
                } else {
                    $('#currentImageContainer').hide();
                }

                $('#editHadiahModal').modal('show');
            });

            // Fungsi cari hadiah
            $('#searchHadiahInput').on('input', function () {
                let input = $(this).val().toLowerCase();
                $('.hadiah-card').each(function () {
                    let title = $(this).find('.hadiah-title').text().toLowerCase();
                    let description = $(this).find('.hadiah-deskripsi').text().toLowerCase();
                    if (title.includes(input) || description.includes(input)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
@endpush