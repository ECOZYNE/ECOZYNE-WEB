@extends('layouts.dashboard')

@push('style')
 <link rel="stylesheet" href="{{ asset('assets/css/styles-admin-dashboard.css') }}" />
@endpush

@section('title', 'Dashboard Admin')

@section('content')
<div class="col-lg-12">

  <!-- Greeting -->
  <div class="card mb-4">
    <div class="card-body p-4">
      <h4 id="greetingText" class="fw-bold mb-2"></h4>
      <p class="text-muted mb-0">Waktu saat ini: <span id="currentTime" class="fw-semibold"></span> WIB</p>
    </div>
  </div>

  <!-- Statistik -->
  <div class="row">
    <div class="col-md-6">
      <div class="card bg-white mb-3">
        <div class="card-body">
          <h5 class="card-title text-dark">Total Komunitas</h5>
          <p class="card-text fs-4 text-dark">2</p>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card bg-white mb-3">
        <div class="card-body">
          <h5 class="card-title text-dark">Total Bank Sampah</h5>
          <p class="card-text fs-4 text-dark">3</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Grafik Komunitas -->
  <div class="card mb-4">
    <div class="card-body position-relative">
      <h5 class="card-title">Jumlah Komunitas per Kecamatan (Batam)</h5>
      <div class="dropdown position-absolute top-0 end-0 m-3">
        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
          ⋮
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" onclick="downloadChart('chartKomunitas', 'png')">Download PNG</a></li>
          <li><a class="dropdown-item" onclick="downloadChart('chartKomunitas', 'csv')">Download CSV</a></li>
        </ul>
      </div>
      <div style="height: 300px;">
        <canvas id="chartKomunitas"></canvas>
      </div>
      <div class="legend-container" id="legend-komunitas"></div>
    </div>
  </div>

  <!-- Grafik Bank Sampah -->
  <div class="card mb-4">
    <div class="card-body position-relative">
      <h5 class="card-title">Jumlah Bank Sampah per Kecamatan (Batam)</h5>
      <div class="dropdown position-absolute top-0 end-0 m-3">
        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
          ⋮
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" onclick="downloadChart('chartBank', 'png')">Download PNG</a></li>
          <li><a class="dropdown-item" onclick="downloadChart('chartBank', 'csv')">Download CSV</a></li>
        </ul>
      </div>
      <div style="height: 300px;">
        <canvas id="chartBank"></canvas>
      </div>
      <div class="legend-container" id="legend-bank"></div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
  <!-- JS Libraries -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/file-saver@2.0.5/dist/FileSaver.min.js"></script>

<script>
  const labels = [
    'Batam Kota', 'Sekupang', 'Lubuk Baja', 'Batu Aji',
    'Bengkong', 'Belakang Padang', 'Sagulung', 'Nongsa',
    'Sei Beduk', 'Galang', 'Batu Ampar', 'Bulang'
  ];

  const komunitasData = [4, 3, 2, 5, 1, 2, 3, 2, 4, 1, 3, 2];
  const bankSampahData = [2, 1, 3, 4, 1, 1, 2, 1, 2, 1, 2, 1];

  const colors = [
    '#1abc9c', '#2ecc71', '#3498db', '#9b59b6',
    '#f1c40f', '#e67e22', '#e74c3c', '#95a5a6',
    '#16a085', '#27ae60', '#2980b9', '#8e44ad'
  ];

  let charts = {};

  function renderBarChart(id, label, data) {
    const ctx = document.getElementById(id).getContext('2d');
    charts[id] = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: label,
          data: data,
          backgroundColor: colors.slice(0, data.length)
        }]
      },
      options: {
        indexAxis: 'y',
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { display: false },
          beforeDraw: (chart) => {
            const ctx = chart.ctx;
            ctx.save();
            ctx.globalCompositeOperation = 'destination-over';
            ctx.fillStyle = 'white';  // background putih
            ctx.fillRect(0, 0, chart.width, chart.height);
            ctx.restore();
          }
        },
        scales: {
          x: { beginAtZero: true }
        }
      }
    });
  }

  renderBarChart('chartKomunitas', 'Jumlah Komunitas', komunitasData);
  renderBarChart('chartBank', 'Jumlah Bank Sampah', bankSampahData);

  // Fungsi download dengan background putih saat PNG dan CSV (tanpa SVG)
  function downloadChart(id, format) {
    const chart = charts[id];
    const canvas = chart.canvas;
    const label = chart.data.datasets[0].label;

    if (format === 'png') {
      const tempCanvas = document.createElement('canvas');
      tempCanvas.width = canvas.width;
      tempCanvas.height = canvas.height;
      const tempCtx = tempCanvas.getContext('2d');

      tempCtx.fillStyle = 'white';
      tempCtx.fillRect(0, 0, tempCanvas.width, tempCanvas.height);
      tempCtx.drawImage(canvas, 0, 0);

      tempCanvas.toBlob(blob => saveAs(blob, `${label}.png`));
    } else if (format === 'csv') {
      const rows = [['Kecamatan', 'Jumlah']];
      chart.data.labels.forEach((label, i) => {
        rows.push([label, chart.data.datasets[0].data[i]]);
      });
      const csv = rows.map(r => r.join(',')).join('\n');
      const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
      saveAs(blob, `${label}.csv`);
    }
  }

  // Render legend warna dan nama kecamatan
  function renderLegend(containerId, labels, colors) {
    const container = document.getElementById(containerId);
    container.innerHTML = '';

    labels.forEach((label, i) => {
      const color = colors[i % colors.length];
      const item = document.createElement('div');
      item.className = 'legend-item';

      const colorBox = document.createElement('span');
      colorBox.className = 'legend-color-box';
      colorBox.style.backgroundColor = color;

      const text = document.createTextNode(label);

      item.appendChild(colorBox);
      item.appendChild(text);
      container.appendChild(item);
    });
  }

  renderLegend('legend-komunitas', labels, colors);
  renderLegend('legend-bank', labels, colors);

</script>

<!-- Greeting dan Jam -->
<script>
  const nama = @json(Auth::user()?->name ?? 'Admin');

  function updateGreeting() {
    const now = new Date();
    const jakartaTime = new Date(now.toLocaleString("en-US", { timeZone: "Asia/Jakarta" }));
    const hour = jakartaTime.getHours();
    let greet = "Selamat malam";

    if (hour >= 5 && hour < 12) greet = "Selamat pagi";
    else if (hour >= 12 && hour < 15) greet = "Selamat siang";
    else if (hour >= 15 && hour < 18) greet = "Selamat sore";

    document.getElementById("greetingText").textContent = `${greet}, ${nama}!`;
  }

  function updateClock() {
    const now = new Date();
    const jakartaTime = new Date(now.toLocaleString("en-US", { timeZone: "Asia/Jakarta" }));
    const timeStr = jakartaTime.toLocaleTimeString('id-ID', {
      hour: '2-digit', minute: '2-digit', second: '2-digit'
    });
    document.getElementById("currentTime").textContent = timeStr;
  }

  updateGreeting();
  updateClock();
  setInterval(updateClock, 1000);
</script>
@endpush
