<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ecozyne | Data Galeri</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/ecozyne.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/styles-view-artikel.css" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    @include('components.loader') <!-- Panggil Loader -->

    <x-sidebar-admin /> <!-- Panggil Sidebar -->

    <!--  Main wrapper -->
    <div class="body-wrapper">

        @include('components.header') <!-- Panggil Header -->

        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-2">Data Galeri</h5>

                    <hr>
                    <div class="mb-1">
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari Galeri...">
                    </div>
                    <hr>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const searchInput = document.getElementById('searchInput');
                            const cards = document.querySelectorAll('.artikel-card');
                    
                            searchInput.addEventListener('input', function () {
                                const query = this.value.toLowerCase();
                    
                                cards.forEach(card => {
                                    const deskripsi = card.querySelector('.galeri-deskripsi').textContent.toLowerCase();
                    
                                    if (deskripsi.includes(query)) {
                                        card.style.display = 'block';
                                    } else {
                                        card.style.display = 'none';
                                    }
                                });
                            });
                        });
                    </script>
                    
                    <div class="row" id="artikelContainer">
                        @foreach($galeris as $galeri)
                            <div class="col-sm-6 col-xl-3 mt-4 artikel-card">
                                <div class="card overflow-hidden rounded-2 h-100">
                                    <div class="position-relative">
                                        <img src="{{ asset('storage/galeri/' . $galeri->foto) }}"
                                            class="card-img-top rounded-0 img-fluid artikel-img" alt="">
                                    </div>
                                    <div class="card-body pt-3 p-4 d-flex flex-column">
                                        <p class="text-muted galeri-date">{{ $galeri->created_at->format('d M Y') }}</p>
                                        <p class="text-muted galeri-deskripsi">{{ $galeri->deskripsi }}</p>
                                        <a href="#" class="btn btn-primary mt-2 mb-0">Edit Galeri</a>
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
    </div>

    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
</body>

</html>