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
                                        <i class="fa-solid fa-dollar" style="color: #074714;"></i> Harga:
                                        <span class="fw-semibold text-info">Rp. {{ number_format($item->harga) }}</span>
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
                                        data-harga="{{ $item->harga }}"> {{-- Add harga to data --}}
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
                                <label for="edit-harga" class="form-label">Harga Produk</label>
                                <input type="number" name="harga" id="edit-harga" class="form-control" required>
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
       function updateStatus(url, status) {
        Swal.fire({
            title: `Yakin ingin ubah status ke "${status}"?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then(result => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PUT',
                        status: status
                    },
                    success: () => location.reload(), // Reload to update counts and table
                    error: () => Swal.fire('Gagal', 'Terjadi kesalahan', 'error')
                });
            }
        });
    }

    const timelineItems = document.querySelectorAll('.timeline-item');
    const timelineLines = document.querySelectorAll('.timeline-line');
    const tabItems = document.querySelectorAll('#statusTabs .nav-link');
    const pesananBody = document.getElementById('pesananBody ');
    const searchInput = document.getElementById('searchInput');

    // Function to update timeline active/completed states
    function updateTimeline(currentStatus) {
        // Only update timeline if it's visible (large screens)
        if (window.innerWidth >= 992) {
            // Remove all active and completed classes first
            timelineItems.forEach(item => {
                item.classList.remove('active', 'completed');
                item.querySelector('.timeline-circle').classList.remove('active', 'completed');
                item.querySelector('.timeline-label').classList.remove('active', 'completed');
            });
            timelineLines.forEach(line => {
                line.classList.remove('active', 'completed');
            });

            const statusOrder = ['diterima', 'dikemas', 'dikirim', 'selesai'];

            let currentStatusIndex = statusOrder.indexOf(currentStatus);

            timelineItems.forEach((item, index) => {
                const itemStatus = item.getAttribute('data-status');
                const itemStatusIndex = statusOrder.indexOf(itemStatus);

                if (itemStatus === currentStatus) {
                    item.classList.add('active');
                    item.querySelector('.timeline-circle').classList.add('active');
                    item.querySelector('.timeline-label').classList.add('active');
                } else if (itemStatusIndex < currentStatusIndex) {
                    item.classList.add('completed');
                    item.querySelector('.timeline-circle').classList.add('completed');
                    item.querySelector('.timeline-label').classList.add('completed');
                }

                if (index < timelineLines.length) {
                    if (itemStatusIndex < currentStatusIndex) {
                        timelineLines[index].classList.add('completed');
                    } else if (itemStatusIndex === currentStatusIndex && currentStatusIndex < statusOrder.length - 1) {
                        timelineLines[index].classList.add('active');
                    }
                }
            });
        }
    }

    // Function to update tab active states
    function updateTabs(currentStatus) {
        // Only update tabs if they are visible (small screens)
        if (window.innerWidth < 992) {
            tabItems.forEach(tab => {
                tab.classList.remove('active');
            });
            const activeTab = document.querySelector(`#statusTabs .nav-link[data-status="${currentStatus}"]`);
            if (activeTab) {
                activeTab.classList.add('active');
            }
        }
    }

    // Function to filter table rows and then update the navigation (timeline or tabs)
    function filterTableAndNavigation(selectedStatus = null, searchTerm = '') {
        const rows = pesananBody.querySelectorAll('tr[data-status]');
        let visibleCount = 0;
        let rowNumber = 1; // Initialize row number for visible rows

        // Initialize counts for each status
        const statusCounts = {
            'diterima': 0,
            'dikemas': 0,
            'dikirim': 0,
            'selesai': 0
        };

        let hasNonSelesaiInFilteredRows = false; // New flag to determine if 'Aksi' column should be shown

        rows.forEach(row => {
            const rowStatus = row.getAttribute('data-status');
            const rowText = row.textContent.toLowerCase();

            const matchesStatus = (selectedStatus === null || selectedStatus === '' || rowStatus === selectedStatus);
            const matchesSearch = searchTerm === '' || rowText.includes(searchTerm.toLowerCase()); // Corrected search logic

            const show = matchesStatus && matchesSearch;
            row.style.display = show ? '' : 'none';

            if (show) {
                // Update the "No" column for visible rows
                row.querySelector('.row-number').textContent = rowNumber++;
                visibleCount++;
                if (rowStatus !== 'selesai') {
                    hasNonSelesaiInFilteredRows = true;
                }
            }

            // Always count for updating badges, regardless of current filter
            if (statusCounts.hasOwnProperty(rowStatus)) {
                statusCounts[rowStatus]++;
            }
        });

        // Update the "No data" message
        document.querySelector('.no-data-message').style.display = visibleCount ? 'none' : '';

        // Update counts on timeline circles
        document.getElementById('diterimaCount').textContent = statusCounts['diterima'];
        document.getElementById('dikemasCount').textContent = statusCounts['dikemas'];
        document.getElementById('dikirimCount').textContent = statusCounts['dikirim'];
        document.getElementById('selesaiCount').textContent = statusCounts['selesai'];

        // Update counts on tab links
        document.getElementById('diterimaTabCount').textContent = statusCounts['diterima'];
        document.getElementById('dikemasTabCount').textContent = statusCounts['dikemas'];
        document.getElementById('dikirimTabCount').textContent = statusCounts['dikirim'];
        document.getElementById('selesaiTabCount').textContent = statusCounts['selesai'];

        // Dynamically adjust 'Aksi' header visibility
        const actionHeader = document.querySelector('#dataTable thead th:last-child');
        if (actionHeader && actionHeader.textContent.trim() === 'Aksi') { // Ensure it's the Aksi header
             if (hasNonSelesaiInFilteredRows || selectedStatus === 'diterima' || selectedStatus === 'dikemas' || selectedStatus === 'dikirim') {
                actionHeader.style.display = '';
            } else {
                actionHeader.style.display = 'none';
            }
        }


        // Update navigation based on the explicitly selected status
        updateTimeline(selectedStatus);
        updateTabs(selectedStatus);
    }

    // Initial load: determine default filter and update navigation
    document.addEventListener('DOMContentLoaded', () => {
        let defaultStatus = 'diterima'; // Default status to show initially

        filterTableAndNavigation(defaultStatus); // Call with default status to populate counts and filter

        // Set initial active state for the correct navigation type AFTER filtering
        if (window.innerWidth >= 992) {
            // Large screen: activate 'diterima' on timeline
            const initialTimelineItem = document.querySelector(`.timeline-item[data-status="${defaultStatus}"]`);
            if (initialTimelineItem) {
                initialTimelineItem.classList.add('active');
                initialTimelineItem.querySelector('.timeline-circle').classList.add('active');
                initialTimelineItem.querySelector('.timeline-label').classList.add('active');
            }
        } else {
            // Small screen: activate 'diterima' tab
            const initialTab = document.querySelector(`#statusTabs .nav-link[data-status="${defaultStatus}"]`);
            if (initialTab) {
                initialTab.classList.add('active');
            }
        }
    });

    // Timeline item click event listener (for large screens)
    timelineItems.forEach(item => {
        item.addEventListener('click', function() {
            const statusToFilter = this.getAttribute('data-status');
            filterTableAndNavigation(statusToFilter, searchInput.value);
        });
    });

    // Tab item click event listener (for small screens)
    tabItems.forEach(tab => {
        tab.addEventListener('click', function() {
            const statusToFilter = this.getAttribute('data-status');
            filterTableAndNavigation(statusToFilter, searchInput.value);
        });
    });

    // Search input event listener
    searchInput.addEventListener('input', function() {
        let currentStatusFilter = '';
        if (window.innerWidth >= 992) {
            const activeTimelineItem = document.querySelector('.timeline-item.active');
            currentStatusFilter = activeTimelineItem ? activeTimelineItem.getAttribute('data-status') : 'diterima';
        } else {
            const activeTab = document.querySelector('#statusTabs .nav-link.active');
            currentStatusFilter = activeTab ? activeTab.getAttribute('data-status') : 'diterima';
        }
        filterTableAndNavigation(currentStatusFilter, this.value);
    });

    // Handle window resize to adjust navigation
    window.addEventListener('resize', () => {
        // Re-apply filter based on currently active status (or default)
        // This ensures the correct navigation type (timeline or tabs) is active after resize
        let currentStatusFilter = '';
        if (window.innerWidth >= 992) {
            const activeTimelineItem = document.querySelector('.timeline-item.active');
            currentStatusFilter = activeTimelineItem ? activeTimelineItem.getAttribute('data-status') : 'diterima';
        } else {
            const activeTab = document.querySelector('#statusTabs .nav-link.active');
            currentStatusFilter = activeTab ? activeTab.getAttribute('data-status') : 'diterima';
        }
        filterTableAndNavigation(currentStatusFilter, searchInput.value);
    });
    </script>
@endpush