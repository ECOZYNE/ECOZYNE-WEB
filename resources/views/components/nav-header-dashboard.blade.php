<!-- Header -->
<header class="app-header shadow">
  <nav class="navbar navbar-expand-lg navbar-light">
    <!-- Tombol Sidebar untuk tampilan kecil -->
    <ul class="navbar-nav">
      <li class="nav-item d-block d-xl-none">
        <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
          <i class="ti ti-menu-2"></i>
        </a>
      </li>
    </ul>

    <!-- Navigasi Kanan (Foto Profil, Dropdown) -->
    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
      <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

        @php
          use App\Models\Komunitas;
          use Illuminate\Support\Facades\Auth;

          $user = Auth::user();
          $role = $user->role ?? null;

          // Ambil foto profil komunitas jika login sebagai komunitas
          if ($role === 'komunitas') {
              $komunitas = Komunitas::where('id_user', $user->id_user)->first();
              $foto = $komunitas && $komunitas->foto
                      ? $komunitas->foto
                      : 'https://api.dicebear.com/7.x/initials/svg?seed=' . urlencode($user->name ?? 'Ecozyne');
          } else {
              // Gunakan default avatar untuk admin atau lainnya
              $foto = asset('assets/images/profile/users.png');
          }
        @endphp

        <!-- Dropdown Profil -->
        <li class="nav-item dropdown">
          <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
             aria-expanded="false">
            <img src="{{ $foto }}" alt="Foto Profil" width="40" height="40" class="rounded-circle">
          </a>

          <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
            <div class="message-body">

              <!-- Hanya tampilkan XP jika role adalah komunitas -->
              @if ($user && session('role') === 'komunitas' && $user->komunitas)
                <a href="{{ url('dashboard/index') }}" class="d-flex align-items-center gap-2 dropdown-item">
                  <i class="fas fa-star fs-4" style="color: #ffc107;"></i>
                  <div>
                    @php
                      $point = $user->komunitas->point->point ?? 0;
                    @endphp
                    <p class="mb-0 fs-3 fw-bold">{{ $point }} XP</p>
                  </div>
                </a>
              @endif

              <!-- Link Beranda hanya untuk komunitas -->
              @if ($role === 'komunitas')
                <a href="{{ url('/') }}" class="d-flex align-items-center gap-2 dropdown-item">
                  <i class="fas fa-home fs-4" style="color: #385bf4;"></i>
                  <p class="mb-0 fs-3">Beranda</p>
                </a>
              @endif

              <!-- Link ke profil pribadi -->
              <a href="{{ $role === 'admin' ? url('admin/my-profile') : url('dashboard/my-profile') }}"
                 class="d-flex align-items-center gap-2 dropdown-item">
                <i class="fas fa-user fs-4" style="color: #03af37;"></i>
                <p class="mb-0 fs-3">Profil Saya</p>
              </a>

              <!-- Tombol Logout -->
              <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-outline-danger mx-3 mt-3 d-block">Logout</button>
              </form>

            </div>
          </div>
        </li>
      </ul>
    </div>
  </nav>
</header>
