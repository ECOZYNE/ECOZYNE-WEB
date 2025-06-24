@extends('layouts.dashboard')

@section('title', 'Data pesanan Produk')



@section('content')
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Data Pesanan Produk</h5>
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
                                    <h6 class="fw-semibold mb-0">Harga</h6>
                                </th>
                                <th>
                                    <h6 class="fw-semibold mb-0">Alamat Komunitas</h6>
                                </th>
                                <th>
                                    <h6 class="fw-semibold mb-0">Tanggal</h6>
                                </th> <!-- Tambahan -->
                                <th>
                                    <h6 class="fw-semibold mb-0">Status</h6>
                                </th>
                                <th>
                                    <h6 class="fw-semibold mb-0">Aksi</h6>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>andi123</td>
                                <td>Ecozyme Cair</td>
                                <td>2</td>
                                <td>Rp50.000</td>
                                <td>Jl. Raden Patah No. 10, Lubuk Baja</td>
                                <td>07 Mei 2025</td> <!-- Tambahan -->
                                <td><span class="badge bg-info" id="status-1">Dikirim</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown">
                                            Aksi
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#" onclick="ubahStatus(1, 'Selesai')">Tandai
                                                    Selesai</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>sitinur</td>
                                <td>Ecozyme Padat</td>
                                <td>5</td>
                                <td>Rp125.000</td>
                                <td>Jl. Sudirman No. 22, Batu Aji</td>
                                <td>06 Mei 2025</td> <!-- Tambahan -->
                                <td><span class="badge bg-info" id="status-2">Dikirim</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown">
                                            Aksi
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#" onclick="ubahStatus(2, 'Selesai')">Tandai
                                                    Selesai</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function ubahStatus(id, statusBaru) {
            const statusElem = document.getElementById(`status-${id}`);
            statusElem.textContent = statusBaru;
            statusElem.className = 'badge bg-success'; // ubah warna badge
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: `Status pesanan #${id} telah diubah menjadi "${statusBaru}"`,
                timer: 1500,
                showConfirmButton: false
            });
        }
    </script>
@endpush