@extends('layouts.dashboard')

@section('title', 'Kegiatan Saya')

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/css/styles-status.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles-tabel.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* Basic styling for the modal for demonstration purposes */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1050; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }
        .modal-content {
            background-color: #fefefe;
            margin: 10% auto; /* 10% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
            max-width: 600px;
            position: relative; /* Penting: agar posisi X relatif terhadap modal-content */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .close-button {
            color: #aaa;
            position: absolute; /* Posisi absolut */
            top: 10px; /* Jarak dari atas */
            right: 35px; /* Jarak dari kanan */
            font-size: 28px;
            font-weight: bold;
            z-index: 1060; /* Pastikan di atas konten lain */
        }
        .close-button:hover,
        .close-button:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .modal-body img {
            max-width: 100%;
            height: auto;
            display: block;
            margin-bottom: 15px;
            border-radius: 4px;
        }
        .modal-footer {
            padding-top: 15px;
            text-align: right; /* Align button to the right */
        }
    </style>
@endpush

@section('content')
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Data Kegiatan yang Diikuti</h5>

                <div class="mb-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari kegiatan...">
                </div>

                <div class="table-responsive">
                    <table id="dataTable" class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th>
                                    <h6 class="fw-semibold mb-0">No</h6>
                                </th>
                                <th>
                                    <h6 class="fw-semibold mb-0">Nama Kegiatan</h6>
                                </th>
                                <th>
                                    <h6 class="fw-semibold mb-0">Alamat</h6>
                                </th>
                                <th>
                                    <h6 class="fw-semibold mb-0">Waktu</h6>
                                </th>
                                <th>
                                    <h6 class="fw-semibold mb-0">Detail</h6>
                                </th>
                                <th>
                                    <h6 class="fw-semibold mb-0">Status</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendaftaran as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->kegiatan->judul }}</td>
                                    <td>{{ $data->kegiatan->lokasi }}</td>
                                    <td>{{ \Carbon\Carbon::parse($data->kegiatan->tanggal_kegiatan)->format('d F Y H:i') }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm detail-button"
                                                data-judul="{{ $data->kegiatan->judul }}"
                                                data-deskripsi="{{ $data->kegiatan->isi }}"
                                                data-lokasi="{{ $data->kegiatan->lokasi }}"
                                                data-tanggal="{{ \Carbon\Carbon::parse($data->kegiatan->tanggal_kegiatan)->format('d F Y H:i') }}"
                                                data-foto="{{ asset('storage/kegiatan/' . $data->kegiatan->foto) }}">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                       <td>
                                        <span class="custom-badge custom-badge-success" id="status-{{ $loop->iteration }}">
                                            <span class="dot dot-success"></span>
                                            Anda Ikut
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="detailModal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h5 class="card-title fw-semibold mb-3">Detail Kegiatan</h5>
            <div class="modal-body">
                <img id="modalFoto" src="" alt="Poster Kegiatan">
                <p><strong>Nama Kegiatan:</strong> <span id="modalJudul"></span></p>
                <p><strong>Deskripsi:</strong> <span id="modalDeskripsi"></span></p>
                <p><strong>📍 Lokasi Kegiatan:</strong> <span id="modalLokasi"></span></p>
                <p><strong>📅 Tanggal Kegiatan:</strong> <span id="modalTanggal"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="tutupModalButton">Tutup</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Search functionality
            const searchInput = document.getElementById("searchInput");
            const tableRows = document.querySelectorAll("#dataTable tbody tr");

            searchInput.addEventListener("keyup", function () {
                const searchTerm = this.value.toLowerCase();
                tableRows.forEach(function (row) {
                    const rowText = row.textContent.toLowerCase();
                    row.style.display = rowText.includes(searchTerm) ? "" : "none";
                });
            });

            // Modal functionality
            const detailModal = document.getElementById("detailModal");
            const closeButton = document.querySelector(".close-button");
            const tutupModalButton = document.getElementById("tutupModalButton");
            const detailButtons = document.querySelectorAll(".detail-button");

            const modalFoto = document.getElementById("modalFoto");
            const modalJudul = document.getElementById("modalJudul");
            const modalDeskripsi = document.getElementById("modalDeskripsi");
            const modalLokasi = document.getElementById("modalLokasi");
            const modalTanggal = document.getElementById("modalTanggal");

            detailButtons.forEach(button => {
                button.addEventListener("click", function() {
                    modalJudul.textContent = this.dataset.judul;
                    modalDeskripsi.textContent = this.dataset.deskripsi;
                    modalLokasi.textContent = this.dataset.lokasi;
                    modalTanggal.textContent = this.dataset.tanggal;
                    modalFoto.src = this.dataset.foto;
                    detailModal.style.display = "block";
                });
            });

            // Event listeners for closing the modal
            closeButton.addEventListener("click", function() {
                detailModal.style.display = "none";
            });

            tutupModalButton.addEventListener("click", function() {
                detailModal.style.display = "none";
            });

            window.addEventListener("click", function(event) {
                if (event.target == detailModal) {
                    detailModal.style.display = "none";
                }
            });
        });
    </script>
@endpush