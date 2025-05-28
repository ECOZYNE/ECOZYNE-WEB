@extends('layouts.dashboard')

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
      <div id="pie-komunitas"></div>
    </div>
  </div>

  <!-- Grafik Pie: Bank Sampah -->
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Jumlah Bank Sampah per Kecamatan (Batam)</h5>
      <div id="pie-bank"></div>
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
        height: 400,
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
          },
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
        breakpoint: 480,
        options: {
          chart: {
            width: 300
          },
          legend: {
            position: 'bottom'
          }
        }
      }],
      export: {
        csv: {
          filename: 'data-chart',
          columnDelimiter: ',',
          headerCategory: 'Kecamatan',
          headerValue: 'Jumlah'
        }
      }
    });

    new ApexCharts(document.querySelector("#pie-komunitas"), pieOptions(
      "Komunitas per Kecamatan", komunitasData, labels
    )).render();

    new ApexCharts(document.querySelector("#pie-bank"), pieOptions(
      "Bank Sampah per Kecamatan", bankSampahData, labels
    )).render();
  </script>

  <div class="py-6 px-6 text-center"></div>
</div>
@endsection
