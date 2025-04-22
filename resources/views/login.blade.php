@if(session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'error',
            title: 'Gagal Masuk',
            text: 'Nama pengguna atau kata sandi salah!',
            confirmButtonText: 'Tutup',
            confirmButtonColor: '#3085d6',
        });
    });
</script>
@endif



<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ecozyne | Portal Masuk</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/ecozyne.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
  <link rel="stylesheet" href="../assets/css/styles-login.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

  <x-loader />

  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-10 col-lg-8 col-xl-5">
            <div class="card mb-0">
              <div class="card-body">
                <a href="login" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="../assets/images/logos/ecozyne.png" class="logo-img" alt="Logo Ecozyne" />
                  <span class="ms-1 fw-bolder text-dark fs-8">Ecozyne</span>
                </a>
                <hr>

                <form action="{{ route('login-post') }}" method="POST">
                  @csrf
                  <div class="mb-3">
                    <label for="username" class="form-label">Nama Pengguna</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Nama Pengguna" required onpaste="return false">
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <div class="input-group">
                      <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan kata sandi" required onpaste="return false">
                      <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">
                            <i id="eyeIcon" class="bi bi-eye-slash"></i>
                        </button>
                    </div>
                </div>
              
              <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const inputs = ['username', 'password'];
            
                    inputs.forEach(function(id) {
                        const input = document.getElementById(id);
                        input.addEventListener('paste', function(e) {
                            e.preventDefault();
            
                            Swal.fire({
                                icon: 'warning',
                                title: 'Aksi Tidak Diizinkan',
                                text: 'Anda tidak diizinkan untuk melakukan tempel teks!',
                                confirmButtonColor: '#6C63FF'
                            });
                        });
                    });
                });
            </script>
            
                
                <script>
                    function togglePassword() {
                        var passwordField = document.getElementById("password");
                        var eyeIcon = document.getElementById("eyeIcon");

                        if (passwordField.type === "password") {
                            passwordField.type = "text";
                            eyeIcon.classList.remove("bi-eye-slash");
                            eyeIcon.classList.add("bi-eye");
                        } else {
                            passwordField.type = "password";
                            eyeIcon.classList.remove("bi-eye");
                            eyeIcon.classList.add("bi-eye-slash");
                        }
                    }
                </script>
                
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <a class="text-primary fw-bold" href="forgot-password">Lupa Kata Sandi ?</a>
                  </div>
                  <button type="submit" class="btn btn-primary w-100">Masuk</button>
                  <div class="d-flex align-items-center justify-content-center mt-4">
                    <p class="fs-4 mb-0 fw-bold">Belum Punya Akun ?</p>
                    <a class="text-primary fw-bold ms-2" href="register">Buat Akun</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
