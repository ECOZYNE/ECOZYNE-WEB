@extends('layouts.dashboard')

@section('title', 'Konfirmasi Pesanan Produk')

@section('content')
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Data Konfirmasi Pesanan</h5>

                {{-- Alert Messages --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <hr>
                <div class="mb-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari pemesan atau produk...">
                </div>

                <div class="table-responsive">
                    <table id="dataTable" class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th>No</th>
                                <th>Nama Pemesan</th>
                                <th>Nama Produk</th>
                                <th>Detail Produk</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Tanggal Pesan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @forelse ($pesanan as $data)
                                @foreach ($data->transaksiProduk as $tp)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->komunitas->nama ?? 'Komunitas tidak ditemukan' }}</td>
                                        <td>{{ $tp->produk->nama_produk ?? '-' }}</td>
                                        <td class="text-center">
                                            {{-- Button to open the specific modal for this product --}}
                                            @if ($tp->produk) {{-- Check if product exists before showing button --}}
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                                data-bs-target="#detailProductModal{{ $tp->id_transaksi_produk }}">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                            @endif
                                        </td>
                                        <td>{{ $tp->jumlah }}</td>
                                        <td>Rp{{ number_format($tp->harga, 0, ',', '.') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($data->created_at)->locale('id')->isoFormat('D MMMM YYYY, HH:mm') }}</td>
                                        <td>
                                            {{-- Dropdown for actions --}}
                                            <div class="dropdown">
                                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownAction{{ $data->id_pesanan }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Pilih Aksi
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownAction{{ $data->id_pesanan }}">
                                                    <li>
                                                        <form action="{{ route('pesanan.update.status.konfirmasi', $data->id_pesanan) }}" method="POST" class="dropdown-item" onsubmit="return confirm('Yakin ingin menerima pesanan ini?')">
                                                            @csrf
                                                            <input type="hidden" name="status" value="diterima">
                                                            <button type="submit" class="btn btn-sm btn-success w-100 text-start" style="border: none; background: none; color: inherit; padding: 0;">
                                                                <i class="fas fa-check me-1 text-success"></i> <span class="text-success">Terima Pesanan</span>
                                                            </button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('pesanan.update.status.konfirmasi', $data->id_pesanan) }}" method="POST" class="dropdown-item" onsubmit="return confirm('Yakin ingin menolak pesanan ini? Stok produk akan dikembalikan.')">
                                                            @csrf
                                                            <input type="hidden" name="status" value="ditolak">
                                                            <button type="submit" class="btn btn-sm btn-danger w-100 text-start" style="border: none; background: none; color: inherit; padding: 0;">
                                                                <i class="fas fa-times me-1 text-danger"></i> <span class="text-danger">Tolak Pesanan</span>
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    @if ($tp->produk)
                                    <div class="modal fade" id="detailProductModal{{ $tp->id_transaksi_produk }}" tabindex="-1"
                                        aria-labelledby="modalProductLabel{{ $tp->id_transaksi_produk }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalProductLabel{{ $tp->id_transaksi_produk }}">Detail Produk</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            @if ($tp->produk->foto)
                                                            {{-- Adjusted this line to use asset() based on your provided path --}}
                                                            <img src="{{ asset('storage/produk/' . $tp->produk->foto) }}" class="img-fluid rounded"
                                                                alt="Foto Produk">
                                                            @else
                                                            <p class="text-muted">Tidak ada foto produk</p>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-7">
                                                            <p><strong>Nama Produk:</strong>{{ $tp->produk->nama_produk ?? 'N/A' }}</p>
                                                            <p><strong>Deskripsi:</strong>{{ $tp->produk->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                                                            </p>
                                                            <p><strong>Harga Satuan:</strong> Rp{{ number_format($tp->produk->harga ?? 0, 0, ',', '.') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">Tidak ada pesanan yang perlu dikonfirmasi saat ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Client-side search
        document.getElementById("searchInput").addEventListener("keyup", function () {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll("#dataTable tbody tr");

            let hasVisibleRows = false; // Flag to check if any data row is visible
            rows.forEach(function (row) {
                // If it's the "no data" row, handle it separately at the end
                if (row.querySelector('td[colspan="8"]')) {
                    row.style.display = "none"; // Temporarily hide it during search
                    return;
                }

                const rowText = row.innerText.toLowerCase();
                if (rowText.includes(searchValue)) {
                    row.style.display = "";
                    hasVisibleRows = true;
                } else {
                    row.style.display = "none";
                }
            });

            // Handle the "no data" row based on search results
            const noDataRowElement = document.querySelector("#dataTable tbody tr td[colspan='8']");
            if (noDataRowElement) {
                if (hasVisibleRows) {
                    noDataRowElement.parentNode.style.display = "none"; // Hide "no data" if results are found
                } else if (searchValue.length > 0) {
                    noDataRowElement.parentNode.style.display = ""; // Show "no results" message
                    noDataRowElement.innerText = "Tidak ada hasil ditemukan untuk pencarian Anda.";
                } else {
                    // If search is empty and no other data, show original "no data" message
                    @if (count($pesanan) == 0)
                        noDataRowElement.parentNode.style.display = "";
                        noDataRowElement.innerText = "Tidak ada pesanan yang perlu dikonfirmasi saat ini.";
                    @else
                        noDataRowElement.parentNode.style.display = "none"; // Hide if no search and data exists
                    @endif
                }
            }
        });

        // Auto hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
        });
    </script>
@endpush