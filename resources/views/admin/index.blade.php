<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ecozyne | Beranda Admin</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/ecozyne.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<body>

  <x-loader />

  <x-sidebar-admin />

  <!--  Main wrapper -->
  <div class="body-wrapper">

    <x-nav-header-admin />

    <div class="container-fluid">
      <!--  Row 1 -->
      <div class="row">
        <div class="col-lg-12">

          <!-- Greeting -->
          <div class="card mb-4">
            <div class="card-body p-4">
              <h4 id="greetingText" class="fw-bold mb-2"></h4>
              <p class="text-muted mb-0">Waktu saat ini: <span id="currentTime" class="fw-semibold"></span>
                WIB</p>
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

            // Jalankan saat halaman dimuat
            updateGreeting();
            updateClock();
            setInterval(updateClock, 1000); // Update setiap detik
          </script>


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


          <!-- Grafik Batang: Komunitas -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Jumlah Komunitas per Kecamatan (Batam)</h5>
              <div id="bar-komunitas"></div>
            </div>
          </div>

          <!-- Grafik Batang: Bank Sampah -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Jumlah Bank Sampah per Kecamatan (Batam)</h5>
              <div id="bar-bank"></div>
            </div>
          </div>


          <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
          <script>
            const labels = [
              'Batam Kota', 'Sekupang', 'Lubuk Baja', 'Batu Aji',
              'Bengkong', 'Belakang Padang', 'Sagulung', 'Nongsa',
              'Sei Beduk', 'Galang', 'Batu Ampar', 'Bulang'
            ];

            const komunitasData = [4, 3, 2, 5, 1, 2, 3, 2, 4, 1, 3, 2]; // dummy
            const bankSampahData = [2, 1, 3, 4, 1, 1, 2, 1, 2, 1, 2, 1]; // dummy

            const barOptions = (title, data, colors, elementId) => ({
              series: [{
                data: data
              }],
              chart: {
                type: 'bar',
                height: 400
              },
              plotOptions: {
                bar: {
                  horizontal: true,
                  distributed: true,
                  barHeight: '60%',
                }
              },
              dataLabels: {
                enabled: true
              },
              colors: colors,
              xaxis: {
                categories: labels
              },
              title: {
                text: title,
                align: 'center'
              }
            });

            const colorSet = [
              '#1abc9c', '#2ecc71', '#3498db', '#9b59b6',
              '#f1c40f', '#e67e22', '#e74c3c', '#95a5a6',
              '#16a085', '#27ae60', '#2980b9', '#8e44ad'
            ];

            new ApexCharts(document.querySelector("#bar-komunitas"), barOptions(
              "Komunitas per Kecamatan", komunitasData, colorSet, "bar-komunitas"
            )).render();

            new ApexCharts(document.querySelector("#bar-bank"), barOptions(
              "Bank Sampah per Kecamatan", bankSampahData, colorSet, "bar-bank"
            )).render();
          </script>

          <div class="py-6 px-6 text-center">
          </div>
        </div>
      </div>
    </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="../assets/js/dashboard.js"></script>
</body>

</html>