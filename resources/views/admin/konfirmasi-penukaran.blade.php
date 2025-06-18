@extends('layouts.dashboard')

@section('title', 'Konfirmasi Penukaran Hadiah')

@push('style')
        <link rel="stylesheet" href="{{ asset('assets/css/styles-tabel.css') }}" />
@endpush

@section('content')
  <div class="col-lg-12 d-flex align-items-stretch">
    <div class="card w-100">
    <div class="card-body p-4">
      <h5 class="card-title fw-semibold mb-4">Data Konfirmasi Penukaran Hadiah</h5>
      <hr>
      <div class="mb-3">
      <input type="text" id="searchInput" class="form-control" placeholder="Cari pemesan...">
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
          <th>Tanggal </th>
          <th>Konfirmasi</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($penukaran as $index => $item)
        @php
        $transaksi = $item->transaksi->first();
        $hadiah = $transaksi->hadiah ?? null;
        @endphp
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ $item->komunitas->user->username ?? '-' }}</td>
          <td style="white-space: normal;">
          <div>
          <div>
          {{ $item->komunitas->alamat->alamat ?? '-' }},
          <br>
          {{ $item->komunitas->alamat->kelurahan->kelurahan ?? '-' }},
          <br>
          {{ $item->komunitas->alamat->kelurahan->kecamatan->kecamatan ?? '-' }},
          <br>
          {{ $item->komunitas->alamat->kode_pos ?? '-' }}
          </div>
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
          <div class="dropdown">
          <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
          Aksi
          </button>
          <ul class="dropdown-menu">
          <li>
            <button type="button" class="dropdown-item text-success"
            onclick="konfirmasiAksi('{{ route('penukaran.update.status', $item->id_penukaran) }}', 'diterima')">
            ✔ Terima
            </button>
          </li>
          <li>
            <button type="button" class="dropdown-item text-danger"
            onclick="konfirmasiAksi('{{ route('penukaran.update.status', $item->id_penukaran) }}', 'ditolak')">
            ✖ Tolak
            </button>
          </li>
          </ul>
          </div>
          </td>
        </tr>

        <!-- Modal Detail Hadiah -->
        @if ($hadiah)
        <div class="modal fade" id="detailModal{{ $item->id_penukaran }}" tabindex="-1"
        aria-labelledby="modalLabel{{ $item->id_penukaran }}" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="modalLabel{{ $item->id_penukaran }}">Detail Hadiah</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
        <div class="row">
          <div class="col-md-5">
          @if ($hadiah->foto)
        <img src="{{ asset('storage/hadiah/' . $hadiah->foto) }}" class="img-fluid rounded"
        alt="Foto Hadiah">
        @else
        <p class="text-muted">Tidak ada foto hadiah</p>
        @endif
          </div>
          <div class="col-md-7">
          <h5>{{ $hadiah->nama_hadiah }}</h5>
          <p><strong>Deskripsi:</strong><br>{{ $hadiah->deskripsi ?? 'Tidak ada deskripsi' }}</p>
          <p><strong>Ditambah pada:</strong>
          {{ \Carbon\Carbon::parse($hadiah->created_at)->translatedFormat('d F Y, H:i') }}</p>
          </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        @endif

      @empty
      <tr>
        <td colspan="8" class="text-center">Tidak ada penukaran menunggu konfirmasi.</td>
      </tr>
      @endforelse
        </tbody>
      </table>
      </div>
    </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    function konfirmasiAksi(url, status) {
    const statusText = status === 'diterima' ? 'menerima' : 'menolak';
    const statusSuccess = status === 'diterima' ? 'diterima' : 'ditolak';

    Swal.fire({
      title: `Yakin ingin ${statusText} penukaran ini?`,
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: `Ya, ${statusText}`,
      cancelButtonText: 'Urungkan'
    }).then((result) => {
      if (result.isConfirmed) {
      $.ajax({
        url: url,
        type: 'POST',
        data: {
        _token: '{{ csrf_token() }}',
        _method: 'PUT',
        status: status
        },
        success: function (response) {
        Swal.fire({
          title: 'Berhasil!',
          text: `Penukaran berhasil ${statusSuccess}.`,
          icon: 'success'
        }).then(() => {
          location.reload();
        });
        },
        error: function () {
        Swal.fire({
          title: 'Gagal!',
          text: 'Terjadi kesalahan saat memproses.',
          icon: 'error'
        });
        }
      });
      }
    });
    }
  </script>

  @if (session('success'))
    <script>
    Swal.fire({
    icon: 'success',
    title: 'Sukses!',
    text: '{{ session('success') }}'
    });
    </script>
  @endif
@endpush