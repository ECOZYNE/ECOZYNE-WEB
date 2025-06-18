@extends('layouts.dashboard')

@section('title', 'Penukaran Hadiah Saya')

@push('style')
{{-- No specific custom styles needed for the new tab menu,
    Bootstrap 5 classes will handle most of it.
    You can remove the old timeline-related CSS. --}}
@endpush

@section('content')
<div class="col-lg-12 d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">
                Penukaran Hadiah Saya
            </h5>
            <hr>

            {{-- New Tab-like Navigation --}}
            <ul class="nav nav-pills mb-4" id="statusTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="all-tab" data-bs-toggle="pill" data-bs-target="#all-content"
                        type="button" role="tab" aria-controls="all-content" aria-selected="true" data-status="">
                        Semua <span class="badge bg-secondary rounded-pill ms-1" id="count-all">0</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="menunggu-tab" data-bs-toggle="pill" data-bs-target="#menunggu-content"
                        type="button" role="tab" aria-controls="menunggu-content" aria-selected="false" data-status="menunggu">
                        Menunggu <span class="badge bg-warning rounded-pill ms-1" id="count-menunggu">0</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="diterima-tab" data-bs-toggle="pill" data-bs-target="#diterima-content"
                        type="button" role="tab" aria-controls="diterima-content" aria-selected="false" data-status="diterima">
                        Diterima <span class="badge bg-success rounded-pill ms-1" id="count-diterima">0</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="dikemas-tab" data-bs-toggle="pill" data-bs-target="#dikemas-content"
                        type="button" role="tab" aria-controls="dikemas-content" aria-selected="false" data-status="dikemas">
                        Dikemas <span class="badge bg-primary rounded-pill ms-1" id="count-dikemas">0</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="dikirim-tab" data-bs-toggle="pill" data-bs-target="#dikirim-content"
                        type="button" role="tab" aria-controls="dikirim-content" aria-selected="false" data-status="dikirim">
                        Dikirim <span class="badge bg-dark rounded-pill ms-1" id="count-dikirim">0</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="selesai-tab" data-bs-toggle="pill" data-bs-target="#selesai-content"
                        type="button" role="tab" aria-controls="selesai-content" aria-selected="false" data-status="selesai">Selesai</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="ditolak-tab" data-bs-toggle="pill" data-bs-target="#ditolak-content"
                        type="button" role="tab" aria-controls="ditolak-content" aria-selected="false" data-status="ditolak">Ditolak</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="dibatalkan-tab" data-bs-toggle="pill" data-bs-target="#dibatalkan-content"
                        type="button" role="tab" aria-controls="dibatalkan-content" aria-selected="false" data-status="dibatalkan">Dibatalkan</button>
                </li>
            </ul>
            {{-- End New Tab-like Navigation --}}

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
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th>No</th>
                            <th>Nama Hadiah</th>
                            <th>Jumlah</th>
                            <th>Total Poin</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Detail</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse ($penukaran as $item)
                            @foreach ($item->transaksi as $transaksi)
                                <tr data-status="{{ $item->status_penukaran }}">
                                    <td class="row-number"></td>
                                    <td>{{ $transaksi->hadiah->nama_hadiah ?? 'N/A' }}</td>
                                    <td>{{ $transaksi->jumlah }}</td>
                                    <td>{{ number_format($transaksi->point_satuan * $transaksi->jumlah) }} XP</td>
                                    <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <span class="badge bg-{{
                                            $item->status_penukaran === 'menunggu' ? 'warning' :
                                            ($item->status_penukaran === 'diterima' ? 'success' :
                                            ($item->status_penukaran === 'dikemas' ? 'primary' :
                                            ($item->status_penukaran === 'dikirim' ? 'dark' :
                                            ($item->status_penukaran === 'selesai' ? 'success' :
                                            ($item->status_penukaran === 'ditolak' ? 'danger' :
                                            ($item->status_penukaran === 'dibatalkan' ? 'secondary' : 'secondary'))))))
                                        }}">
                                            {{ ucfirst($item->status_penukaran) }}
                                            @if ($item->status_penukaran === 'menunggu')
                                                <i class="bi bi-hourglass-split ms-1"></i>
                                            @elseif ($item->status_penukaran === 'diterima')
                                                <i class="bi bi-check-circle ms-1"></i>
                                            @elseif ($item->status_penukaran === 'dikemas')
                                                <i class="bi bi-box-seam ms-1"></i>
                                            @elseif ($item->status_penukaran === 'dikirim')
                                                <i class="bi bi-truck ms-1"></i>
                                            @elseif ($item->status_penukaran === 'selesai')
                                                <i class="bi bi-check-all ms-1"></i>
                                            @elseif ($item->status_penukaran === 'ditolak')
                                                <i class="bi bi-x-circle ms-1"></i>
                                            @elseif ($item->status_penukaran === 'dibatalkan')
                                                <i class="bi bi-slash-circle ms-1"></i>
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                            data-bs-target="#detailModal-{{ $item->id_penukaran }}-{{ $transaksi->id_transaksi }}">
                                            <i class="ti ti-eye"></i>
                                        </button>
                                    </td>
                                    <td>
                                        @if ($item->status_penukaran === 'menunggu')
                                            <form id="form-batal-{{ $item->id_penukaran }}"
                                                action="{{ route('penukaran.batalkan', $item->id_penukaran) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                               <button type="button"
                                                       class="btn btn-sm btn-danger btn-konfirmasi-batal"
                                                       data-id="{{ $item->id_penukaran }}">
                                                       Batalkan <i class="ti ti-x ms-1"></i>
                                                   </button>
                                            </form>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>

                                <div class="modal fade"
                                    id="detailModal-{{ $item->id_penukaran }}-{{ $transaksi->id_transaksi }}"
                                    tabindex="-1"
                                    aria-labelledby="detailModalLabel-{{ $item->id_penukaran }}-{{ $transaksi->id_transaksi }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="detailModalLabel-{{ $item->id_penukaran }}-{{ $transaksi->id_transaksi }}">
                                                    Detail Penukaran Hadiah
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body row">
                                                <div class="col-md-5 text-center">
                                                    @if ($transaksi->hadiah && $transaksi->hadiah->foto)
                                                                <img src="{{ asset('storage/hadiah/' . $transaksi->hadiah->foto) }}"
                                                                    alt="Gambar Hadiah" class="img-fluid rounded">
                                                    @else
                                                                <img src="https://via.placeholder.com/300x300?text=No+Image"
                                                                    alt="No Image" class="img-fluid rounded">
                                                    @endif
                                                </div>
                                                <div class="col-md-7">
                                                    <p><strong>Nama Hadiah:</strong> {{ $transaksi->hadiah->nama_hadiah ?? '-' }}</p>
                                                    <p><strong>Deskripsi:</strong> {{ $transaksi->hadiah->deskripsi ?? '-' }}</p>
                                                    <p><strong>Jumlah:</strong> {{ $transaksi->jumlah }}</p>
                                                    <p><strong>Point Satuan:</strong> {{ number_format($transaksi->point_satuan) }} XP</p>
                                                    <p><strong>Total Point Dikeluarkan:</strong>
                                                        {{ number_format($transaksi->point_satuan * $transaksi->jumlah) }} XP
                                                    </p>
                                                    <p><strong>Status:</strong> {{ ucfirst($item->status_penukaran) }}</p>
                                                    <p><strong>Tanggal Penukaran:</strong>
                                                        {{ $item->created_at->format('d M Y H:i') }}</p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @empty
                            <tr class="no-data-row">
                                <td colspan="8" class="text-center py-4">
                                    <i class="bi bi-inbox fs-1 d-block mb-3 text-muted"></i>
                                    Belum ada data penukaran hadiah yang harus diproses.
                                </td>
                            </tr>
                        @endforelse
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
    document.addEventListener("DOMContentLoaded", function () {
        const statusButtons = document.querySelectorAll('#statusTab .nav-link');
        const searchInput = document.getElementById('searchInput');
        const tableBody = document.getElementById('tableBody');
        // Make sure this selector correctly targets the single "no data" row if it exists initially.
        // It's good practice to ensure this element is only present when the initial data is empty.
        const noDataRow = document.querySelector('.no-data-row'); 
        let selectedStatus = ""; // Default to show all items

        // Function to filter the table based on selected status and search keyword
        function filterTable() {
            const keyword = searchInput.value.toLowerCase();
            let visibleCount = 0;
            let rowNumber = 1;

            // Get all rows that are part of the actual data, excluding the no-data-row itself
            const rows = tableBody.querySelectorAll("tr[data-status]");
            const statusCounts = {
                "all": 0,
                "menunggu": 0,
                "diterima": 0,
                "dikemas": 0,
                "dikirim": 0,
                "selesai": 0,
                "ditolak": 0,
                "dibatalkan": 0
            };

            rows.forEach(row => {
                const rowText = row.innerText.toLowerCase();
                const rowStatus = row.getAttribute('data-status');

                // Update counts for all statuses
                statusCounts[rowStatus]++;
                statusCounts["all"]++; // Increment "Semua" count

                const matchSearch = rowText.includes(keyword);
                const matchStatus = selectedStatus === "" || rowStatus === selectedStatus;

                const show = matchSearch && matchStatus;
                row.style.display = show ? "" : "none";

                if (show) {
                    // Only assign a row number if the row is visible
                    const rowNumberElement = row.querySelector('.row-number');
                    if (rowNumberElement) {
                        rowNumberElement.textContent = rowNumber++;
                    }
                    visibleCount++;
                }
            });

            // Update the badge counts
            document.getElementById('count-all').textContent = statusCounts["all"];
            document.getElementById('count-menunggu').textContent = statusCounts["menunggu"];
            document.getElementById('count-diterima').textContent = statusCounts["diterima"];
            document.getElementById('count-dikemas').textContent = statusCounts["dikemas"];
            document.getElementById('count-dikirim').textContent = statusCounts["dikirim"];
            // You might want to add counts for "selesai", "ditolak", "dibatalkan" here too if you have badges for them.
            // Example:
            // document.getElementById('count-selesai').textContent = statusCounts["selesai"];
            // document.getElementById('count-ditolak').textContent = statusCounts["ditolak"];
            // document.getElementById('count-dibatalkan').textContent = statusCounts["dibatalkan"];


            // Handle no data message
            if (noDataRow) {
                noDataRow.style.display = visibleCount === 0 ? '' : 'none';
            }
        }

        // Tab click handlers
        statusButtons.forEach(button => {
            button.addEventListener('click', function() {
                selectedStatus = this.getAttribute('data-status');
                filterTable();
            });
        });

        // Search functionality
        searchInput.addEventListener("keyup", filterTable);

        // SweetAlert for cancellation
        document.querySelectorAll('.btn-konfirmasi-batal').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                Swal.fire({
                    title: 'Yakin ingin membatalkan?',
                    text: "Poin dan stok akan dikembalikan.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, batalkan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`form-batal-${id}`).submit();
                    }
                });
            });
        });

        // Initial filter when the page loads (shows "Semua" by default)
        filterTable();
    });
</script>
@endpush