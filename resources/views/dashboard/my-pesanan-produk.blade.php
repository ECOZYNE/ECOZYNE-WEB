@extends('layouts.dashboard')

@section('title', 'Pesanan Produk Saya')

@push('style')
<style>
    /* Dark red for all count badges */
    .nav-pills .nav-link .badge.bg-secondary,
    .nav-pills .nav-link .badge.bg-warning,
    .nav-pills .nav-link .badge.bg-success,
    .nav-pills .nav-link .badge.bg-info,
    .nav-pills .nav-link .badge.bg-danger,
    .nav-pills .nav-link .badge.bg-primary, /* For 'Selesai' */
    .nav-pills .nav-link .badge.bg-dark, /* For 'Ditolak' */
    .nav-pills .nav-link .badge.bg-secondary { /* Added for 'Dikemas' - using secondary for now, you can change */
        background-color: #ff1c1c !important; /* Merah Tua */
    }

    /* Add padding to nav-item for spacing between tabs */
    .nav-item {
        padding: 0 5px; /* Adjust this value as needed for desired spacing */
    }

    /* Hover and active state for nav-link */
    .nav-pills .nav-link {
        transition: background-color 0.4s ease, color 0.4s ease; /* Smooth transition */
    }

    .nav-pills .nav-link:hover,
    .nav-pills .nav-link.active {
        background-color: #64c23c; /* Green hover/active color */
        color: #fff; /* White text for better contrast on green */
    }

    /* Adjust text color and background for badges when their parent nav-link is hovered/active */
    .nav-pills .nav-link:hover .badge,
    .nav-pills .nav-link.active .badge {
        color: #64c23c; /* Green text for the badge when parent is hovered/active */
        background-color: #fff !important; /* White background for the badge when parent is hovered/active */
        transition: background-color 0.4s ease, color 0.4s ease; /* Smooth transition for badges */
    }

    /* Hide badge when count is 0 */
    .badge.hidden {
        display: none !important;
    }

    /* Ensure white text for 'Belum Dibayar' badge on yellow background */
    .badge.bg-warning.text-white {
        color: #fff !important;
    }

    /* Modal Image Styling */
    .modal-product-image {
        max-height: 300px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    /* Modal Detail Styling */
    .detail-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 5px;
    }

    .detail-value {
        color: #212529;
        margin-bottom: 15px;
        padding: 8px 12px;
        background-color: #f8f9fa;
        border-radius: 5px;
        border-left: 3px solid #64c23c;
    }

    /* Detail Button Styling */
    .btn-detail {
        transition: all 0.3s ease;
    }

    .btn-detail:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
</style>
@endpush

