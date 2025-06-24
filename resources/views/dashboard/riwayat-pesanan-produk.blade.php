@extends('layouts.dashboard')

@section('title', 'Riwayat Pesanan Produk Selesai Bank Sampah') {{-- You can adjust this title --}}

@section('content')
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Data Riwayat Pesanan Produk Selesai (Bank Sampah)</h5>
                <hr>
                <div class="mb-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari data...">
                </div>

                <div class="table-responsive">
                    <table id="dataTable" class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th>
                                    <h6 class="fw-semibold mb-0">No</h6>
                                </th>
                                <th>
                                    <h6 class="fw-semibold mb-0">Username Pemesan</h6>
                                </th>
                                <th>
                                    <h6 class="fw-semibold mb-0">Nama Barang</h6>
                                </th>
                                <th>
                                    <h6 class="fw-semibold mb-0">Jumlah Barang</h6>
                                </th>
                                <th>
                                    <h6 class="fw-semibold mb-0">Harga Total</h6>
                                </th>
                                <th>
                                    <h6 class="fw-semibold mb-0">Alamat Komunitas</h6>
                                </th>
                                <th>
                                    <h6 class="fw-semibold mb-0">Tanggal Pesan</h6>
                                </th>
                                <th>
                                    <h6 class="fw-semibold mb-0">Status</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Make sure the variable name matches what's passed from the controller --}}
                            @if($pesananSelesaiBankSampah->isEmpty())
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada riwayat pesanan produk yang selesai.</td>
                                </tr>
                            @else
                                @foreach($pesananSelesaiBankSampah as $index => $pesanan)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $pesanan->komunitas->user->username ?? 'N/A' }}</td>
                                        <td>
                                            @foreach($pesanan->transaksiProduk as $transaksi)
                                                {{ $transaksi->produk->nama_produk ?? 'N/A' }} <br>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($pesanan->transaksiProduk as $transaksi)
                                                {{ $transaksi->jumlah ?? 'N/A' }} <br>
                                            @endforeach
                                        </td>
                                        <td>
                                            @php
                                                $totalHargaPesanan = 0;
                                                foreach ($pesanan->transaksiProduk as $transaksi) {
                                                    $totalHargaPesanan += $transaksi->harga;
                                                }
                                                echo 'Rp' . number_format($totalHargaPesanan, 0, ',', '.');
                                            @endphp
                                        </td>

                                        {{-- MODIFIED ALAMAT KOMUNITAS DISPLAY START (with less <br>) --}}
                                        <td>
                                            @php
                                                $addressLine1Parts = [];
                                                if (!empty($pesanan->komunitas->alamat->alamat)) {
                                                    $addressLine1Parts[] = $pesanan->komunitas->alamat->alamat;
                                                }
                                                if (!empty($pesanan->komunitas->alamat->kelurahan->kelurahan)) {
                                                    $addressLine1Parts[] = $pesanan->komunitas->alamat->kelurahan->kelurahan;
                                                }
                                                if (!empty($pesanan->komunitas->alamat->kelurahan->kecamatan->kecamatan)) {
                                                    $addressLine1Parts[] = $pesanan->komunitas->alamat->kelurahan->kecamatan->kecamatan;
                                                }

                                                $fullAddress = implode(', ', $addressLine1Parts);
                                                if (!empty($pesanan->komunitas->alamat->kode_pos)) {
                                                    if (!empty($fullAddress)) {
                                                        $fullAddress .= '<br>'; // Add break only if there's an address line 1
                                                    }
                                                    $fullAddress .= $pesanan->komunitas->alamat->kode_pos;
                                                }

                                                echo $fullAddress ?: '-';
                                            @endphp
                                        </td>
                                        {{-- MODIFIED ALAMAT KOMUNITAS DISPLAY END --}}

                                        <td>{{ \Carbon\Carbon::parse($pesanan->created_at)->format('d F Y') }}</td>
                                        <td><span class="badge bg-success">Selesai</span></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function () {
            let filter = this.value.toLowerCase();
            let rows = document.querySelector('#dataTable tbody').rows;

            for (let i = 0; i < rows.length; i++) {
                let rowText = rows[i].textContent.toLowerCase();
                if (rowText.includes(filter)) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        });
    </script>
@endpush