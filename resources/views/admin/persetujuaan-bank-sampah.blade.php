@extends('layouts.dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/css/styles-status.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles-tabel.css') }}" />
    {{-- Load Leaflet CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        /* Modern Tab Navigation Styles */
        .nav-tabs {
            border-bottom: 2px solid #f8f9fa;
            margin-bottom: 1.5rem;
        }

        .nav-tabs .nav-item {
            margin-bottom: 0;
            margin-right: 0.5rem;
        }

        .nav-tabs .nav-link {
            color: #5d87ff;
            background-color: transparent;
            border: none;
            border-radius: 12px;
            padding: 12px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            position: relative;
            overflow: hidden;
        }

        .nav-tabs .nav-link:hover {
            color: #ffffff;
            background-color: #64c23c;
            border: none;
            transform: translateY(-1px);
        }

        .nav-tabs .nav-link.active {
            color: #ffffff;
            background: #64c23c;
            border: none;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .nav-tabs .nav-link.active:hover {
            color: #ffffff;
            background: #64c23c;
            transform: translateY(-1px);
        }

        /* Modern Count Badge Styles */
        .status-count-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 4px 8px;
            min-width: 20px;
            height: 20px;
            font-size: 11px;
            font-weight: 600;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            border-radius: 10px;
            background-color: #dc3545;
            color: #ffffff;
            box-shadow: 0 2px 6px rgba(220, 53, 69, 0.3);
        }

        /* Remove all background color variations - use only red */
        .status-count-badge.bg-primary,
        .status-count-badge.bg-success,
        .status-count-badge.bg-danger,
        .status-count-badge.bg-secondary {
            background-color: #dc3545 !important;
            color: #ffffff !important;
            font-weight: 600 !important;
        }

        /* Add subtle animation for active tab */
        .nav-tabs .nav-link.active::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .nav-tabs .nav-link.active:hover::before {
            left: 100%;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .nav-tabs .nav-link {
                padding: 10px 16px;
                font-size: 14px;
            }

            .nav-tabs .nav-item {
                margin-right: 0.25rem;
            }

            .status-count-badge {
                min-width: 18px;
                height: 18px;
                font-size: 10px;
                padding: 3px 6px;
            }
        }

        /* Add smooth transitions for count updates */
        .status-count-badge {
            transition: all 0.3s ease;
        }

        /* Optional: Add pulse effect for count updates */
        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        .status-count-badge.updated {
            animation: pulse 0.5s ease-in-out;
        }
    </style>
@endpush

@section('title', 'Data Bank Sampah')

@section('content')
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Setujui Pengajuan Bank Sampah</h5>
                <hr>

                <ul class="nav nav-tabs mb-3" id="statusTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="diproses-tab" data-bs-toggle="tab" data-bs-target="#diproses"
                            type="button" role="tab" aria-controls="diproses" aria-selected="true"
                            data-status="diproses">Proses <span class="status-count-badge bg-primary"
                                id="count-diproses">0</span></button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="diterima-tab" data-bs-toggle="tab" data-bs-target="#diterima"
                            type="button" role="tab" aria-controls="diterima" aria-selected="false"
                            data-status="diterima">Diterima <span class="status-count-badge bg-success"
                                id="count-diterima">0</span></button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="ditolak-tab" data-bs-toggle="tab" data-bs-target="#ditolak"
                            type="button" role="tab" aria-controls="ditolak" aria-selected="false"
                            data-status="ditolak">Ditolak <span class="status-count-badge bg-danger"
                                id="count-ditolak">0</span></button>
                    </li>
                </ul>

                <div class="mb-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari bank sampah...">
                </div>

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
                                <tr class="status-row" data-status="{{ $data->status }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->nama_bank_sampah }}</td>
                                    <td>{{ $data->komunitas->no_telp }}</td>
                                    <td>{{ $data->komunitas->alamat->alamat }},
                                        <br>
                                        {{ $data->komunitas->alamat->kelurahan->kelurahan }},
                                        <br>
                                        {{ $data->komunitas->alamat->kelurahan->kecamatan->kecamatan }}
                                    </td>
                                    <td class="text-center">
                                        @if (isset($data->latitude) && isset($data->longitude) && $data->latitude && $data->longitude)
                                            <button class="btn btn-sm btn-success d-inline-flex justify-content-center align-items-center"
                                                onclick="showMapModal('{{ $data->nama_bank_sampah }}', {{ $data->latitude }}, {{ $data->longitude }}, '{{ $data->lokasi_bank_sampah ?? 'Alamat tidak tersedia' }}')"
                                                title="Lihat di Peta">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </button>
                                        @else
                                            <button class="btn btn-sm btn-secondary" disabled
                                                title="Koordinat tidak tersedia">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </button>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ asset('storage/' . $data->file_dokumen) }}" target="_blank"
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

                    <div class="modal fade" id="persetujuanModal" tabindex="-1">
                        <div class="modal-dialog">
                            <form id="persetujuanForm" method="POST" action="">
                                @csrf
                                @method('PUT')

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Persetujuan Bank Sampah</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
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

                    <div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="mapModalLabel">Lokasi Bank Sampah</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <h6 id="bankSampahName" class="fw-bold text-primary"></h6>
                                        <p id="bankSampahAddress" class="text-muted mb-2"></p>
                                        <small id="bankSampahCoords" class="text-secondary"></small>
                                    </div>
                                    <div id="modalMap"
                                        style="height: 400px; width: 100%; border: 1px solid #ddd; border-radius: 5px;">
                                    </div>
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
            $('#pengajuan_id').val(id);
            $('#status').val('');
            $('#catatan').val('');
            $('#nama_komunitas_label').text('Komunitas: ' + namaKomunitas);
            $('#persetujuanForm').attr('action', '/pengajuan/' + id);
            $('#persetujuanModal').modal('show');
        }

        function showMapModal(namaBankSampah, latitude, longitude, alamat) {
            document.getElementById('bankSampahName').textContent = namaBankSampah;
            document.getElementById('bankSampahAddress').textContent = alamat;
            document.getElementById('bankSampahCoords').textContent = `Koordinat: ${latitude}, ${longitude}`;

            // Corrected Google Maps URL
            document.getElementById('openInMapsBtn').onclick = function() {
                window.open(`https://www.google.com/maps/search/?api=1&query=${latitude},${longitude}`, '_blank');
            };

            const mapModal = new bootstrap.Modal(document.getElementById('mapModal'));
            mapModal.show();

            document.getElementById('mapModal').addEventListener('shown.bs.modal', function() {
                initModalMap(latitude, longitude, namaBankSampah, alamat);
            }, {
                once: true
            });
        }

        function initModalMap(lat, lng, title, address) {
            if (modalMap) {
                modalMap.remove();
            }

            const location = [parseFloat(lat), parseFloat(lng)];

            modalMap = L.map('modalMap').setView(location, 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19
            }).addTo(modalMap);

            currentMarker = L.marker(location).addTo(modalMap);

            currentMarker.bindPopup(`
                <div style="padding: 10px; min-width: 250px;">
                    <h6 style="margin-bottom: 10px; color: #0d6efd;"><strong>${title}</strong></h6>
                    <p style="margin: 5px 0; font-size: 14px; line-height: 1.4;">${address}</p>
                    <small style="color: #666; font-size: 12px;">Lat: ${lat}, Lng: ${lng}</small>
                </div>
            `).openPopup();

            setTimeout(() => {
                modalMap.invalidateSize();
            }, 100);
        }

        // Enhanced updateCounts function with pulse effect
        function updateCounts() {
            const counts = {
                // 'all' is removed as a category
                diproses: 0,
                diterima: 0,
                ditolak: 0
            };

            const tableRows = document.querySelectorAll("#dataTable tbody tr"); // Re-query inside for up-to-date rows

            tableRows.forEach(row => {
                const rowStatus = row.dataset.status;
                // No longer increment 'all'
                if (counts.hasOwnProperty(rowStatus)) {
                    counts[rowStatus]++;
                }
            });

            // Update counts with pulse effect
            const countElements = {
                // 'all' is removed from countElements
                diproses: document.getElementById('count-diproses'),
                diterima: document.getElementById('count-diterima'),
                ditolak: document.getElementById('count-ditolak')
            };

            Object.keys(counts).forEach(status => {
                const element = countElements[status];
                const oldValue = element.textContent;
                const newValue = counts[status].toString();

                if (oldValue !== newValue) {
                    element.textContent = newValue;
                    // Add pulse effect for updated counts
                    element.classList.add('updated');
                    setTimeout(() => {
                        element.classList.remove('updated');
                    }, 500);
                }
            });
        }

        function filterTable(status) {
            const tableRows = document.querySelectorAll("#dataTable tbody tr"); // Re-query for fresh state
            tableRows.forEach(row => {
                const rowStatus = row.dataset.status;
                if (rowStatus === status) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
            // Re-apply search filter after tab filtering
            applySearchFilter();
        }

        function applySearchFilter() {
            const query = searchInput.value.toLowerCase();
            const tableRows = document.querySelectorAll("#dataTable tbody tr"); // Re-query for fresh state
            tableRows.forEach(row => {
                // Only apply search filter to currently visible rows (based on tab filter)
                if (row.style.display !== "none") {
                    const rowText = row.textContent.toLowerCase();
                    row.style.display = rowText.includes(query) ? "" : "none";
                }
            });
        }

        // Initialize modern tab functionality
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById("searchInput");
            const navLinks = document.querySelectorAll("#statusTabs .nav-link");

            // Initial update of counts and filter to show 'diproses' on page load
            updateCounts();
            filterTable('diproses');

            // Event listeners for tab clicks with enhanced UX
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const statusToFilter = this.dataset.status;

                    // Update Bootstrap tab state
                    const bsTab = new bootstrap.Tab(this);
                    bsTab.show();

                    // Apply custom filtering
                    filterTable(statusToFilter);
                });
            });

            // Enhanced search input with debounce
            let searchTimeout;
            searchInput.addEventListener("input", function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    applySearchFilter();
                }, 300);
            });

            // Add search input focus effects
            searchInput.addEventListener("focus", function() {
                this.style.borderColor = "#667eea";
                this.style.boxShadow = "0 0 0 0.2rem rgba(102, 126, 234, 0.25)";
            });

            searchInput.addEventListener("blur", function() {
                this.style.borderColor = "#ced4da";
                this.style.boxShadow = "none";
            });
        });

        document.getElementById('mapModal').addEventListener('hidden.bs.modal', function() {
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