@section('content')
<div class="col-lg-12 d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Pesanan Saya</h5>
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
                        Diverifikasi <span class="badge bg-success rounded-pill ms-1" id="count-diterima">0</span>
                    </button>
                </li>
                {{-- Added new tab for 'Dikemas' --}}
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="dikemas-tab" data-bs-toggle="pill" data-bs-target="#dikemas-content"
                        type="button" role="tab" aria-controls="dikemas-content" aria-selected="false" data-status="dikemas">
                        Dikemas <span class="badge bg-secondary rounded-pill ms-1" id="count-dikemas">0</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="dikirim-tab" data-bs-toggle="pill" data-bs-target="#dikirim-content"
                        type="button" role="tab" aria-controls="dikirim-content" aria-selected="false" data-status="dikirim">
                        Dikirim <span class="badge bg-info rounded-pill ms-1" id="count-dikirim">0</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="selesai-tab" data-bs-toggle="pill" data-bs-target="#selesai-content"
                        type="button" role="tab" aria-controls="selesai-content" aria-selected="false" data-status="selesai">
                        Selesai <span class="badge bg-primary rounded-pill ms-1" id="count-selesai">0</span>
                    </button>
                </li>
                {{-- Changed order for 'Ditolak' and 'Dibatalkan' --}}
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="ditolak-tab" data-bs-toggle="pill" data-bs-target="#ditolak-content"
                        type="button" role="tab" aria-controls="ditolak-content" aria-selected="false" data-status="ditolak">
                        Ditolak <span class="badge bg-dark rounded-pill ms-1" id="count-ditolak">0</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="dibatalkan-tab" data-bs-toggle="pill" data-bs-target="#dibatalkan-content"
                        type="button" role="tab" aria-controls="dibatalkan-content" aria-selected="false" data-status="dibatalkan">
                        Dibatalkan <span class="badge bg-danger rounded-pill ms-1" id="count-dibatalkan">0</span>
                    </button>
                </li>
            </ul>
            {{-- End New Tab-like Navigation --}}

            <div class="mb-3">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari pesanan...">
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table id="dataTable" class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Status Pembayaran</th>
                            <th>Status Pesanan</th>
                            <th>Detail</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse ($pesanan as $pesan)
                            @foreach ($pesan->transaksiProduk as $tp)
                                <tr data-status="{{ $pesan->status_pesanan }}">
                                    <td class="row-number"></td>
                                    <td>{{ $tp->produk->nama_produk ?? '-' }}</td>
                                    <td>{{ $tp->jumlah }}</td>
                                    <td>Rp{{ number_format($tp->harga, 0, ',', '.') }}</td>
                                    <td>
                                        @if ($pesan->status_pembayaran)
                                            <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Lunas</span>
                                        @else
                                            <span class="badge bg-warning text-white">Belum Dibayar <i class="bi bi-receipt ms-1"></i></span>
                                        @endif
                                    </td>
                                    <td>
                                        @switch($pesan->status_pesanan)
                                            @case('menunggu')
                                                <span class="badge bg-warning text-white">Menunggu <i class="bi bi-hourglass-split ms-1"></i></span>
                                                @break
                                            @case('diterima')
                                                <span class="badge bg-success text-white">Diverifikasi <i class="bi bi-check-circle ms-1"></i></span>
                                                @break
                                            {{-- New case for 'dikemas' --}}
                                            @case('dikemas')
                                                <span class="badge bg-secondary text-white">Dikemas <i class="bi bi-box-seam ms-1"></i></span>
                                                @break
                                            @case('dikirim')
                                                <span class="badge bg-info text-white">Dikirim <i class="bi bi-truck ms-1"></i></span>
                                                @break
                                            @case('selesai')
                                                <span class="badge bg-primary text-white">Selesai <i class="bi bi-check-all ms-1"></i></span>
                                                @break
                                            {{-- 'Ditolak' now before 'Dibatalkan' --}}
                                            @case('ditolak')
                                                <span class="badge bg-dark text-white">Ditolak <i class="bi bi-x-circle ms-1"></i></span>
                                                @break
                                            @case('dibatalkan')
                                                <span class="badge bg-danger text-white">Dibatalkan <i class="bi bi-slash-circle ms-1"></i></span>
                                                @break
                                            @default
                                                <span class="badge bg-secondary text-white">{{ ucfirst($pesan->status_pesanan) }}</span>
                                        @endswitch
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-info btn-detail" data-bs-toggle="modal" 
                                                data-bs-target="#detailModal" 
                                                data-nama-produk="{{ $tp->produk->nama_produk ?? '-' }}"
                                                data-deskripsi="{{ $tp->produk->deskripsi ?? 'Tidak ada deskripsi' }}"
                                                data-harga="{{ number_format($tp->produk->harga ?? 0, 0, ',', '.') }}"
                                                data-jumlah="{{ $tp->jumlah }}"
                                                data-total-harga="{{ number_format($tp->harga, 0, ',', '.') }}"
                                                data-bank-sampah="{{ $pesan->bankSampah->pengajuanBankSampah->nama_bank_sampah ?? '-' }}"
                                                data-tanggal="{{ $pesan->created_at->format('d/m/Y H:i') }}"
                                                data-foto="{{ $tp->produk->foto ? asset('storage/produk/' . $tp->produk->foto) : asset('images/default-product.png') }}">
                                            <i class="ti ti-eye"></i>
                                        </button>
                                    </td>
                                    <td>{{ $pesan->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        @if ($pesan->status_pesanan === 'menunggu')
                                            {{-- Form for Cancellation --}}
                                            <form id="form-batal-{{ $pesan->id_pesanan }}"
                                                action="{{ route('pesanan.batalkan', $pesan->id_pesanan) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                <button type="button" class="btn btn-sm btn-danger btn-konfirmasi-batal"
                                                    data-id="{{ $pesan->id_pesanan }}">Batalkan<i class="ti ti-x ms-1"></i></button>
                                            </form>
                                        @elseif ($pesan->status_pesanan === 'dikemas')
                                            <span class="text-secondary">Sedang dikemas</span>
                                        @elseif ($pesan->status_pesanan === 'dikirim')
                                            <span class="text-info">Sedang dikirim</span>
                                        @elseif ($pesan->status_pesanan === 'dibatalkan')
                                            <span class="text-danger">Pesanan dibatalkan</span>
                                        @elseif ($pesan->status_pesanan === 'selesai')
                                            <span class="text-primary">-</span>
                                        @elseif ($pesan->status_pesanan === 'ditolak')
                                            <span class="text-dark">Pesanan ditolak</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @empty
                            <tr class="no-data-row">
                                <td colspan="10" class="text-center py-4">
                                    <i class="bi bi-inbox fs-1 d-block mb-3 text-muted"></i>
                                    Belum ada data pesanan produk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

{{-- Detail Modal --}}
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
             <h5 class="modal-title" id="detailModalLabel" style="color: white;">
                <i class="bi bi-info-circle me-2"></i>Detail Pesanan Produk
              </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    {{-- Product Image --}}
                    <div class="col-md-5 text-center mb-3">
                        <img id="modal-foto" src="" alt="Foto Produk" class="img-fluid modal-product-image">
                    </div>
                    
                    {{-- Product Details --}}
                    <div class="col-md-7">
                        <div class="detail-label">Nama Produk:</div>
                        <div class="detail-value" id="modal-nama-produk">-</div>
                        
                        <div class="detail-label">Deskripsi:</div>
                        <div class="detail-value" id="modal-deskripsi">-</div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-label">Harga Satuan:</div>
                                <div class="detail-value" id="modal-harga">Rp 0</div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-label">Jumlah:</div>
                                <div class="detail-value" id="modal-jumlah">0</div>
                            </div>
                        </div>
                        
                        <div class="detail-label">Total Harga:</div>
                        <div class="detail-value text-primary fw-bold" id="modal-total-harga">Rp 0</div>
                        
                        <div class="detail-label">Bank Sampah:</div>
                        <div class="detail-value" id="modal-bank-sampah">-</div>
                        
                        <div class="detail-label">Tanggal Pemesanan:</div>
                        <div class="detail-value" id="modal-tanggal">-</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> {{-- Make sure this is loaded if you're using Font Awesome icons --}}

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const statusButtons = document.querySelectorAll('#statusTab .nav-link');
        const searchInput = document.getElementById('searchInput');
        const tableBody = document.getElementById('tableBody');
        const noDataRow = document.querySelector('.no-data-row');
        let selectedStatus = ""; // Default to show all items

        // Function to filter the table based on selected status and search keyword
        function filterTable() {
            const keyword = searchInput.value.toLowerCase();
            let visibleCount = 0;
            let rowNumber = 1;

            const rows = tableBody.querySelectorAll("tr[data-status]");
            const statusCounts = {
                "all": 0,
                "menunggu": 0,
                "diterima": 0, // Keep this order for display tabs
                "dikemas": 0, // Added new status
                "dikirim": 0,
                "selesai": 0,
                "ditolak": 0, // Changed order
                "dibatalkan": 0 // Changed order
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
                    const rowNumberElement = row.querySelector('.row-number');
                    if (rowNumberElement) {
                        rowNumberElement.textContent = rowNumber++;
                    }
                    visibleCount++;
                }
            });

            // Update the badge counts and hide if 0
            for (const status in statusCounts) {
                const badgeElement = document.getElementById(`count-${status}`);
                if (badgeElement) {
                    badgeElement.textContent = statusCounts[status];
                    if (statusCounts[status] === 0) {
                        badgeElement.classList.add('hidden');
                    } else {
                        badgeElement.classList.remove('hidden');
                    }
                }
            }

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

        // Detail Modal Functionality
        const detailButtons = document.querySelectorAll('.btn-detail');
        detailButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Get data attributes
                const namaProduk = this.getAttribute('data-nama-produk');
                const deskripsi = this.getAttribute('data-deskripsi');
                const harga = this.getAttribute('data-harga');
                const jumlah = this.getAttribute('data-jumlah');
                const totalHarga = this.getAttribute('data-total-harga');
                const bankSampah = this.getAttribute('data-bank-sampah');
                const tanggal = this.getAttribute('data-tanggal');
                const foto = this.getAttribute('data-foto');

                // Populate modal with data
                document.getElementById('modal-nama-produk').textContent = namaProduk;
                document.getElementById('modal-deskripsi').textContent = deskripsi;
                document.getElementById('modal-harga').textContent = 'Rp ' + harga;
                document.getElementById('modal-jumlah').textContent = jumlah + ' pcs';
                document.getElementById('modal-total-harga').textContent = 'Rp ' + totalHarga;
                document.getElementById('modal-bank-sampah').textContent = bankSampah;
                document.getElementById('modal-tanggal').textContent = tanggal;
                document.getElementById('modal-foto').src = foto;
                document.getElementById('modal-foto').alt = 'Foto ' + namaProduk;
            });
        });

        // SweetAlert for cancellation
        document.querySelectorAll('.btn-konfirmasi-batal').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                Swal.fire({
                    title: 'Yakin ingin membatalkan pesanan ini?',
                    text: "Aksi ini tidak bisa dibatalkan.",
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