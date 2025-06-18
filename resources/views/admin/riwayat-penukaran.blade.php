@extends('layouts.dashboard')

@section('title', 'Riwayat Penukaran Hadiah (Selesai)')

@push('style')
        <link rel="stylesheet" href="{{ asset('assets/css/styles-tabel.css') }}" />
@endpush

@section('content')
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Data Penukaran Hadiah Selesai</h5>
                <hr>
                <div class="mb-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari penukar...">
                </div>

                <div class="table-responsive">
                    <table id="dataTable" class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Hadiah</th>
                                <th>Detail Hadiah</th>
                                <th>Jumlah</th>
                                <th>Total Poin</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @forelse ($penukaran->where('status_penukaran', 'selesai') as $item)
                                @php
                                    $transaksi = $item->transaksi->first();
                                    $hadiah = $transaksi->hadiah ?? null;

                                    $status = $item->status_penukaran;
                                    $statusLabel = ucfirst($status);
                                    $statusClass = 'bg-success';
                                    $statusIcon = 'bi-check-circle';
                                  @endphp
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->komunitas->user->username ?? '-' }}</td>
                                    <td style="white-space: normal;">
                                        <div>
                                            {{ $item->komunitas->alamat->alamat ?? '-' }},
                                            <br>{{ $item->komunitas->alamat->kelurahan->kelurahan ?? '-' }},
                                            <br>{{ $item->komunitas->alamat->kelurahan->kecamatan->kecamatan ?? '-' }},
                                            <br>{{ $item->komunitas->alamat->kode_pos ?? '-' }}
                                        </div>
                                    </td>
                                    <td>{{ $hadiah->nama_hadiah ?? '-' }}</td>
                                    <td class="text-center">
                                        @if ($hadiah)
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                                data-bs-target="#detailModal{{ $item->id_penukaran }}">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        @endif
                                    </td>
                                    <td>{{ $transaksi->jumlah ?? 0 }}</td>
                                    <td>{{ ($transaksi->point_satuan ?? 0) * ($transaksi->jumlah ?? 0) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y, H:i') }}</td>
                                    <td>
                                        <span class="badge {{ $statusClass }}">
                                            {{ $statusLabel }} <i class="bi {{ $statusIcon }} ms-2"></i>
                                        </span>
                                    </td>
                                </tr>

                                {{-- Modal Detail Hadiah --}}
                                @if ($hadiah)
                                    <div class="modal fade" id="detailModal{{ $item->id_penukaran }}" tabindex="-1"
                                        aria-labelledby="modalLabel{{ $item->id_penukaran }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel{{ $item->id_penukaran }}">Detail Hadiah
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Tutup"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            @if ($hadiah->foto)
                                                                <img src="{{ asset('storage/hadiah/' . $hadiah->foto) }}"
                                                                    class="img-fluid rounded" alt="Foto Hadiah">
                                                            @else
                                                                <p class="text-muted">Tidak ada foto hadiah</p>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-7">
                                                            <h5>{{ $hadiah->nama_hadiah }}</h5>
                                                            <p><strong>Deskripsi:</strong><br>{{ $hadiah->deskripsi ?? 'Tidak ada deskripsi' }}
                                                            </p>
                                                            <p><strong>Ditambah pada:</strong>
                                                                {{ \Carbon\Carbon::parse($hadiah->created_at)->translatedFormat('d F Y, H:i') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada penukaran dengan status selesai.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection