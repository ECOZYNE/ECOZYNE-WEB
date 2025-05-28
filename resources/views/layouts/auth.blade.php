<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Ecozyne | Eco Enzyme Network')</title>

  <!-- SEO -->
  <meta name="description" content="Ecozyne - Sistem Pengelolaan Sampah dan Komunitas Berkelanjutan">
  <meta name="keywords" content="ecozyne, pengelolaan sampah, komunitas berkelanjutan, e-commerce">
  <meta name="author" content="Ecozyne Team">

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/ecozyne.png') }}" />

  <!-- CSS Lokal -->
  <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/styles-login.css') }}" />

  <!-- CDN CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />

  <!-- CDN JS untuk SweetAlert (di-head) -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  @stack('style')
</head>

<body>
  <x-loader />

  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    @yield('content')
  </div>

  <!-- JS Lokal -->
  <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

  @stack('scripts')
</body>

</html>