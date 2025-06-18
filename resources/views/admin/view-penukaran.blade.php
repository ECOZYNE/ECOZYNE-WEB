@extends('layouts.dashboard')

@section('title', 'Penukaran Diterima')

@push('style')
        <link rel="stylesheet" href="{{ asset('assets/css/styles-view-penukaran.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/styles-tabel.css') }}" />
@endpush

@section('content')
<div class="col-lg-12 d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Data Penukaran Hadiah</h5>
            <hr>

            {{-- Timeline for large screens --}}
            <div class="timeline-container d-none d-lg-block">
                <div class="timeline-nav" id="timelineNav">
                    <div class="timeline-item" data-status="diterima">
                        <div class="timeline-circle">
                            <i class="bi bi-box-seam"></i>
                            <span class="count-badge" id="diterimaCount">0</span>
                        </div>
                        <div class="timeline-label">
                            Diterima
                            <div class="status-badge status-diterima">hadiah sedang disiapkan</div>
                        </div>
                    </div>

                    <div class="timeline-line"></div>

                    <div class="timeline-item" data-status="dikemas">
                        <div class="timeline-circle">
                            <i class="bi bi-archive"></i>
                            <span class="count-badge" id="dikemasCount">0</span>
                        </div>
                        <div class="timeline-label">
                            Dikemas
                            <div class="status-badge status-dikemas">hadiah sedang dikemas</div>
                        </div>
                    </div>

                    <div class="timeline-line"></div>

                    <div class="timeline-item" data-status="dikirim">
                        <div class="timeline-circle">
                            <i class="bi bi-truck"></i>
                            <span class="count-badge" id="dikirimCount">0</span>
                        </div>
                        <div class="timeline-label">
                            Dikirim
                            <div class="status-badge status-dikirim">Dalam Perjalanan</div>
                        </div>
                    </div>

                    <div class="timeline-line"></div>

                    <div class="timeline-item" data-status="selesai">
                        <div class="timeline-circle">
                            <i class="bi bi-check"></i>
                            <span class="count-badge" id="selesaiCount">0</span>
                        </div>
                        <div class="timeline-label">
                            Selesai
                            <div class="status-badge status-selesai">Pesanan sampai tujuan</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabs for small screens --}}
            <div class="mobile-tabs-container d-block d-lg-none">
                <ul class="nav nav-tabs mb-3" id="statusTabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-status="diterima">
                            Diterima <span class="count-badge" id="diterimaTabCount">0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-status="dikemas">
                            Dikemas <span class="count-badge" id="dikemasTabCount">0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-status="dikirim">
                            Dikirim <span class="count-badge" id="dikirimTabCount">0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-status="selesai">
                            Selesai <span class="count-badge" id="selesaiTabCount">0</span>
                        </a> {{-- Added Selesai tab --}}
                    </li>
                </ul>
            </div>

            <div class="mb-4">
                <input type="text" id="searchInput" class="form-control"
                    placeholder="Cari berdasarkan Nama Hadiah, Tanggal...">
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table text-nowrap align-middle" id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Hadiah</th>
                            <th>Detail Hadiah</th>
                            <th>Jumlah</th>
                            <th>Total Poin</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            {{-- Conditionally render 'Aksi' (Action) header --}}
                            @php
                                $hasNonSelesai = false;
                                foreach ($penukaran as $item) {
                                    if ($item->status_penukaran !== 'selesai') {
                                        $hasNonSelesai = true;
                                        break;
                                    }
                                }
                            @endphp

                            @if ($hasNonSelesai)
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody id="penukaranBody">
                        {{-- The rows will be dynamically numbered by JavaScript --}}
                        @forelse ($penukaran as $item)
                            @php
                                $status = $item->status_penukaran;
                                $transaksi = $item->transaksi->first();
                                $hadiah = $transaksi->hadiah ?? null;

                                $statusLabel = ucfirst($status);
                                $statusClass = match ($status) {
                                    'diterima' => 'bg-warning',
                                    'dikemas' => 'bg-primary',
                                    'dikirim' => 'bg-dark',
                                    'selesai' => 'bg-success',
                                    default => 'bg-secondary'
                                };
                                $statusIcon = match ($status) {
                                    'diterima' => 'bi-box',
                                    'dikemas' => 'bi-archive',
                                    'dikirim' => 'bi-truck',
                                    'selesai' => 'bi-check-circle',
                                    default => 'bi-question-circle'
                                };
                            @endphp
                            <tr data-status="{{ $status }}">
                                <td class="row-number"></td>
                                <td>{{ $item->komunitas->user->username ?? '-' }}</td>
                                <td style="white-space: normal;">
                                    <div>
                                        {{ $item->komunitas->alamat->alamat ?? '-' }},
                                        <br>{{ $item->komunitas->alamat->kelurahan->kelurahan ?? '-' }},
                                        <br>{{ $item->komunitas->alamat->kelurahan->kecamatan->kecamatan ?? '-' }},
                                        <br>{{ $item->komunitas->alamat->kode_pos ?? '-' }}
                                    </div>
                                </td>
                                <td>{{ $hadiah->nama_hadiah ?? '-' }}</td>
                                <td class="text-center">
                                    @if ($hadiah)
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#detailModal{{ $item->id_penukaran }}">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    @endif
                                </td>
                                <td>{{ $transaksi->jumlah ?? 0 }}</td>
                                <td>{{ ($transaksi->point_satuan ?? 0) * ($transaksi->jumlah ?? 0) }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y, H:i') }}</td>
                                <td>
                                    <span class="badge {{ $statusClass }}">
                                        {{ $statusLabel }} <i class="bi {{ $statusIcon }} ms-2"></i>
                                    </span>
                                </td>
                                {{-- Conditionally render 'Aksi' (Action) cell --}}
                                @if ($status !== 'selesai')
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown">Update Status</button>
                                            <ul class="dropdown-menu">
                                                @if ($status === 'diterima')
                                                    <li><button class="dropdown-item"
                                                                onclick="updateStatus('{{ route('admin.penukaran.updateStatus', $item->id_penukaran) }}', 'dikemas')">
                                                                <i class="bi bi-archive me-1"></i> Dikemas</button></li>
                                                @elseif ($status === 'dikemas')
                                                    <li><button class="dropdown-item"
                                                                onclick="updateStatus('{{ route('admin.penukaran.updateStatus', $item->id_penukaran) }}', 'dikirim')">
                                                                <i class="bi bi-truck me-1"></i> Dikirim</button></li>
                                                @elseif ($status === 'dikirim')
                                                    <li><button class="dropdown-item"
                                                                onclick="updateStatus('{{ route('admin.penukaran.updateStatus', $item->id_penukaran) }}', 'selesai')">
                                                                <i class="bi bi-check-circle me-1"></i> Selesai</button></li>
                                                @endif
                                            </ul>
                                        </div>
                                    </td>
                                @endif
                            </tr>

                            {{-- Modal --}}
                            @if ($hadiah)
                                <div class="modal fade" id="detailModal{{ $item->id_penukaran }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Detail Hadiah</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        @if ($hadiah->foto)
                                                            <img src="{{ asset('storage/hadiah/' . $hadiah->foto) }}"
                                                                class="img-fluid rounded" alt="Foto Hadiah">
                                                        @else
                                                            <p class="text-muted">Tidak ada foto hadiah</p>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-7">
                                                        <h5>{{ $hadiah->nama_hadiah }}</h5>
                                                        <p><strong>Deskripsi:</strong><br>{{ $hadiah->deskripsi ?? '-' }}</p>
                                                        <p><strong>Ditambah:</strong><br>
                                                            {{ \Carbon\Carbon::parse($hadiah->created_at)->translatedFormat('d F Y, H:i') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            {{-- This empty block is still useful for initial rendering if no data exists --}}
                        @endforelse

                        <tr class="no-data-message" style="display: none;">
                            <td colspan="10" class="text-center text-muted py-3">
                                Belum ada data penukaran hadiah yang harus diproses.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    const penukaranBody = document.getElementById('penukaranBody');
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
        const rows = penukaranBody.querySelectorAll('tr[data-status]');
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