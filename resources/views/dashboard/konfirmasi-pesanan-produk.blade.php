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
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                                data-bs-target="#detailModal" data-produk='@json($tp->produk)' data-jumlah="{{ $tp->jumlah }}"
                                                data-harga="{{ $tp->harga }}" data-tanggal="{{ \Carbon\Carbon::parse($data->created_at)->locale('id')->isoFormat('D MMMM YYYY, HH:mm') }}">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
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
                                                                <i class="fas fa-check me-1"></i> Terima Pesanan
                                                            </button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('pesanan.update.status.konfirmasi', $data->id_pesanan) }}" method="POST" class="dropdown-item" onsubmit="return confirm('Yakin ingin menolak pesanan ini? Stok produk akan dikembalikan.')">
                                                            @csrf
                                                            <input type="hidden" name="status" value="ditolak">
                                                            <button type="submit" class="btn btn-sm btn-danger w-100 text-start" style="border: none; background: none; color: inherit; padding: 0;">
                                                                <i class="fas fa-times me-1"></i> Tolak Pesanan
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
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

    {{-- Detail Modal --}}
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Produk Pesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img id="modalFoto" src="" alt="Foto Produk" class="img-fluid rounded shadow-sm mb-3"
                                style="max-height: 200px; object-fit: cover;">
                        </div>
                        <div class="col-md-8">
                            <p><strong>Nama Produk:</strong> <span id="modalNama"></span></p>
                            <p><strong>Deskripsi:</strong> <span id="modalDeskripsi"></span></p>
                            <p><strong>Harga Satuan:</strong> Rp<span id="modalHargaSatuan"></span></p>
                            <p><strong>Jumlah Dibeli:</strong> <span id="modalJumlah"></span></p>
                            <p><strong>Total Harga:</strong> Rp<span id="modalTotal"></span></p>
                            <p><strong>Tanggal Pesan:</strong> <span id="modalTanggal"></span></p>
                        </div>
                    </div>
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

            let found = false;
            rows.forEach(function (row) {
                if (row.querySelector('td[colspan="8"]')) {
                    return;
                }
                const rowText = row.innerText.toLowerCase();
                if (rowText.includes(searchValue)) {
                    row.style.display = "";
                    found = true;
                } else {
                    row.style.display = "none";
                }
            });
        });

        // Script untuk modal
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('[data-bs-target="#detailModal"]').forEach(button => {
                button.addEventListener('click', function () {
                    const produk = JSON.parse(this.dataset.produk);
                    const jumlah = parseInt(this.dataset.jumlah);
                    const harga = parseInt(this.dataset.harga);
                    const tanggal = this.dataset.tanggal;

                    const fotoUrl = produk.foto ? `/storage/${produk.foto}` : 'https://placehold.co/400x400/e1e1e1/909090?text=No+Image';
                    document.getElementById('modalFoto').src = fotoUrl;

                    document.getElementById('modalNama').innerText = produk.nama_produk || 'N/A';
                    document.getElementById('modalDeskripsi').innerText = produk.deskripsi || 'Tidak ada deskripsi.';
                    document.getElementById('modalHargaSatuan').innerText = new Intl.NumberFormat('id-ID').format(produk.harga || 0);
                    document.getElementById('modalJumlah').innerText = jumlah;
                    document.getElementById('modalTotal').innerText = new Intl.NumberFormat('id-ID').format(harga);
                    document.getElementById('modalTanggal').innerText = tanggal;
                });
            });
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