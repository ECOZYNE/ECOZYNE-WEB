@extends('layouts.dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/css/styles-view-produk.css') }}" />
@endpush

@section('title', 'Data Produk')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-3">Data Produk</h5>

            <hr>
            <div class="mb-1">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari Produk...">
            </div>
            <hr>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-1"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row" id="produkContainer">
                @forelse($produk as $item)
                    <div class="col-sm-6 col-xl-3 mb-4 produk-item" data-nama="{{ strtolower($item->nama_produk) }}"
                        data-deskripsi="{{ strtolower($item->deskripsi) }}">
                        <div class="card produk-card h-100 border-0 shadow-sm">
                            <div class="position-relative overflow-hidden">
                                @if ($item->foto && file_exists(public_path('storage/produk/' . $item->foto)))
                                    <img src="{{ asset('storage/produk/' . $item->foto) }}" class="produk-img"
                                        alt="{{ $item->nama_produk }}" loading="lazy">
                                @else
                                    <div class="produk-img bg-light d-flex align-items-center justify-content-center">
                                        <i class="fas fa-image text-muted fa-3x"></i>
                                    </div>
                                @endif
                                {{-- No stock badges for produk based on image example, but you can add if needed --}}
                            </div>

                            <div class="card-body d-flex flex-column p-3">
                                <h5 class="fw-bold mb-2">{{ $item->nama_produk }}</h5>

                                <div class="mb-2">
                                    <small class="text-muted d-block">
                                        <i class="fa-solid fa-box" style="color: #675b1e;"></i> Stok:
                                        <span
                                            class="fw-semibold {{ $item->stok <= 0 ? 'text-danger' : ($item->stok <= 5 ? 'text-warning' : 'text-success') }}">
                                            {{ $item->stok }}
                                        </span>
                                    </small>
                                    <small class="text-muted d-block">
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i> Poin:
                                        <span class="fw-semibold text-info">{{ number_format($item->point_satuan) }}</span>
                                    </small>
                                </div>

                                <p class="produk-deskripsi text-muted small mb-3 flex-grow-1">
                                    {{ Str::limit($item->deskripsi, 50) }}
                                </p>

                                <div class="d-flex gap-2 mt-auto">
                                    <button class="btn btn-warning btn-action flex-fill edit-produk-btn"
                                        data-id="{{ $item->id_produk }}"
                                        data-nama_produk="{{ $item->nama_produk }}"
                                        data-deskripsi="{{ $item->deskripsi }}"
                                        data-harga="{{ $item->harga }}"
                                        data-stok="{{ $item->stok }}"
                                        data-foto="{{ $item->foto }}"
                                        data-point_satuan="{{ $item->point_satuan }}"> {{-- Add point_satuan to data --}}
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </button>

                                    <button type="button" class="btn btn-danger btn-action flex-fill delete-produk-btn"
                                        data-id="{{ $item->id_produk }}" data-nama="{{ $item->nama_produk }}">
                                        <i class="fas fa-trash me-1"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="no-results">
                            <i class="fas fa-box fa-4x mb-3 text-muted"></i>
                            <h5 class="text-muted">Belum ada data produk</h5>
                            <p class="text-muted">Silakan tambah produk baru untuk memulai.</p>
                            <a href="{{ route('produk.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i> Tambah Produk Pertama
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <div id="noResults" class="no-results" style="display: none;">
                <i class="fas fa-search fa-4x mb-3 text-muted"></i>
                <h5 class="text-muted">Tidak ada hasil ditemukan</h5>
                <p class="text-muted">Coba gunakan kata kunci yang berbeda.</p>
            </div>
        </div>

        {{-- Edit Produk Modal --}}
        <div class="modal fade" id="editProdukModal" tabindex="-1" aria-labelledby="editProdukModalLabel"
            aria-hidden="true">
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
                                <label for="edit-nama_produk" class="form-label">Nama Produk</label>
                                <input type="text" name="nama_produk" id="edit-nama_produk" class="form-control"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="edit-foto" class="form-label">Foto Produk</label>
                                <div id="currentImageContainer" style="display:none;">
                                    <img id="currentImage" src="" alt="Gambar Produk" class="img-fluid"
                                        style="max-width: 150px; max-height: 150px; margin-bottom: 10px;">
                                </div>
                                <input type="file" name="foto" id="edit-foto" class="form-control"
                                    accept=".jpg, .jpeg, .png">
                                <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
                            </div>

                            <div class="mb-3">
                                <label for="edit-deskripsi" class="form-label">Deskripsi Produk</label>
                                <textarea name="deskripsi" id="edit-deskripsi" rows="4" class="form-control"
                                    required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="edit-harga" class="form-label">Harga Produk</label>
                                <input type="number" name="harga" id="edit-harga" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="edit-stok" class="form-label">Stok Produk</label>
                                <input type="number" name="stok" id="edit-stok" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="edit-point_satuan" class="form-label">Poin Produk</label>
                                <input type="number" name="point_satuan" id="edit-point_satuan" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            // Event delegation untuk tombol edit
            $(document).on('click', '.edit-produk-btn', function() {
                let id = $(this).data('id');
                let nama_produk = $(this).data('nama_produk');
                let deskripsi = $(this).data('deskripsi');
                let harga = $(this).data('harga');
                let stok = $(this).data('stok');
                let foto = $(this).data('foto'); // Ini adalah nama file gambar
                let point_satuan = $(this).data('point_satuan');

                $('#edit-id-produk').val(id);
                $('#edit-nama_produk').val(nama_produk);
                $('#edit-deskripsi').val(deskripsi);
                $('#edit-harga').val(harga);
                $('#edit-stok').val(stok);
                $('#edit-point_satuan').val(point_satuan); // Populate point_satuan in modal

                // Menampilkan gambar saat ini di modal
                if (foto) {
                    $('#currentImage').attr('src', '{{ asset('storage/produk') }}/' + foto);
                    $('#currentImageContainer').show();
                } else {
                    $('#currentImageContainer').hide();
                    $('#currentImage').attr('src', ''); // Kosongkan src jika tidak ada foto
                }

                // Set action form untuk update
                $('#editProdukForm').attr('action', '/produk/' + id); // Sesuaikan dengan route update Anda

                $('#editProdukModal').modal('show');
            });

            // Handle submit form edit (menggunakan AJAX)
            $('#editProdukForm').submit(function(e) {
                e.preventDefault(); // Mencegah form submit default
                let form = $(this);
                let url = form.attr('action');
                let formData = new FormData(form[0]); // Menggunakan FormData untuk handle file upload

                $.ajax({
                    url: url,
                    type: 'POST', // Method PUT disimulasikan dengan POST dan @method('PUT')
                    data: formData,
                    processData: false, // Penting untuk FormData
                    contentType: false, // Penting untuk FormData
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                $('#editProdukModal').modal('hide');
                                location.reload(); // Reload halaman untuk melihat perubahan
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = '';
                        for (let key in errors) {
                            errorMessage += errors[key][0] + '\n';
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Validasi Gagal!',
                            text: errorMessage
                        });
                    }
                });
            });

            // Event delegation untuk tombol hapus
            $(document).on('click', '.delete-produk-btn', function() {
                let id = $(this).data('id');
                let nama_produk = $(this).data('nama'); // Get the product name for confirmation

                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    text: `Yakin ingin menghapus produk "${nama_produk}"?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading
                        Swal.fire({
                            title: 'Menghapus...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        $.ajax({
                            url: '/produk/' + id, // Sesuaikan dengan route delete Anda
                            type: 'POST', // Method DELETE disimulasikan dengan POST dan @method('DELETE')
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'DELETE'
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire(
                                        'Dihapus!',
                                        'Produk berhasil dihapus.',
                                        'success'
                                    ).then(() => {
                                        location.reload(); // Reload halaman untuk melihat perubahan
                                    });
                                } else {
                                    Swal.fire(
                                        'Gagal!',
                                        response.message,
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Error!',
                                    'Terjadi kesalahan saat menghapus produk.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });

            // Fungsi cari produk
            $('#searchInput').on('input', function() {
                const query = $(this).val().toLowerCase().trim();
                let visibleCount = 0;

                $('.produk-item').each(function() {
                    const nama = $(this).data('nama');
                    const deskripsi = $(this).data('deskripsi');
                    const isMatch = nama.includes(query) || deskripsi.includes(query);

                    $(this).toggle(isMatch);
                    if (isMatch) visibleCount++;
                });

                if (query === '') {
                    $('#noResults').hide();
                } else {
                    if (visibleCount === 0) {
                        $('#noResults').show();
                    } else {
                        $('#noResults').hide();
                    }
                }
            });

            // Auto-hide alerts after 5 seconds
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);

            // Add tooltips (if any are added later)
            $('[data-bs-toggle="tooltip"]').tooltip();
        });
    </script>
@endpush