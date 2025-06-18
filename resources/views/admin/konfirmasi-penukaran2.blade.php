@extends('layouts.dashboard')

@section('title', 'Konfirmasi Penukaran')

@section('content')
<div class="container mt-4">
  <h4 class="mb-4">Konfirmasi Penukaran Hadiah</h4>

  <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
      <thead class="table-dark">
        <tr>
          <th>No</th>
          <th>Nama Komunitas</th>
          <th>Hadiah</th>
          <th>Detail Hadiah</th>
          <th>Jumlah</th>
          <th>Total Poin</th>
          <th>Tanggal</th>
          <th>Aksi</th>
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
            <td>{{ $item->komunitas->user->nama ?? '-' }}</td>
            <td>{{ $hadiah->nama_hadiah ?? '-' }}</td>
            <td class="text-center">
              @if ($hadiah)
              <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id_penukaran }}">
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
                    <form action="{{ route('penukaran.update.status', $item->id_penukaran) }}" method="POST">
                      @csrf
                      @method('PUT')
                      <input type="hidden" name="status" value="diterima">
                      <button type="submit" class="dropdown-item text-success">✔ Terima</button>
                    </form>
                  </li>
                  <li>
                    <form action="{{ route('penukaran.update.status', $item->id_penukaran) }}" method="POST">
                      @csrf
                      @method('PUT')
                      <input type="hidden" name="status" value="ditolak">
                      <button type="submit" class="dropdown-item text-danger">✖ Tolak</button>
                    </form>
                  </li>
                </ul>
              </div>
            </td>
          </tr>

          <!-- Modal Detail Hadiah -->
          @if ($hadiah)
          <div class="modal fade" id="detailModal{{ $item->id_penukaran }}" tabindex="-1" aria-labelledby="modalLabel{{ $item->id_penukaran }}" aria-hidden="true">
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
                        <img src="{{ asset('storage/' . $hadiah->foto) }}" class="img-fluid rounded" alt="Foto Hadiah">
                      @else
                        <p class="text-muted">Tidak ada foto hadiah</p>
                      @endif
                    </div>
                    <div class="col-md-7">
                      <h5>{{ $hadiah->nama_hadiah }}</h5>
                      <p><strong>Deskripsi:</strong><br>{{ $hadiah->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                      <p><strong>Ditukar pada:</strong> {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y, H:i') }}</p>
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
@endsection
