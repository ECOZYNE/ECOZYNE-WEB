@extends('layouts.dashboard')

@push('style')
    {{-- Assuming you have styles for the product cards --}}
    <link rel="stylesheet" href="{{ asset('assets/css/styles-view-produk.css') }}" />
    {{-- Link to SweetAlert2 CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css">
@endpush

@section('title', 'Data Produk')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                 <h5 class="card-title fw-semibold m-0">Data Produk</h5>
                 <a href="{{ route('produk.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Tambah Produk
                </a>
            </div>

            <hr>
            <div class="mb-1">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari Produk berdasarkan nama atau deskripsi...">
            </div>
            <hr>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-1"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                                        <i class="fa-solid fa-dollar-sign" style="color: #074714;"></i> Harga:
                                        <span class="fw-semibold text-info">Rp. {{ number_format($item->harga, 0, ',', '.') }}</span>
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
                                        data-foto="{{ $item->foto }}">
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
                        <div class="no-results text-center py-5">
                            <i class="fas fa-box-open fa-4x mb-3 text-muted"></i>
                            <h5 class="text-muted">Belum ada data produk</h5>
                            <p class="text-muted">Silakan tambah produk baru untuk memulai.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Message for when search yields no results --}}
            <div id="noResults" class="no-results text-center py-5" style="display: none;">
                <i class="fas fa-search fa-4x mb-3 text-muted"></i>
                <h5 class="text-muted">Tidak ada hasil ditemukan</h5>
                <p class="text-muted">Coba gunakan kata kunci yang berbeda.</p>
            </div>
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
                        {{-- The product ID is not needed as it's in the form action --}}

                        <div class="mb-3">
                            <label for="edit-nama_produk" class="form-label">Nama Produk</label>
                            <input type="text" name="nama_produk" id="edit-nama_produk" class="form-control"
                                required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="edit-foto" class="form-label">Foto Produk</label>
                            <div id="currentImageContainer" class="mb-2" style="display:none;">
                                <p class="mb-1 small text-muted">Foto saat ini:</p>
                                <img id="currentImage" src="" alt="Gambar Produk" class="img-fluid rounded"
                                    style="max-height: 150px;">
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

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- Script for SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- LIVE SEARCH FUNCTIONALITY ---
            const searchInput = document.getElementById('searchInput');
            const produkContainer = document.getElementById('produkContainer');
            const produkItems = produkContainer.querySelectorAll('.produk-item');
            const noResults = document.getElementById('noResults');

            searchInput.addEventListener('input', function() {
                const searchTerm = searchInput.value.toLowerCase();
                let visibleCount = 0;

                produkItems.forEach(item => {
                    const nama = item.dataset.nama;
                    const deskripsi = item.dataset.deskripsi;

                    if (nama.includes(searchTerm) || deskripsi.includes(searchTerm)) {
                        item.style.display = '';
                        visibleCount++;
                    } else {
                        item.style.display = 'none';
                    }
                });

                noResults.style.display = visibleCount === 0 ? '' : 'none';
            });


            // --- EDIT MODAL FUNCTIONALITY ---
            const editModal = new bootstrap.Modal(document.getElementById('editProdukModal'));
            const editForm = document.getElementById('editProdukForm');
            const editButtons = document.querySelectorAll('.edit-produk-btn');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const data = this.dataset;

                    // 1. Set form action URL dynamically
                    let actionUrl = "{{ route('produk.update', ':id') }}";
                    actionUrl = actionUrl.replace(':id', data.id);
                    editForm.action = actionUrl;
                    
                    // 2. Populate form fields
                    document.getElementById('edit-nama_produk').value = data.nama_produk;
                    document.getElementById('edit-deskripsi').value = data.deskripsi;
                    document.getElementById('edit-harga').value = data.harga;
                    document.getElementById('edit-stok').value = data.stok;

                    // 3. Handle current image preview
                    const currentImage = document.getElementById('currentImage');
                    const currentImageContainer = document.getElementById('currentImageContainer');
                    if (data.foto) {
                        currentImage.src = `{{ asset('storage/produk') }}/${data.foto}`;
                        currentImageContainer.style.display = 'block';
                    } else {
                        currentImageContainer.style.display = 'none';
                    }
                    
                    // 4. Show the modal
                    editModal.show();
                });
            });


            // --- DELETE FUNCTIONALITY ---
            const deleteButtons = document.querySelectorAll('.delete-produk-btn');
            
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const id = this.dataset.id;
                    const name = this.dataset.nama;
                    let deleteUrl = "{{ route('produk.destroy', ':id') }}";
                    deleteUrl = deleteUrl.replace(':id', id);

                    Swal.fire({
                        title: `Yakin ingin menghapus?`,
                        html: `Produk "<b>${name}</b>" akan dihapus secara permanen.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Create a form to submit the DELETE request
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = deleteUrl;
                            form.innerHTML = `
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="DELETE">
                            `;
                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endpush