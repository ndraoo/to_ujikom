
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Perpustakaan Indonesia</title>

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('AdminLTE-3.2.0')}}/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="{{asset('AdminLTE-3.2.0')}}/dist/css/adminlte.min.css">

</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('logout') }}" class="nav-link">Logout</a>
          </li>
    </ul>
</nav>
  <!-- /.navbar -->
 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('AdminLTE-3.2.0')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Perpustakaan</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-header">Login : {{ Auth::user()->username }} </li>

          <li class="nav-header">Perpus</li>
        @if (Auth::user()->level == 'admin')
          <li class="nav-item">
            <a href="{{ route('admin.register.index') }}" class="nav-link">
              <i class="nav-icon fas fa-user-plus"></i>
              <p>
            Register
            </p>
            </a>
          </li>
          @endif

          @if (Auth::user()->level == 'admin')
          <li class="nav-item">
            <a href="{{ route('admin.buku.index') }}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Buku
              </p>
            </a>
          </li>
          @endif

          @if (Auth::user()->level == 'admin')
          <li class="nav-item">
            <a href="{{ route('admin.kategori.index') }}" class="nav-link">
              <i class="nav-icon fas fa-clipboard"></i>
              <p>
                Kategori Buku
              </p>
            </a>
          </li>
          @endif


          @if (Auth::user()->level == 'admin')
          <li class="nav-item">
            <a href="{{ route('admin.peminjaman.index') }}" class="nav-link">
              <i class="nav-icon fas fa-clipboard"></i>
              <p>
                Peminjaman
              </p>
            </a>
          </li>
          @endif

          @if (Auth::user()->level == 'petugas')
          <li class="nav-item">
            <a href="{{ route('petugas.buku.index') }}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Buku
              </p>
            </a>
          </li>
          @endif

          {{-- @if (Auth::user()->level == 'admin')
          <li class="nav-item">
            <a href="{{ route('admin.lelang.index') }}" class="nav-link">
              <i class="nav-icon fas fa-cart-arrow-down"></i>
              <p>
                Pelelangan
              </p>
            </a>
          </li>
          @endif --}}
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

    @yield('content')

  <footer class="main-footer">
    <strong>Copyright &copy; 2024 <a href="#">PerpustakaanOnline</a>.</strong>
    All rights reserved.

  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

@include('sweetalert::alert')

    <script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            confirmButtonText: 'OK'
        });
    @endif

    @if(session('error'))

        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ is_array(session('error')) ? implode("<br>", session('error')) : session('error') }}',
            confirmButtonText: 'OK'
        });

    @endif
    </script>
{{-- <!-- jQuery -->
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('AdminLTE-3.2.0')}}/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<!-- Bootstrap 4 -->
<script src="{{asset('AdminLTE-3.2.0')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{asset('AdminLTE-3.2.0')}}/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{asset('AdminLTE-3.2.0')}}/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{asset('AdminLTE-3.2.0')}}/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{asset('AdminLTE-3.2.0')}}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('AdminLTE-3.2.0')}}/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{asset('AdminLTE-3.2.0')}}/plugins/moment/moment.min.js"></script>
<script src="{{asset('AdminLTE-3.2.0')}}/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('AdminLTE-3.2.0')}}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<!-- overlayScrollbars -->
<script src="{{asset('AdminLTE-3.2.0')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App --> --}}
{{-- <script src="{{asset('AdminLTE-3.2.0')}}/dist/js/adminlte.js"></script> --}}
<!-- AdminLTE for demo purposes -->


{{-- <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script> --}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

<!-- Di dalam tampilan HTML Anda -->

</body>
</html>
