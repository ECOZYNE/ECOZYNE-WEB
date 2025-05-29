@extends('layouts.dashboard')

@section('title', 'Dashboard Admin')
<style>
@media (max-width: 768px) {
  /* Sembunyikan tombol download/hamburger menu di HP */
  .apexcharts-toolbar {
    display: none !important;
  }
}


/* FIX untuk toolbar agar tetap tampil dan bisa diklik di mobile */
@media (max-width: 768px) {
  .apexcharts-toolbar {
    top: 8px !important;
    right: 8px !important;
    transform: scale(0.9);
  }

  .apexcharts-menu {
    font-size: 14px !important;
    min-width: 120px !important;
  }
}


.apexcharts-toolbar {
    position: absolute !important;
    top: 10px;
    right: 10px;
    z-index: 10;
    background-color: #f8f9fa;
    border-radius: 6px;
    padding: 2px 4px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.1);
  }

  .apexcharts-toolbar svg {
    width: 16px;
    height: 16px;
  }

  .chart-container {
    width: 100%;
    max-width: 500px;
    height: 450px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  @media (min-width: 768px) {
    .chart-container {
      height: 500px;
    }
  }

  .card-body {
    padding: 1rem 1.25rem !important;
  }

  .card-title {
    font-size: 1rem;
    font-weight: 600;
  }
</style>

@section('content')
<div class="col-lg-12">
  <!-- Greeting -->
  <div class="card mb-4">
    <div class="card-body p-4">
      <h4 id="greetingText" class="fw-bold mb-2"></h4>
      <p class="text-muted mb-0">Waktu saat ini: <span id="currentTime" class="fw-semibold"></span> WIB</p>
    </div>
  </div>

  <script>
    function updateGreeting() {
      const nama = @json(Auth::user()?->name ?? 'Admin');
      const now = new Date();
      const jakartaTime = new Date(now.toLocaleString("en-US", { timeZone: "Asia/Jakarta" }));
      const hours = jakartaTime.getHours();

      let greeting = "";
      if (hours >= 5 && hours < 12) {
        greeting = "Selamat pagi, " + nama + "!";
      } else if (hours >= 12 && hours < 15) {
        greeting = "Selamat siang, " + nama + "!";
      } else if (hours >= 15 && hours < 18) {
        greeting = "Selamat sore, " + nama + "!";
      } else {
        greeting = "Selamat malam, " + nama + "!";
      }

      document.getElementById("greetingText").textContent = greeting;
    }

    function updateClock() {
      const now = new Date();
      const jakartaTime = new Date(now.toLocaleString("en-US", { timeZone: "Asia/Jakarta" }));
      const timeStr = jakartaTime.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
      document.getElementById("currentTime").textContent = timeStr;
    }

    updateGreeting();
    updateClock();
    setInterval(updateClock, 1000);
  </script>

  <!-- Total Komunitas dan Bank Sampah -->
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

  <!-- Grafik Pie: Komunitas -->
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Jumlah Komunitas per Kecamatan (Batam)</h5>
    <div class="chart-container">
      <div id="pie-komunitas" style="width: 100%; height: 100%;"></div>
    </div>
  </div>
</div>

<!-- Grafik Pie: Bank Sampah -->
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Jumlah Bank Sampah per Kecamatan (Batam)</h5>
    <div class="chart-container">
      <div id="pie-bank" style="width: 100%; height: 100%;"></div>
    </div>
  </div>
</div>


  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
  const labels = [
    'Batam Kota', 'Sekupang', 'Lubuk Baja', 'Batu Aji',
    'Bengkong', 'Belakang Padang', 'Sagulung', 'Nongsa',
    'Sei Beduk', 'Galang', 'Batu Ampar', 'Bulang'
  ];

  const komunitasData = [4, 3, 2, 5, 1, 2, 3, 2, 4, 1, 3, 2];
  const bankSampahData = [2, 1, 3, 4, 1, 1, 2, 1, 2, 1, 2, 1];

  const pieOptions = (title, data, labels) => ({
  series: data,
  chart: {
    type: 'pie',
    height: '100%',
    toolbar: {
      show: true,
      tools: {
        download: true,
        selection: false,
        zoom: false,
        zoomin: false,
        zoomout: false,
        pan: false,
        reset: false,
        customIcons: []
      },
      offsetX: -10,
      offsetY: 0
    }
  },
  labels: labels,
  title: {
    text: title,
    align: 'left'
  },
  legend: {
    position: 'right'
  },
  tooltip: {
    y: {
      formatter: function (val) {
        return `${val} `;
      }
    }
  },
  responsive: [{
    breakpoint: 768,
    options: {
      chart: {
        width: '100%',
      },
      legend: {
        position: 'bottom'
      }
    }
  }]
});


  // Simpan instance chart
  let chartKomunitas = new ApexCharts(document.querySelector("#pie-komunitas"), pieOptions(
    "Komunitas per Kecamatan", komunitasData, labels
  ));
  chartKomunitas.render();

  let chartBank = new ApexCharts(document.querySelector("#pie-bank"), pieOptions(
    "Bank Sampah per Kecamatan", bankSampahData, labels
  ));
  chartBank.render();

  // Redraw saat resize/zoom
  function reRenderCharts() {
  if (chartKomunitas) chartKomunitas.destroy();
  if (chartBank) chartBank.destroy();

  chartKomunitas = new ApexCharts(document.querySelector("#pie-komunitas"), pieOptions(
    "Komunitas per Kecamatan", komunitasData, labels
  ));
  chartKomunitas.render();

  chartBank = new ApexCharts(document.querySelector("#pie-bank"), pieOptions(
    "Bank Sampah per Kecamatan", bankSampahData, labels
  ));
  chartBank.render();
}

window.addEventListener('resize', () => {
  clearTimeout(window.__chartResizeTimeout);
  window.__chartResizeTimeout = setTimeout(() => {
    reRenderCharts();
  }, 500);
});

</script>


  <div class="py-6 px-6 text-center"></div>
</div>
@endsection
