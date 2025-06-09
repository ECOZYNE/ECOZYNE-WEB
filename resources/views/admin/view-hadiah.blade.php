@extends('layouts.dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/css/styles-view-hadiah.css') }}" />
@endpush

@section('title', 'Data Hadiah')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-3">Data Hadiah</h5>

            <hr>
            <div class="mb-1">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari Hadiah...">
            </div>
            <hr>

            <!-- Display messages -->
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

            <!-- Hadiah Cards -->
            <div class="row" id="hadiahContainer">
                @forelse($hadiahList as $hadiah)
                    <div class="col-sm-6 col-xl-3 mb-4 hadiah-item" data-nama="{{ strtolower($hadiah->nama_hadiah) }}"
                        data-deskripsi="{{ strtolower($hadiah->deskripsi) }}">
                        <div class="card hadiah-card h-100 border-0 shadow-sm">
                            <div class="position-relative overflow-hidden">
                                @if($hadiah->foto && file_exists(public_path('storage/hadiah/' . $hadiah->foto)))
                                    <img src="{{ asset('storage/hadiah/' . $hadiah->foto) }}" class="hadiah-img"
                                        alt="{{ $hadiah->nama_hadiah }}" loading="lazy">
                                @else
                                    <div class="hadiah-img bg-light d-flex align-items-center justify-content-center">
                                        <i class="fas fa-image text-muted fa-3x"></i>
                                    </div>
                                @endif

                                <!-- Stock status badge -->
                                @if($hadiah->stok <= 0)
                                    <span class="position-absolute top-0 end-0 m-2 badge bg-danger">Habis</span>
                                @elseif($hadiah->stok <= 5)
                                    <span class="position-absolute top-0 end-0 m-2 badge bg-warning">Stok Sedikit</span>
                                @endif
                            </div>

                            <div class="card-body d-flex flex-column p-3">
                                <h5 class="fw-bold mb-2">{{ $hadiah->nama_hadiah }}</h5>

                                <div class="mb-2">
                                    <small class="text-muted d-block">
                                        <i class="fa-solid fa-box" style="color: #675b1e;"></i> Stok:
                                        <span
                                            class="fw-semibold {{ $hadiah->stok <= 0 ? 'text-danger' : ($hadiah->stok <= 5 ? 'text-warning' : 'text-success') }}">
                                            {{ $hadiah->stok }}
                                        </span>
                                    </small>
                                    <small class="text-muted d-block">
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i> Poin:
                                        <span class="fw-semibold text-info">{{ number_format($hadiah->point_satuan) }}</span>
                                    </small>
                                </div>

                                <p class="hadiah-deskripsi text-muted small mb-3 flex-grow-1">
                                    {{ $hadiah->deskripsi }}
                                </p>

                                <div class="d-flex gap-2 mt-auto">
                                    <a href="" class="btn btn-warning btn-action flex-fill">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>

                                    <button type="button" class="btn btn-danger btn-action flex-fill delete-btn"
                                        data-id="{{ $hadiah->id }}" data-nama="{{ $hadiah->nama_hadiah }}">
                                        <i class="fas fa-trash me-1"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="no-results">
                            <i class="fas fa-gift fa-4x mb-3 text-muted"></i>
                            <h5 class="text-muted">Belum ada data hadiah</h5>
                            <p class="text-muted">Silakan tambah hadiah baru untuk memulai.</p>
                            <a href="{{ route('hadiah.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i> Tambah Hadiah Pertama
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- No search results -->
            <div id="noResults" class="no-results" style="display: none;">
                <i class="fas fa-search fa-4x mb-3 text-muted"></i>
                <h5 class="text-muted">Tidak ada hasil ditemukan</h5>
                <p class="text-muted">Coba gunakan kata kunci yang berbeda.</p>
            </div>

            <!-- Delete forms (hidden) -->
            @foreach($hadiahList as $hadiah)
                <form id="delete-form-{{ $hadiah->id }}" action="" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            @endforeach
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            const searchInput = $('#searchInput');
            const hadiahItems = $('.hadiah-item');
            const noResults = $('#noResults');
            const filteredCount = $('#filteredCount');
            const filteredNum = $('#filteredNum');
            const totalItems = hadiahItems.length;

            // Search functionality
            searchInput.on('input', function () {
                const query = $(this).val().toLowerCase().trim();
                let visibleCount = 0;

                hadiahItems.each(function () {
                    const nama = $(this).data('nama');
                    const deskripsi = $(this).data('deskripsi');
                    const isMatch = nama.includes(query) || deskripsi.includes(query);

                    $(this).toggle(isMatch);
                    if (isMatch) visibleCount++;
                });

                // Update UI based on search results
                if (query === '') {
                    filteredCount.hide();
                    noResults.hide();
                } else {
                    if (visibleCount === 0) {
                        noResults.show();
                        filteredCount.hide();
                    } else {
                        noResults.hide();
                        filteredCount.show();
                        filteredNum.text(visibleCount);
                    }
                }
            });

            // Delete functionality
            $('.delete-btn').on('click', function () {
                const id = $(this).data('id');
                const nama = $(this).data('nama');

                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    text: `Yakin ingin menghapus hadiah "${nama}"?`,
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

                        // Submit form
                        document.getElementById(`delete-form-${id}`).submit();
                    }
                });
            });

            // Auto-hide alerts after 5 seconds
            setTimeout(function () {
                $('.alert').fadeOut('slow');
            }, 5000);

            // Add tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();
        });
    </script>
@endpush