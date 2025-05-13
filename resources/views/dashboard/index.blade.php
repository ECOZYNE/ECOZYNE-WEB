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

    <x-sidebar-user />

    <!--  Main wrapper -->
    <div class="body-wrapper">

        <x-nav-header-user />

        <div class="container-fluid">

            <div class="col-lg-12">

                <!-- Greeting -->
                <div class="card mb-4">
                    <div class="card-body p-4">
                        <h4 id="greetingText" class="fw-bold mb-2"></h4>
                        <p class="text-muted mb-0">Waktu saat ini: <span id="currentTime" class="fw-semibold"></span>
                            WIB</p>
                    </div>
                </div>

                <!-- Point Komunitas -->
                <div class="card overflow-hidden mb-4">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-4 fw-semibold">Point Anda</h5>
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="fw-semibold mb-3">0 XP</h4>
                                <p class="text-muted mt-2 mb-0 fs-4">Masa Berlaku: 07 Mei 2026</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Point Masuk dan Point Keluar -->
                <div class="row">
                    <!-- Point Masuk -->
                    <div class="col-md-6 mb-4">
                        <div class="card h-100 border-start border-success border-4">
                            <div class="card-body">
                                <h6 class="card-title fw-semibold mb-3">Point Masuk</h6>
                                <hr>
                                <ul>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Point Keluar -->
                    <div class="col-md-6 mb-4">
                        <div class="card h-100 border-start border-danger border-4">
                            <div class="card-body">
                                <h6 class="card-title fw-semibold mb-3">Point Keluar</h6>
                                <hr>
                                <ul>
                                    <li>
                                        <span class="fw-semibold">06 Mei 2025</span>: <span class="text-danger">-100
                                            XP</span> - <span class="text-muted">Tukar minyak 5 Liter</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>

    <script>
        function updateGreeting() {
            const nama = @json(Auth::user()?->name ?? 'Pengguna');
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