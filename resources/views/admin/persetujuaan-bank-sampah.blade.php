@extends('layouts.dashboard')

@push('style')
 <link rel="stylesheet" href="{{ asset('assets/css/styles-status.css') }}" />
@endpush

@section('title', 'Data Bank Sampah')

@section('content')
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <!-- Ganti bagian card-body -->
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Setujui Pengajuan Bank Sampah</h5>
                <hr>

                <!-- Search Input -->
                <div class="mb-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari bank sampah...">
                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table id="dataTable" class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th>No</th>
                                <th>Nama Bank Sampah</th>
                                <th>No. Telepon</th>
                                <th>Alamat</th>
                                <th>Dokumen</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sudahMengajukan as $data)
                                <tr>
                                    <td>{{ $loop->iteration}}</td>
                                    <td>{{ $data->nama_bank_sampah }}</td>
                                    <td>{{ $data->komunitas->no_telp }}</td>
                                    <td>{{ $data->komunitas->alamat->alamat }},
                                        {{ $data->komunitas->alamat->kelurahan->kelurahan }},
                                        {{ $data->komunitas->alamat->kelurahan->kecamatan->kecamatan }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ asset('storage/' . $data->file_dokumen) }}" target="_blank" target="_blank"
                                            class="btn btn-sm btn-info d-inline-flex justify-content-center align-items-center"
                                            title="Lihat Dokumen">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>

                                    @php
                                        $status = $data->status;
                                        $statusConfig = [
                                            'diterima' => ['text' => 'Diterima', 'color' => 'success'],
                                            'ditolak' => ['text' => 'Ditolak', 'color' => 'danger'],
                                            'diproses' => ['text' => 'Diproses', 'color' => 'primary'],
                                        ];

                                        $config = $statusConfig[$status] ?? ['text' => ucfirst($status), 'color' => 'secondary'];
                                    @endphp

                                    <td>
                                        <span class="custom-badge custom-badge-{{ $config['color'] }}">
                                            <span class="dot dot-{{ $config['color'] }}"></span>
                                            {{ $config['text'] }}
                                        </span>
                                    </td>

                                    <td>
                                        @if ($status === 'diproses')
                                            <button class="btn btn-sm btn-warning"
                                                onclick="editPersetujuan({{ $data->id_pengajuan_bank_sampah }}, '{{ $data->komunitas->nama }}')"
                                                title="Proses Persetujuan">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        @else
                                            <button class="btn btn-sm btn-secondary" disabled title="Sudah diproses">
                                                <i class="fas fa-ban"></i>
                                            </button>
                                        @endif
                                    </td>

                                </tr>

                                <!-- Modal Edit Persetujuan -->
                                <div class="modal fade" id="persetujuanModal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <!-- Tambahkan method="POST" dan action kosong nanti akan di-set dengan JS -->
                                        <form id="persetujuanForm" method="POST" action="">
                                            @csrf
                                            @method('PUT') <!-- untuk method PUT -->

                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Persetujuan Bank Sampah</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <!-- hidden input ini untuk simpan id pengajuan, tapi sebenarnya tidak wajib kalau sudah di url -->
                                                    <input type="hidden" id="pengajuan_id" name="id">

                                                    <p id="nama_komunitas_label"></p>

                                                    <label for="status" class="form-label">Status</label>
                                                    <select id="status" name="status" class="form-control mb-3" required>
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
                            @endforeach
                        </tbody>
                    </table>

                    <script>
                        function editPersetujuan(id, namaKomunitas) {
                            // Set nilai hidden input id (optional)
                            $('#pengajuan_id').val(id);

                            // Reset form fields
                            $('#status').val('');
                            $('#catatan').val('');

                            // Set label nama komunitas
                            $('#nama_komunitas_label').text('Komunitas: ' + namaKomunitas);

                            // Set action form ke route update dengan id pengajuan
                            $('#persetujuanForm').attr('action', '/pengajuan/' + id);

                            // Tampilkan modal
                            $('#persetujuanModal').modal('show');
                        }

                    </script>

                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            const searchInput = document.getElementById("searchInput");
                            const tableRows = document.querySelectorAll("#dataTable tbody tr");

                            searchInput.addEventListener("keyup", function () {
                                const query = this.value.toLowerCase();

                                tableRows.forEach(row => {
                                    const rowText = row.textContent.toLowerCase();
                                    row.style.display = rowText.includes(query) ? "" : "none";
                                });
                            });
                        });
                    </script>
@endsection