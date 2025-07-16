@extends('layouts.dashboard')

@section('title', 'Riwayat Setoran Sampah')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title fw-semibold mb-0">Riwayat Setoran Sampah</h5>
                <div>
                    <button type="button" class="btn btn-info me-2" data-bs-toggle="modal" data-bs-target="#statistikModal">
                        <i class="fas fa-chart-line"></i> Lihat Statistik
                    </button>
                    <a href="{{ route('transaksi-sampah.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Setoran
                    </a>
                </div>
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
                            <div class="col-md-6 mb-3">
                                <div class="card border-start border-success border-4 shadow-sm" style="border-left-color: #63c13b !important;">
                                    <div class="card-body">
                                        <h6 class="card-title">Total Transaksi</h6>
                                        <h3 class="mb-0" id="totalTransaksi">0</h3>
                                    </div>
                                </div>
                            </div>

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

                <div class="mb-3 d-flex justify-content-start">
                    <input type="text" id="searchInput" class="form-control w-25" placeholder="Cari penyetor atau tanggal...">
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

    <div class="modal fade" id="statistikModal" tabindex="-1" aria-labelledby="statistikModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statistikModalLabel">
                        <i class="fas fa-chart-line"></i> Statistik Setoran Sampah - Bulan Ini
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            {{-- Changed to match the green card style --}}
                            <div class="card border-start border-success border-4 shadow-sm" style="border-left-color: #63c13b !important;">
                                <div class="card-body text-center">
                                    <h4 id="totalTransaksiBulan">0</h4>
                                    <p class="mb-0">Total Transaksi</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{-- Changed to match the blue card style --}}
                            <div class="card border-start border-info border-4 shadow-sm">
                                <div class="card-body text-center">
                                    <h4 id="totalBeratBulan">0 kg</h4>
                                    <p class="mb-0">Total Berat</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0">Grafik Jumlah Transaksi per Hari</h6>
                                </div>
                                <div class="card-body">
                                    <canvas id="transaksiChart" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0">Grafik Berat Sampah per Hari</h6>
                                </div>
                                <div class="card-body">
                                    <canvas id="beratChart" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    
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

    <script>
        const summary = @json($summaryData);

        function updateSummary(filter) {
            const data = summary[filter] ?? { transaksi: 0, berat: 0, poin: 0 };
            document.getElementById('totalTransaksi').innerText = data.transaksi;
            document.getElementById('totalBerat').innerText = `${parseFloat(data.berat).toFixed(1)} kg`;
        }

        document.getElementById('filterSummary').addEventListener('change', function () {
            updateSummary(this.value);
        });

        // Init default (Hari Ini)
        updateSummary('hari_ini');
    </script>

    <script>
        document.getElementById('searchInput').addEventListener('keyup', function () {
            const keyword = this.value.toLowerCase();
            const rows = document.querySelectorAll('table tbody tr');

            rows.forEach(row => {
                const cellsText = Array.from(row.cells).map(cell => cell.innerText.toLowerCase());
                const found = cellsText.some(text => text.includes(keyword));
                row.style.display = found ? '' : 'none';
            });
        });
    </script>

    <script>
        let transaksiChart;
        let beratChart;
        
        // Event listener untuk modal statistik
        document.getElementById('statistikModal').addEventListener('shown.bs.modal', function () {
            loadStatistikData();
        });

        function loadStatistikData() {
            // Tampilkan loading
            document.getElementById('totalTransaksiBulan').innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            document.getElementById('totalBeratBulan').innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

            // AJAX request untuk mendapatkan data statistik
            $.ajax({
                url: '{{ route("transaksi-sampah.statistik") }}',
                method: 'GET',
                success: function(response) {
                    console.log('Response:', response); // Debug log
                    
                    // Update summary cards
                    document.getElementById('totalTransaksiBulan').innerText = response.summary.total_transaksi;
                    document.getElementById('totalBeratBulan').innerText = parseFloat(response.summary.total_berat).toFixed(1) + ' kg';

                    // Generate charts
                    generateCharts(response.chart_data);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', xhr.responseText); // Debug log
                    console.error('Status:', status);
                    console.error('Error:', error);
                    
                    // Tampilkan error yang lebih detail
                    document.getElementById('totalTransaksiBulan').innerText = 'Error';
                    document.getElementById('totalBeratBulan').innerText = 'Error';
                    
                    // Show error message
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        alert('Error: ' + xhr.responseJSON.error);
                    } else {
                        alert('Terjadi kesalahan saat memuat data statistik.');
                    }
                    
                    // Generate charts dengan data dummy jika error
                    generateCharts([]);
                }
            });
        }

        function generateCharts(chartData) {
            const labels = chartData.map(item => item.date);
            const beratData = chartData.map(item => parseFloat(item.total_berat));
            const transaksiData = chartData.map(item => parseInt(item.total_transaksi));

            // Generate Transaksi Chart
            const ctxTransaksi = document.getElementById('transaksiChart').getContext('2d');
            
            // Destroy existing chart if exists
            if (transaksiChart) {
                transaksiChart.destroy();
            }

            transaksiChart = new Chart(ctxTransaksi, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Transaksi',
                        data: transaksiData,
                        backgroundColor: 'rgba(54, 162, 235, 0.8)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            },
                            title: {
                                display: true,
                                text: 'Jumlah Transaksi'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Tanggal'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    }
                }
            });

            // Generate Berat Chart
            const ctxBerat = document.getElementById('beratChart').getContext('2d');
            
            // Destroy existing chart if exists
            if (beratChart) {
                beratChart.destroy();
            }

            beratChart = new Chart(ctxBerat, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Berat Sampah (kg)',
                        data: beratData,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Berat Sampah (kg)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Tanggal'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    }
                }
            });
        }
    </script>
@endpush