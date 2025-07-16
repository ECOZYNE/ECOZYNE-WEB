@extends('layouts.dashboard')

@section('title', 'Riwayat Penukaran Hadiah Saya')

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/css/styles-my-penukaran-hadiah.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endpush

@section('content')
<div class="col-lg-12 d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Riwayat Penukaran Hadiah Saya</h5>
            <hr>
            <div class="mb-4">
                <input type="text" id="searchInput" class="form-control"
                    placeholder="Kamu bisa cari berdasarkan Nama Hadiah, Tanggal...">
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
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @php $no = 1; @endphp
                        @forelse ($penukaran as $item)
                            @foreach ($item->transaksi as $transaksi)
                                <tr data-status="{{ $item->status_penukaran }}">
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $transaksi->hadiah->nama_hadiah ?? 'N/A' }}</td>
                                    <td>{{ $transaksi->jumlah }}</td>
                                    <td>{{ number_format($transaksi->point_satuan * $transaksi->jumlah) }} XP</td>
                                    <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <span class="badge bg-success">
                                            {{ ucfirst($item->status_penukaran) }}
                                            <i class="bi bi-check-all ms-1"></i>
                                        </span>
                                    </td>
                                </tr>

                                {{-- Modal for details (content is unchanged) --}}
                                <div class="modal fade"
                                    id="detailModal-{{ $item->id_penukaran }}-{{ $transaksi->id_transaksi }}"
                                    tabindex="-1"
                                    aria-labelledby="detailModalLabel-{{ $item->id_penukaran }}-{{ $transaksi->id_transaksi }}"
                                    aria-hidden="true">
                                    {{-- ... Your modal content ... --}}
                                </div>
                            @endforeach
                        @empty
                            {{-- THE FIX IS HERE --}}
                            <tr class="no-data-row">
                                <td colspan="7" class="text-center py-4">
                                    <i class="bi bi-inbox fs-1 d-block mb-3 text-muted"></i>
                                    Anda belum memiliki riwayat penukaran hadiah yang selesai.
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
{{-- Your JavaScript does not need to be changed. It is correct. --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById('searchInput');
        const tableBody = document.querySelector("#tableBody");

        // Function to filter the table based on search keyword
        function filterTable() {
            const keyword = searchInput.value.toLowerCase();
            let visibleCount = 0;
            let rowNumber = 1; // Reset row number for visible rows

            Array.from(tableBody.children).forEach(row => {
                // Skip the no-data-row if it exists
                if (row.classList.contains('no-data-row')) {
                    row.style.display = 'none'; // Ensure it's hidden during filtering
                    return;
                }

                const rowText = row.innerText.toLowerCase();
                const show = rowText.includes(keyword);
                row.style.display = show ? "" : "none";

                if (show) {
                    // Update the row number for visible rows
                    const noCell = row.querySelector('td:first-child');
                    if (noCell) {
                        noCell.textContent = rowNumber++;
                    }
                    visibleCount++;
                }
            });

            // Handle no data message after filtering
            const noDataRow = tableBody.querySelector('.no-data-row');
            if (noDataRow) {
                if (visibleCount === 0) {
                    noDataRow.style.display = ''; // Show "Belum ada penukaran hadiah"
                } else {
                    noDataRow.style.display = 'none'; // Hide if there's data
                }
            } else if (visibleCount === 0) {
               // If no noDataRow exists and no data is visible, add one
                const newNoDataRow = document.createElement('tr');
                newNoDataRow.classList.add('no-data-row');
                newNoDataRow.innerHTML = `
                    <td colspan="8" class="text-center py-4">
                        <i class="bi bi-inbox fs-1 d-block mb-3 text-muted"></i>
                        Tidak ada hasil untuk pencarian ini.
                    </td>
                `;
                tableBody.appendChild(newNoDataRow);
            }
        }

        // Search functionality
        searchInput.addEventListener("keyup", filterTable);

        // Initial filtering to set row numbers and handle no data on page load
        filterTable();
    });
</script>
@endpush