<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ecozyne | Data Kegiatan</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/ecozyne.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/styles-view-artikel.css" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <x-loader />

    <x-sidebar-admin /> 
  
    <!--  Main wrapper -->
    <div class="body-wrapper">
  
      <x-nav-header-admin />
  
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-2">Data Kegiatan</h5>
                  
                    <hr>
                    <div class="mb-1">
                      <input type="text" id="searchInput" class="form-control" placeholder="Cari Kegiatan...">
                    </div>
                    <hr>

                    <script>
                        // Fungsi pencarian kegiatan
                        function searchKegiatan() {
                            let input = document.getElementById('searchInput').value.toLowerCase();
                            let kegiatanCards = document.querySelectorAll('.artikel-card');
                    
                            kegiatanCards.forEach(card => {
                                let title = card.querySelector('.artikel-title').innerText.toLowerCase();
                                let content = card.querySelector('.artikel-teks').innerText.toLowerCase();
                    
                                if (title.includes(input) || content.includes(input)) {
                                    card.style.display = "block";
                                } else {
                                    card.style.display = "none";
                                }
                            });
                        }
                    
                        // Panggil fungsi setiap kali user mengetik
                        document.addEventListener('DOMContentLoaded', function () {
                            document.getElementById('searchInput').addEventListener('input', searchKegiatan);
                        });
                    </script>
                    

                    <div class="row" id="kegiatanContainer">
                        @foreach($kegiatans as $kegiatan)
                            <div class="col-sm-6 col-xl-3 mt-4 artikel-card">
                                <div class="card overflow-hidden rounded-2 h-100">
                                    <div class="position-relative">
                                        <a href="{{ route('kegiatan.show', $kegiatan->id_kegiatan) }}">
                                            <img src="{{ asset('storage/kegiatan/' . $kegiatan->foto) }}"
                                                class="card-img-top rounded-0 img-fluid artikel-img"
                                                alt="{{ $kegiatan->judul }}">
                                        </a>
                                    </div>
                                    <div class="card-body pt-3 p-4 d-flex flex-column">
                                        <h6 class="fw-semibold fs-4 artikel-title">{{ $kegiatan->judul }}</h6>
                                        <p class="text-muted artikel-teks">{{ $kegiatan->isi }}</p>

                                        <!-- Lokasi -->
                                        <p class="text-muted mb-1">
                                            <i class="fas fa-map-marker-alt me-1 text-danger"></i>
                                            {{ $kegiatan->lokasi }}
                                        </p>
                                        
                                        <!-- Waktu -->
                                        <p class="text-muted">
                                            <i class="fas fa-calendar-alt me-1 text-info"></i>
                                            {{ \Carbon\Carbon::parse($kegiatan->waktu)->translatedFormat('d F Y | H:i') }}
                                        </p>
                                        
                                        <a href="{{ route('kegiatan.show', $kegiatan->id_kegiatan) }}" class="btn btn-primary mt-2 mb-0">Edit Kegiatan</a>
                                        
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
</body>

</html>