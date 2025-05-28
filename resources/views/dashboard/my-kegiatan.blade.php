@extends('layouts.dashboard')

@section('title', 'Kegiatan Saya')

@section('content')
<div class="col-lg-12 d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-body p-4">
            <!-- Judul -->
            <h5 class="card-title fw-semibold mb-4">Data Kegiatan yang Diikuti</h5>

            <!-- Input pencarian -->
            <div class="mb-3">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari kegiatan...">
            </div>

            <!-- Tabel data kegiatan -->
            <div class="table-responsive">
                <table id="dataTable" class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th><h6 class="fw-semibold mb-0">No</h6></th>
                            <th><h6 class="fw-semibold mb-0">Nama Kegiatan</h6></th>
                            <th><h6 class="fw-semibold mb-0">Alamat</h6></th>
                            <th><h6 class="fw-semibold mb-0">Waktu</h6></th>
                            <th><h6 class="fw-semibold mb-0">Status</h6></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Pelatihan Eco Enzyme</td>
                            <td>Jl. Raden Patah No. 10, Lubuk Baja</td>
                            <td>07 Mei 2025, 09:00</td>
                            <td><span class="badge bg-success" id="status-1">Anda Ikut</span></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Workshop Daur Ulang</td>
                            <td>Jl. Sudirman No. 22, Batu Aji</td>
                            <td>08 Mei 2025, 13:30</td>
                            <td><span class="badge bg-success" id="status-2">Anda Ikut</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById("searchInput");
        const tableRows = document.querySelectorAll("#dataTable tbody tr");

        searchInput.addEventListener("keyup", function () {
            const searchTerm = this.value.toLowerCase();

            tableRows.forEach(function (row) {
                const rowText = row.textContent.toLowerCase();
                row.style.display = rowText.includes(searchTerm) ? "" : "none";
            });
        });
    });
</script>
@endpush
