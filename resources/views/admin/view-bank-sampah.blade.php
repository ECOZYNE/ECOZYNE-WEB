@extends('layouts.dashboard')

@section('title', 'Data Bank Sampah')

@section('content')
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <!-- Ganti bagian card-body -->
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
                                <th>Alamat</th>
                                <th>No. Telepon</th>
                                <th>Dokumen</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($BankSampah as $data)

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->pengajuanBankSampah->nama_bank_sampah }}</td>
                                    <td>{{ $data->PengajuanBankSampah->komunitas->no_telp }}</td>
                                    <td>{{ $data->PengajuanBankSampah->komunitas->alamat->alamat }},
                                        {{ $data->PengajuanBankSampah->komunitas->alamat->kelurahan->kelurahan }},
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
                                    <td><span class="badge bg-success" id="status-1">{{ $data->pengajuanBankSampah->status }}
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" onclick="deleteBankSampah(1)">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <script>
                    $(document).ready(function () {
                        // Fungsi pencarian
                        $('#searchInput').on('input', function () {
                            const query = $(this).val().toLowerCase();
                            $('.galeri-card').each(function () {
                                const deskripsi = $(this).find('.galeri-deskripsi').text().toLowerCase();
                                $(this).toggle(deskripsi.includes(query));
                            });
                        });

                        // Isi modal edit
                        $('.edit-galeri-btn').on('click', function () {
                            const id = $(this).data('id');
                            const deskripsi = $(this).data('deskripsi');
                            const foto = $(this).data('foto');
                            const url = $(this).data('url');

                            $('#editGaleriForm').attr('action', url);
                            $('#edit-deskripsi').val(deskripsi);
                            $('#edit-id-galeri').val(id);

                            if (foto) {
                                $('#currentGaleriImage').attr('src', '/storage/galeri/' + foto);
                                $('#currentGaleriImageContainer').show();
                            } else {
                                $('#currentGaleriImageContainer').hide();
                            }

                            $('#editGaleriModal').modal('show');
                        });
                    });
                </script>
@endsection