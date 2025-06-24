@extends('layouts.dashboard')

@section('title', 'Riwayat Pesanan Produk')

@section('content')
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Pesanan Selesai Saya</h5>
            <hr>

            <div class="mb-3">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari pesanan...">
            </div>

            <div class="table-responsive">
                <table id="dataTable" class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th>No</th>
                            <th>Bank Sampah Penjual</th> {{-- Added this column --}}
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Status Pembayaran</th>
                            <th>Status Pesanan</th>
                            <th>Tanggal Pesan</th>
                            <th>Tanggal Selesai</th> {{-- Added this column for completion date --}}
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pesananSelesai as $index => $pesanan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $pesanan->bankSampah->pengajuanBankSampah->nama_bank_sampah ?? 'N/A' }}</td> {{-- Display Bank Sampah name --}}
                                <td>
                                    @foreach ($pesanan->transaksiProduk as $transaksi)
                                        {{ $transaksi->produk->nama_produk ?? 'Produk Tidak Ditemukan' }} <br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($pesanan->transaksiProduk as $transaksi)
                                        {{ $transaksi->jumlah }} <br>
                                    @endforeach
                                </td>
                                <td>
                                    <?php $totalOrderPrice = 0; ?>
                                    @foreach ($pesanan->transaksiProduk as $transaksi)
                                        <?php $totalOrderPrice += $transaksi->harga; ?>
                                    @endforeach
                                    Rp{{ number_format($totalOrderPrice, 0, ',', '.') }}
                                </td>
                                <td>
                                    <span class="badge {{ $pesanan->status_pembayaran == 1 ? 'bg-success' : 'bg-warning' }}">
                                        {{ $pesanan->status_pembayaran == 1 ? 'Lunas' : 'Belum Lunas' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-success">{{ ucfirst($pesanan->status_pesanan) }}</span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($pesanan->created_at)->format('d F Y H:i') }}</td>
                                <td>{{ \Carbon\Carbon::parse($pesanan->updated_at)->format('d F Y H:i') }}</td> {{-- Assuming updated_at is when status became 'selesai' --}}
                                <td>
                                    <span class="badge bg-success">Pesanan selesai</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Belum ada pesanan yang selesai.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="modal fade" id="editModal" tabindex="-1">
                <div class="modal-dialog">
                    <form id="editForm">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>Edit Komunitas</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="komunitas_id">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" id="nama" name="nama" class="form-control mb-3">
                                <label for="no_telp" class="form-label">Nomor Telepon</label>
                                <input type="text" id="no_telp" name="no_telp" class="form-control mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" id="username" name="username" class="form-control mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" id="alamat" name="alamat" class="form-control mb-3">
                                <label for="kode_pos" class="form-label">Kode Pos</label>
                                <input type="text" id="kode_pos" name="kode_pos" class="form-control mb-3">
                                <label for="kelurahan" class="form-label">Kelurahan</label>
                                <input type="text" id="kelurahan" class="form-control mb-3" readonly>
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <input type="text" id="kecamatan" class="form-control mb-3" readonly>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // DataTables initialization
            $('#dataTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "language": {
                    "search": "Cari:",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                    "infoFiltered": "(difilter dari _MAX_ total entri)",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Berikutnya",
                        "previous": "Sebelumnya"
                    }
                }
            });

            // Search functionality for the custom input
            $('#searchInput').on('keyup', function() {
                $('#dataTable').DataTable().search($(this).val()).draw();
            });
        });
    </script>
@endpush