<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-
scale=1, shrink-to-fit=no">

<meta name="description" content="">
<meta name="author" content="">
<title>Dream UP!!</title>
<!-- Custom fonts for this template-->

<link href="{{ asset('template/vendor/fontawesome-
free/css/all.min.css') }}" rel="stylesheet" type="text/css">

<link
href="https://fonts.googleapis.com/css?family=Nunito:200,200i,30
0,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
rel="stylesheet">

<!-- Custom styles for this template-->
<link href="{{ asset('template/css/sb-admin-2.min.css') }}"
rel="stylesheet">

<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
 @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Terjadi kesalahan!</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
</head>


<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper">
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">DREAM <sup>up!!</sup></div>
    </a>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">Menu</div>

    <!-- Dashboard -->
    <li class="nav-item">
        @if(Auth::user()->role === 'admin')
            <a class="nav-link" href="{{ route('admin') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard Admin</span>
            </a>
        @elseif(Auth::user()->role === 'kasir')
            <a class="nav-link" href="{{ route('kasir') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard Kasir</span>
            </a>
        @endif
    </li>

    <!-- Hanya untuk Admin -->
    @if(Auth::user()->role === 'admin')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('barang.index') }}">
                <i class="fas fa-box"></i>
                <span>Barang</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('pemasok.index') }}">
                <i class="fas fa-truck"></i>
                <span>Pemasok</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('pembelian.index') }}">
                <i class="fas fa-cart-plus"></i>
                <span>Pembelian</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('penjualan.index') }}">
                <i class="fas fa-cash-register"></i>
                <span>Penjualan</span>
            </a>
        </li>
    @endif

    <!-- Hanya untuk Kasir -->
    @if(Auth::user()->role === 'kasir')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('barang.index') }}">
                <i class="fas fa-box-open"></i>
                <span>Lihat Barang</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('penjualan.index') }}">
                <i class="fas fa-cash-register"></i>
                <span>Penjualan</span>
            </a>
        </li>
    @endif
</ul>

{{-- <!-- Divider -->
<hr class="sidebar-divider">
<!-- Heading -->
<div class="sidebar-heading">
Interface
</div> --}}
<!-- Nav Item - Utilities Collapse Menu -->
{{-- <li class="nav-item">

<a class="nav-link collapsed" href="#" data-
toggle="collapse" data-target="#collapseUtilities"

aria-expanded="true" aria-
controls="collapseUtilities">

<i class="fas fa-fw fa-wrench"></i>
<span>Utilities</span>
</a>

<div id="collapseUtilities" class="collapse"

aria-labelledby="headingUtilities"
data-parent="#accordionSidebar">

<div class="bg-white py-2 collapse-inner

rounded">

<h6 class="collapse-header">Custom
Utilities:</h6>
<a class="collapse-item"
href="utilities-color.html">Colors</a>
<a class="collapse-item"
href="utilities-border.html">Borders</a>
<a class="collapse-item"
href="utilities-animation.html">Animations</a>
<a class="collapse-item"
href="utilities-other.html">Other</a>
</div>
</div>
</li> --}}
</ul>
<!-- End of Sidebar -->
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
<!-- Main Content -->
<div id="content">
<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light
bg-white topbar mb-4 static-top shadow">
<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn
btn-link d-md-none rounded-circle mr-3">
<i class="fa fa-bars"></i>
</button>
<!-- Topbar Search -->
<form

class="d-none d-sm-inline-block form-
inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">

<div class="input-group">

<input type="text" class="form-
control bg-light border-0 small"

placeholder="Search for..."
aria-label="Search" aria-describedby="basic-addon2">
<div class="input-group-append">
<button class="btn btn-primary"
type="button">

<i class="fas fa-search fa-
sm"></i>

</button>
</div>
</div>
</form>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {$('#jenis_id').select2({dropdownParent: $('#addModal')});});
</script>

<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">
<!-- Nav Item - Search Dropdown (Visible
Only XS) -->

<li class="nav-item dropdown no-arrow d-
sm-none">

<a class="nav-link dropdown-toggle"
href="#" id="searchDropdown" role="button"

data-toggle="dropdown" aria-
haspopup="true" aria-expanded="false">

<i class="fas fa-search fa-
fw"></i>

</a>

<!-- Dropdown - Messages -->

<div class="dropdown-menu dropdown-
menu-right p-3 shadow animated--grow-in"

aria-
labelledby="searchDropdown">

<form class="form-inline mr-auto

w-100 navbar-search">
<div class="input-group">
<input type="text"
class="form-control bg-light border-0 small"
placeholder="Search
for..." aria-label="Search"

aria-
describedby="basic-addon2">

<div class="input-group-
append">

<button class="btn
btn-primary" type="button">
<i class="fas
fa-search fa-sm"></i>
</button>
</div>
</div>
</form>
</div>
</li>

<div class="topbar-divider d-none d-sm-
block"></div>

<!-- Nav Item - User Information -->
<li class="nav-item dropdown no-arrow">
<a class="nav-link dropdown-toggle"
href="#" id="userDropdown" role="button"

data-toggle="dropdown" aria-
haspopup="true" aria-expanded="false">

@if (Auth::check())
<span

class="mr-2 d-none d-lg-
inline text-gray-600 small">{{ Auth::user()->email }}</span>

@endif

<img class="img-profile rounded-
circle"

src="{{
asset('template/img/undraw_profile.svg') }}">
</a>

<!-- Dropdown - User Information -->

<div class="dropdown-menu dropdown-
menu-right shadow animated--grow-in"

aria-labelledby="userDropdown">
<a class="dropdown-item"

href="#">
<i class="fas fa-user fa-sm
fa-fw mr-2 text-gray-400"></i>
Profile
</a>

<a class="dropdown-item"

href="#">

<i class="fas fa-cogs fa-sm
fa-fw mr-2 text-gray-400"></i>
Settings
</a>

<a class="dropdown-item"

href="#">
<i class="fas fa-list fa-sm
fa-fw mr-2 text-gray-400"></i>
Activity Log
</a>

<div class="dropdown-
divider"></div>

<form method="POST" action="{{ url('/logout') }}">
    @csrf
    <button type="submit" class="dropdown-item">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        Logout
    </button>
</form>

</div>
</li>
</ul>
</nav>
<!-- End of Topbar -->
<!-- Begin Page Content -->
<div class="container-fluid">
@yield('content')
</div>

<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<!-- Footer -->
<footer class="sticky-footer bg-white">
<div class="container my-auto">
<div class="copyright text-center my-auto">
<span>Copyright &copy; Your Website
2020</span>
</div>
</div>
</footer>
<!-- End of Footer -->
</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>
<!-- Logout Modal-->
<form action="/logout" method="POST">
@csrf <!-- Include CSRF token for security
-->
</form>
<!-- Bootstrap core JavaScript-->
<script src="{{
asset('template/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{
asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js')
}}"></script>
<!-- Core plugin JavaScript-->

<script src="{{ asset('template/vendor/jquery-
easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('template/js/sb-admin-2.min.js')
}}"></script>
</body>
</html>