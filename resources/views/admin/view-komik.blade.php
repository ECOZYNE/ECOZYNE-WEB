@extends('layouts.dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/css/styles-view-komik.css') }}" />
@endpush

@section('title', 'Data Komik')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-2">Data Komik</h5>

            <hr>
            <div class="mb-1">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari Komik...">
            </div>
            <hr>

            <div class="row" id="komikContainer">
                @foreach($komiks as $komik)
                    <div class="col-sm-6 col-xl-3 mt-4 komik-card">
                        <div class="card overflow-hidden rounded-2 h-100">
                            <div class="position-relative">
                                <a href="{{ asset('storage/komik/' . $komik->file_pdf) }}" target="_blank">
                                    @if($komik->cover)
                                        <img src="{{ asset('storage/komik-cover/' . $komik->cover) }}" 
                                             class="card-img-top rounded-0 img-fluid" 
                                             alt="{{ $komik->judul }}"
                                             style="height: 200px; object-fit: cover;">
                                    @else
                                        <div class="card-img-top rounded-0 d-flex align-items-center justify-content-center bg-light" style="height: 200px;">
                                            <i class="fas fa-file-pdf fa-5x text-danger"></i>
                                        </div>
                                    @endif
                                </a>
                            </div>
                            <div class="card-body pt-3 p-4 d-flex flex-column">
                                <h6 class="fw-semibold fs-4 komik-title">{{ $komik->judul }}</h6>
                                <p class="text-muted komik-penulis"><i class="fas fa-user"></i> {{ $komik->penulis }}</p>
                                <p class="text-muted komik-halaman"><i class="fas fa-book"></i> {{ $komik->jml_halaman }} Halaman</p>
                                <p class="text-muted komik-date"><i class="fas fa-calendar"></i> {{ $komik->created_at->format('d M Y') }}</p>

                                <div class="d-flex gap-2 mt-auto">
                                    <!-- Tombol Edit -->
                                    <a href="javascript:void(0);" class="btn btn-warning w-50 edit-komik-btn"
                                        data-id="{{ $komik->id }}" 
                                        data-judul="{{ $komik->judul }}"
                                        data-penulis="{{ $komik->penulis }}" 
                                        data-halaman="{{ $komik->jml_halaman }}"
                                        data-cover="{{ $komik->cover }}"
                                        data-file="{{ $komik->file_pdf }}"
                                        data-url="{{ route('komik.update', $komik->id) }}">
                                        <i class="fas fa-pen"></i> Edit
                                    </a>

                                    <!-- Tombol Hapus dengan SweetAlert -->
                                    <button type="button" class="btn btn-danger w-50 delete-komik-btn" 
                                            data-id="{{ $komik->id }}"
                                            data-judul="{{ $komik->judul }}"
                                            data-url="{{ route('komik.destroy', $komik->id) }}">
                                        <i class="fa fa-trash"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

    <!-- Modal Edit Komik -->
    <div class="modal fade" id="editKomikModal" tabindex="-1" aria-labelledby="editKomikModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="editKomikForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editKomikModalLabel">Edit Komik</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit-id-komik">

                        <div class="mb-3">
                            <label for="edit-judul" class="form-label">Judul Komik</label>
                            <input type="text" name="judul" id="edit-judul" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-penulis" class="form-label">Penulis</label>
                            <input type="text" name="penulis" id="edit-penulis" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-jml-halaman" class="form-label">Jumlah Halaman</label>
                            <input type="number" name="jml_halaman" id="edit-jml-halaman" class="form-control" min="1" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-cover" class="form-label">Cover Komik</label>
                            <div id="currentCoverContainer" style="display:none;">
                                <img id="currentCoverImage" src="" alt="Cover Saat Ini" class="img-thumbnail mb-2" style="max-width: 150px; max-height: 150px;">
                            </div>
                            <input type="file" name="cover" id="edit-cover" class="form-control" accept=".jpg,.jpeg,.png">
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah cover. Format: JPG, JPEG, PNG. Maksimal 5MB</small>
                            <!-- Preview Cover Baru -->
                            <div id="newCoverPreview" class="mt-2" style="display:none;">
                                <img id="newCoverImage" src="" alt="Preview Cover Baru" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="edit-file-pdf" class="form-label">File PDF</label>
                            <div id="currentFileContainer" style="display:none;">
                                <p class="text-muted mb-2">
                                    <i class="fas fa-file-pdf text-danger"></i> 
                                    File saat ini: <span id="currentFileName"></span>
                                </p>
                            </div>
                            <input type="file" name="file_pdf" id="edit-file-pdf" class="form-control" accept=".pdf">
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah file. Maksimal 20MB</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Form Hidden untuk Delete -->
    <form id="deleteKomikForm" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            // Preview cover baru saat dipilih di modal edit
            $('#edit-cover').on('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#newCoverImage').attr('src', e.target.result);
                        $('#newCoverPreview').show();
                    };
                    reader.readAsDataURL(file);
                } else {
                    $('#newCoverPreview').hide();
                }
            });

            // Handle klik tombol edit
            $('.edit-komik-btn').click(function () {
                let id = $(this).data('id');
                let judul = $(this).data('judul');
                let penulis = $(this).data('penulis');
                let halaman = $(this).data('halaman');
                let cover = $(this).data('cover');
                let file = $(this).data('file');
                let url = $(this).data('url');

                $('#edit-id-komik').val(id);
                $('#edit-judul').val(judul);
                $('#edit-penulis').val(penulis);
                $('#edit-jml-halaman').val(halaman);
                $('#editKomikForm').attr('action', url);

                // Reset preview cover baru
                $('#newCoverPreview').hide();
                $('#edit-cover').val('');

                // Menampilkan cover saat ini di modal
                if (cover) {
                    $('#currentCoverImage').attr('src', '/storage/komik-cover/' + cover);
                    $('#currentCoverContainer').show();
                } else {
                    $('#currentCoverContainer').hide();
                }

                // Menampilkan nama file PDF saat ini di modal
                if (file) {
                    $('#currentFileName').text(file);
                    $('#currentFileContainer').show();
                } else {
                    $('#currentFileContainer').hide();
                }

                $('#editKomikModal').modal('show');
            });

            // Submit form edit dengan AJAX
            $('#editKomikForm').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                let actionUrl = $(this).attr('action');

                // Show loading
                Swal.fire({
                    title: 'Menyimpan...',
                    html: 'Mohon tunggu, sistem sedang memproses...',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: actionUrl,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#editKomikModal').modal('hide');
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Komik berhasil diperbarui',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        let errorMessage = 'Terjadi kesalahan saat memperbarui komik';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        Swal.fire({
                            title: 'Gagal!',
                            text: errorMessage,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

            // Handle klik tombol hapus dengan SweetAlert
            $('.delete-komik-btn').click(function() {
                let id = $(this).data('id');
                let judul = $(this).data('judul');
                let url = $(this).data('url');

                Swal.fire({
                    title: 'Hapus Komik?',
                    html: `Apakah Anda yakin ingin menghapus komik <strong>"${judul}"</strong>?<br><small class="text-muted">Data yang dihapus tidak dapat dikembalikan.</small>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading
                        Swal.fire({
                            title: 'Menghapus...',
                            text: 'Mohon tunggu sebentar',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        // Submit form delete
                        let form = $('#deleteKomikForm');
                        form.attr('action', url);
                        
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: form.serialize(),
                            success: function(response) {
                                Swal.fire({
                                    title: 'Terhapus!',
                                    text: 'Komik berhasil dihapus',
                                    icon: 'success',
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function(xhr) {
                                let errorMessage = 'Terjadi kesalahan saat menghapus komik';
                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                    errorMessage = xhr.responseJSON.message;
                                }
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: errorMessage,
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    }
                });
            });

            // Fungsi cari komik
            $('#searchInput').on('input', function () {
                let input = $(this).val().toLowerCase();
                $('.komik-card').each(function () {
                    let title = $(this).find('.komik-title').text().toLowerCase();
                    let penulis = $(this).find('.komik-penulis').text().toLowerCase();
                    if (title.includes(input) || penulis.includes(input)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
@endpush