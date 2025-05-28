@extends('layouts.dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/css/styles-view-kegiatan.css') }}" />
@endpush

@section('title', 'Data Komunitas')

@section('content')
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Data Pendaftar Kegiatan</h5>
                <hr>

                <div class="mb-3">
                    <input type="text" class="form-control" id="searchInput" placeholder="Cari kegiatan atau peserta...">
                </div>

                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th>No</th>
                                <th>Nama Kegiatan</th>
                                <th>Jumlah Pendaftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Pelatihan Eco Enzyme</td>
                                <td>3</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#modalKegiatan1">
                                        Detail
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Workshop Daur Ulang</td>
                                <td>2</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#modalKegiatan2">
                                        Detail
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Modal untuk Kegiatan 1 -->
                <div class="modal fade" id="modalKegiatan1" tabindex="-1" aria-labelledby="modalKegiatan1Label"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalKegiatan1Label">Peserta: Pelatihan Eco
                                    Enzyme</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>No Telp</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Andi Saputra</td>
                                            <td>andi_saputra</td>
                                            <td>andi@example.com</td>
                                            <td>081234567890</td>
                                        </tr>
                                        <tr>
                                            <td>Rina Marlina</td>
                                            <td>rina123</td>
                                            <td>rina@example.com</td>
                                            <td>081298765432</td>
                                        </tr>
                                        <tr>
                                            <td>Fadli Ramadhan</td>
                                            <td>fadli_eco</td>
                                            <td>fadli@example.com</td>
                                            <td>081377788899</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

@endsection