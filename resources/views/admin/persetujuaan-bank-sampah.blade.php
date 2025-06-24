@extends('layouts.dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/css/styles-status.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles-tabel.css') }}" />
    {{-- Load Leaflet CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
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
                                <th>Alamat Komunitas</th>
                                <th>Lokasi</th>
                                <th>Dokumen</th>
                                <th>Status</th>
                                <th>Tanggal Pengajuan</th>
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
                                        <br>
                                        {{ $data->komunitas->alamat->kelurahan->kelurahan }},
                                        <br>
                                        {{ $data->komunitas->alamat->kelurahan->kecamatan->kecamatan }}
                                    </td>
                                    <td class="text-center">
                                        @if(isset($data->latitude) && isset($data->longitude) && $data->latitude && $data->longitude)
                                            <button class="btn btn-sm btn-success d-inline-flex justify-content-center align-items-center"
                                                onclick="showMapModal('{{ $data->nama_bank_sampah }}', {{ $data->latitude }}, {{ $data->longitude }}, '{{ $data->lokasi_bank_sampah ?? 'Alamat tidak tersedia' }}')"
                                                title="Lihat di Peta">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </button>
                                        @else
                                            <button class="btn btn-sm btn-secondary" disabled title="Koordinat tidak tersedia">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </button>
                                        @endif
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
                                            'diproses' => ['text' => 'Proses', 'color' => 'primary'],
                                        ];

                                        $config = $statusConfig[$status] ?? ['text' => ucfirst($status), 'color' => 'secondary'];
                                    @endphp

                                    <td>
                                        <span class="custom-badge custom-badge-{{ $config['color'] }}">
                                            <span class="dot dot-{{ $config['color'] }}"></span>
                                            {{ $config['text'] }}
                                        </span>
                                    </td>

                                    <td>{{ $data->created_at }}</td>

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
                            @endforeach
                        </tbody>
                    </table>

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

                    <!-- Modal Map -->
                    <div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="mapModalLabel">Lokasi Bank Sampah</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <h6 id="bankSampahName" class="fw-bold text-primary"></h6>
                                        <p id="bankSampahAddress" class="text-muted mb-2"></p>
                                        <small id="bankSampahCoords" class="text-secondary"></small>
                                    </div>
                                    <div id="modalMap" style="height: 400px; width: 100%; border: 1px solid #ddd; border-radius: 5px;"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="openInMapsBtn" class="btn btn-success">
                                        <i class="fas fa-external-link-alt"></i> Buka di Google Maps
                                    </button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Load Leaflet JS --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        let modalMap;
        let currentMarker;

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

        function showMapModal(namaBankSampah, latitude, longitude, alamat) {
            // Set modal content
            document.getElementById('bankSampahName').textContent = namaBankSampah;
            document.getElementById('bankSampahAddress').textContent = alamat;
            document.getElementById('bankSampahCoords').textContent = `Koordinat: ${latitude}, ${longitude}`;

            // Set Google Maps link
            document.getElementById('openInMapsBtn').onclick = function() {
                window.open(`https://www.google.com/maps?q=${latitude},${longitude}`, '_blank');
            };

            // Show modal
            const mapModal = new bootstrap.Modal(document.getElementById('mapModal'));
            mapModal.show();

            // Initialize map when modal is fully shown
            document.getElementById('mapModal').addEventListener('shown.bs.modal', function () {
                initModalMap(latitude, longitude, namaBankSampah, alamat);
            }, { once: true });
        }

        function initModalMap(lat, lng, title, address) {
            // Remove existing map if any
            if (modalMap) {
                modalMap.remove();
            }

            const location = [parseFloat(lat), parseFloat(lng)];
            
            // Initialize map
            modalMap = L.map('modalMap').setView(location, 15);

            // Add tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19
            }).addTo(modalMap);

            // Add marker with popup
            currentMarker = L.marker(location).addTo(modalMap);
            
            currentMarker.bindPopup(`
                <div style="padding: 10px; min-width: 250px;">
                    <h6 style="margin-bottom: 10px; color: #0d6efd;"><strong>${title}</strong></h6>
                    <p style="margin: 5px 0; font-size: 14px; line-height: 1.4;">${address}</p>
                    <small style="color: #666; font-size: 12px;">Lat: ${lat}, Lng: ${lng}</small>
                </div>
            `).openPopup();

            // Ensure map renders properly
            setTimeout(() => {
                modalMap.invalidateSize();
            }, 100);
        }

        // Search functionality
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

        // Clean up map when modal is hidden
        document.getElementById('mapModal').addEventListener('hidden.bs.modal', function () {
            if (modalMap) {
                modalMap.remove();
                modalMap = null;
            }
            if (currentMarker) {
                currentMarker = null;
            }
        });
    </script>
@endsection