@extends('layouts.dashboard')

@section('title', 'Riwayat Penukaran Hadiah')

@section('content')
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Penukaran Hadiah Saya</h5>
                <hr>

                <!-- Search Input -->
                <div class="mb-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari data...">
                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table id="dataTable" class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th>#</th>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Total Harga</th>

                                <th>Status Penukaran</th>
                                <th>Tanggal Penukaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <!-- ... awal dokumen tidak diubah ... -->
                        <tbody>
                            <!-- Pesanan 1 -->
                            <tr>
                                <td>1</td>
                                <td>Beras 2 Kg</td>
                                <td>2</td>
                                <td>Rp40.000</td>

                                <td>Selesai</td>
                                <td>2025-05-01</td>
                                <td>
                                    <span class="badge bg-success">Penukaran selesai</span>
                                </td>
                            </tr>

                            <!-- Pesanan 2 -->
                            <tr>
                                <td>2</td>
                                <td>sabun Organik</td>
                                <td>1</td>
                                <td>Rp80.000</td>

                                <td>Selesai</td>
                                <td>2025-04-28</td>
                                <td>
                                    <span class="badge bg-success">Penukaran selesai</span>
                                </td>
                            </tr>

                            <!-- Pesanan 3 -->
                            <tr>
                                <td>3</td>
                                <td>Kompos Cair</td>
                                <td>5</td>
                                <td>Rp100.000</td>

                                <td>Selesai</td>
                                <td>2025-04-25</td>
                                <td>
                                    <span class="badge bg-success">Penukaran selesai</span>
                                </td>
                            </tr>

                            <!-- Pesanan 4 -->
                            <tr>
                                <td>4</td>
                                <td>Minyak Goreng</td>
                                <td>1</td>
                                <td>Rp30.000</td>

                                <td>Selesai</td>
                                <td>2025-04-20</td>
                                <td>
                                    <span class="badge bg-success">Penukaran selesai</span>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>

                <!-- Modal Edit Komunitas -->
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
    </div>

@endsection