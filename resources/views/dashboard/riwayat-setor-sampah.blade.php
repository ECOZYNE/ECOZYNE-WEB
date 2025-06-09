@extends('layouts.dashboard')

@section('title', 'Riwayat Setoran Sampah')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title fw-semibold mb-0">Riwayat Setoran Sampah</h5>
            <a href="{{ route('transaksi-sampah.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Setoran
            </a>
        </div>
        <hr>

        @if($transaksi->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Komunitas Penyetor</th>
                            <th>Berat Sampah</th>
                            <th>Poin Didapat</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksi as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->formatted_date }}</td>
                            <td>
                                <div>
                                    <strong>{{ $item->komunitas_penyetor->nama ?? '-' }}</strong><br>
                                    <small class="text-muted">{{ $item->komunitas_penyetor->user->username ?? '-' }}</small>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $item->formatted_weight }}</span>
                            </td>
                            <td>
                                <span class="badge bg-success">{{ $item->formatted_points }}</span>
                            </td>
                            <td>
                                @if($item->status == 'selesai')
                                    <span class="badge bg-success">Selesai</span>
                                @elseif($item->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($item->status) }}</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" onclick="showDetail({{ $item->id_transaksi }})">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Summary Card -->
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h6 class="card-title">Total Transaksi</h6>
                            <h3 class="mb-0">{{ $transaksi->count() }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h6 class="card-title">Total Berat Sampah</h6>
                            <h3 class="mb-0">{{ number_format($transaksi->sum('berat'), 2) }} kg</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h6 class="card-title">Total Poin</h6>
                            <h3 class="mb-0">{{ $transaksi->sum('poin') }}</h3>
                        </div>
                    </div>
                </div>
            </div>

        @else
            <div class="alert alert-warning">
                Belum ada data setoran sampah.
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
function showDetail(id) {
    $.get(`/admin/transaksi-sampah/${id}`, function(data) {
        // Logika tampilkan detail data
        Swal.fire({
            title: 'Detail Setoran Sampah',
            html: `
                <p><strong>Tanggal:</strong> ${data.formatted_date}</p>
                <p><strong>Komunitas:</strong> ${data.komunitas_nama}</p>
                <p><strong>Berat:</strong> ${data.berat} kg</p>
                <p><strong>Poin:</strong> ${data.poin}</p>
                <p><strong>Status:</strong> ${data.status}</p>
            `,
            icon: 'info'
        });
    });
}
</script>
@endpush
