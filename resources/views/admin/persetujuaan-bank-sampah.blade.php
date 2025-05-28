<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ecozyne | Data Galeri</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/ecozyne.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/styles-view-galeri.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
</head>

<body>
    <x-loader />
    <x-sidebar-admin />

    <!--  Main wrapper -->
    <div class="body-wrapper">
        <x-nav-header-admin />

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <!-- Ganti bagian card-body -->
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">Persetujuan Bank Sampah</h5>
                            <hr>

                            <!-- Search Input -->
                            <div class="mb-3">
                                <input type="text" id="searchInput" class="form-control"
                                    placeholder="Cari bank sampah...">
                            </div>

                            <!-- Table -->
                            <div class="table-responsive">
                                <table id="dataTable" class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Bank Sampah</th>
                                            <th>Alamat</th>
                                            <th>No. Telepon</th>
                                            <th>Dokumen</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Komunitas Hijau Lestari</td>
                                            <td>081234567890</td>
                                            <td>Jl. Gajah Mada No.10, Batam</td>
                                            <td>
                                                <a href="/dokumen/hijau_lestari.pdf" target="_blank"
                                                    class="btn btn-sm btn-info">
                                                    <i class="fas fa-file-pdf"></i> View PDF
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-warning" onclick="editPersetujuan(1, 'Komunitas Hijau Lestari')">
                                                    <i class="fas fa-edit"></i> Proses
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Komunitas Bersih Indah</td>
                                            <td>082345678901</td>
                                            <td>Jl. Engku Putri No.5, Batam</td>
                                            <td>
                                                <a href="/dokumen/hijau_lestari.pdf" target="_blank"
                                                    class="btn btn-sm btn-info">
                                                    <i class="fas fa-file-pdf"></i> View PDF
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-warning" onclick="editPersetujuan(2, 'Komunitas Bersih Indah')">
                                                    <i class="fas fa-edit"></i> Proses
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Komunitas Sejahtera</td>
                                            <td>083456789012</td>
                                            <td>Jl. Raja Ali Haji No.17, Batam</td>
                                            <td>
                                                <a href="/dokumen/hijau_lestari.pdf" target="_blank"
                                                    class="btn btn-sm btn-info">
                                                    <i class="fas fa-file-pdf"></i> View PDF
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-warning" onclick="editPersetujuan(3, 'Komunitas Sejahtera')">
                                                    <i class="fas fa-edit"></i> Proses
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    
                                    
                                </table>
                            </div>


                            <!-- Modal Edit Persetujuan -->
<div class="modal fade" id="persetujuanModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="persetujuanForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Persetujuan Bank Sampah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="pengajuan_id">
                    <p id="nama_komunitas_label"></p>

                    <label for="status" class="form-label">Status</label>
                    <select id="status" name="status" class="form-control mb-3">
                        <option value="">Pilih...</option>
                        <option value="diterima">Terima</option>
                        <option value="ditolak">Tolak</option>
                    </select>

                    <label for="catatan" class="form-label">Catatan</label>
                    <textarea id="catatan" name="catatan" class="form-control" rows="3"
                        placeholder="Tulis catatan..."></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    function editPersetujuan(id, namaKomunitas) {
        $('#pengajuan_id').val(id);
        $('#status').val('');
        $('#catatan').val('');
        $('#persetujuanModal').modal('show');
    }

    $('#persetujuanForm').submit(function (e) {
        e.preventDefault();
        const id = $('#pengajuan_id').val();
        const status = $('#status').val();
        const catatan = $('#catatan').val();

        if (!status) {
            alert('Silakan pilih status terlebih dahulu.');
            return;
        }

        // Dummy: Tampilkan data saja
        console.log(`ID: ${id}, Status: ${status}, Catatan: ${catatan}`);
        alert('Persetujuan berhasil disimpan!');
        $('#persetujuanModal').modal('hide');
    });
</script>


    <!-- Script -->
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>

  
</body>

</html>
