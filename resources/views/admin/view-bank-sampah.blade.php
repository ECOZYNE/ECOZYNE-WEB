@extends('layouts.dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/css/styles-status.css') }}" />
@endpush

@section('title', 'Data Bank Sampah')

@section('content')
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Data Bank Sampah</h5>
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
                                <th>Tanggal Pengajuan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($BankSampah as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->pengajuanBankSampah->nama_bank_sampah }}</td>
                                    <td>{{ $data->PengajuanBankSampah->komunitas->no_telp }}</td>
                                    <td>
                                        {{ $data->PengajuanBankSampah->komunitas->alamat->alamat }},
                                        <br>
                                        {{ $data->PengajuanBankSampah->komunitas->alamat->kelurahan->kelurahan }},
                                        <br>
                                        {{ $data->PengajuanBankSampah->komunitas->alamat->kelurahan->kecamatan->kecamatan }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ asset('storage/' . $data->PengajuanBankSampah->file_dokumen) }}"
                                            target="_blank"
                                            class="btn btn-sm btn-info d-inline-flex justify-content-center align-items-center"
                                            title="Lihat Dokumen">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                    @php
                                        $status = $data->pengajuanBankSampah->status;
                                        $config = [
                                            'text' => 'Diterima',
                                            'color' => 'success'
                                        ];
                                    @endphp
                                     <td>{{ $data->pengajuanBankSampah->created_at }}</td>
                                    <td>
                                        <span class="custom-badge custom-badge-{{ $config['color'] }}">
                                            <span class="dot dot-{{ $config['color'] }}"></span>
                                            {{ $config['text'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ route('bank-sampah.destroy', $data->id_bank_sampah) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection


@push('scripts')
    @if(session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                timer: 3000,
                showConfirmButton: false,
            });
        </script>
    @endif

    <script>
        document.getElementById('searchInput').addEventListener('input', function () {
            const query = this.value.toLowerCase();
            const rows = document.querySelectorAll('#dataTable tbody tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });
    </script>
@endpush