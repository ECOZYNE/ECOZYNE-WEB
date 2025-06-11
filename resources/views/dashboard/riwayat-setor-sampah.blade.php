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
                {{-- Summary Cards --}}
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="fw-semibold mb-0">Statistik Setoran</h6>
                            <select id="filterSummary" class="form-select w-auto">
                                <option value="hari_ini" selected>Hari Ini</option>
                                <option value="minggu_ini">Minggu Ini</option>
                                <option value="bulan_ini">Bulan Ini</option>
                                <option value="tahun_ini">Tahun Ini</option>
                                <option value="semua">Semua</option>
                            </select>
                        </div>

                        <div class="row" id="summaryCards">
                            <!-- Card Total Transaksi -->
                            <div class="col-md-6 mb-3">
                                <div class="card border-start border-success border-4 shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title">Total Transaksi</h6>
                                        <h3 class="mb-0" id="totalTransaksi">0</h3>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Total Berat Sampah -->
                            <div class="col-md-6 mb-3">
                                <div class="card border-start border-info border-4 shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title">Total Berat Sampah</h6>
                                        <h3 class="mb-0" id="totalBerat">0 kg</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- Tabel Transaksi --}}
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Penyetor</th>
                                <th>Berat Sampah</th>
                                <th>Poin Diberikan</th>
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
                                    <td><span class="badge bg-info">{{ $item->formatted_weight }}</span></td>
                                    <td><span class="badge bg-success">{{ $item->formatted_points }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
            $.get(`/admin/transaksi-sampah/${id}`, function (data) {
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

@push('scripts')
    <script>
        const summary = @json($summaryData);

        function updateSummary(filter) {
            const data = summary[filter] ?? { transaksi: 0, berat: 0, poin: 0 };
            document.getElementById('totalTransaksi').innerText = data.transaksi;
            document.getElementById('totalBerat').innerText = `${parseFloat(data.berat).toFixed(1)} kg`;
            document.getElementById('totalPoin').innerText = `${parseInt(data.poin)} poin`;
        }

        document.getElementById('filterSummary').addEventListener('change', function () {
            updateSummary(this.value);
        });

        // Init default (Hari Ini)
        updateSummary('hari_ini');
    </script>
@endpush