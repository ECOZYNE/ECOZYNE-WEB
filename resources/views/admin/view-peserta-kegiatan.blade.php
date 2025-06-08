@extends('layouts.dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/css/styles-view-kegiatan.css') }}" />
@endpush

@section('title', 'Data Peserta Kegiatan')

@section('content')
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Data Peserta Kegiatan</h5>
                <hr>

                <div class="mb-3">
                    <input type="text" class="form-control" id="searchInput" placeholder="Cari kegiatan...">
                </div>

                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th>No</th>
                                <th>Nama Kegiatan</th>
                                <th>Kuota</th>
                                <th>Pendaftar</th>
                                <th>Tanggal kegiatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kegiatans as $index => $kegiatan)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $kegiatan->judul }}</td>
                                    <td>{{ $kegiatan->kouta }}</td>
                                    <td>{{ $kegiatan->pendaftaran_count }}</td>
                                    <td>{{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('d F Y H:i') }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#modalKegiatan{{ $kegiatan->id_kegiatan }}">
                                            Detail
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Modals untuk setiap kegiatan --}}
                @foreach ($kegiatans as $kegiatan)
                    <div class="modal fade" id="modalKegiatan{{ $kegiatan->id_kegiatan }}" tabindex="-1"
                        aria-labelledby="modalLabel{{ $kegiatan->id_kegiatan }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel{{ $kegiatan->id_kegiatan }}">
                                        Peserta: {{ $kegiatan->judul }}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body">
                                    @php
                                        $pesertas = $kegiatan->pendaftaran()->with('komunitas')->get();
                                    @endphp
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Nama Pengguna</th>
                                                <th>Email</th>
                                                <th>No Telp</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($pesertas as $peserta)
                                                <tr>
                                                    <td>{{ $peserta->komunitas->nama ?? '-' }}</td>
                                                    <td>{{ $peserta->komunitas->user->username ?? '-' }}</td>
                                                    <td>{{ $peserta->komunitas->user->email ?? '-' }}</td>
                                                    <td>{{ $peserta->komunitas->no_telp ?? '-' }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">Belum ada peserta.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchInput = document.getElementById("searchInput");
            const tableRows = document.querySelectorAll("tbody tr");

            searchInput.addEventListener("input", function () {
                const query = searchInput.value.toLowerCase();

                tableRows.forEach(row => {
                    const judulKegiatan = row.children[1]?.textContent.toLowerCase() || "";
                    if (judulKegiatan.includes(query)) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            });
        });
    </script>
@endpush