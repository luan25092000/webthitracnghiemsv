@php
    $menus = config('template.sidebar');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Admin</title>
  <!-- plugins:css -->
  <!-- Custom CSS -->

  @yield('css')
  <link rel="stylesheet" href="{{ asset('admin') }}/vendors/feather/feather.css">
  <link rel="stylesheet"href="{{ asset('admin') }}/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet"href="{{ asset('admin') }}/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet"href="{{ asset('admin') }}/vendors/typicons/typicons.css">
  <link rel="stylesheet"href="{{ asset('admin') }}/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet"href="{{ asset('admin') }}/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet"href="{{ asset('admin') }}/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon"href="{{ asset('admin') }}/images/favicon.png" />
  

</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
        </div>
        <div>
          <a class="navbar-brand brand-logo" href="{{ route('dashboard.index') }}">
            <img src="{{ asset('admin') }}/images/logo.svg" alt="logo" />
          </a>
          <a class="navbar-brand brand-logo-mini"href="{{ route('dashboard.index') }}">
            <img src="{{ asset('admin') }}/images/logo-mini.svg" alt="logo" />
          </a>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top"> 
        <ul class="navbar-nav">
          <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
            <h1 class="welcome-text">Xin chào, <span class="text-black fw-bold">{{ ucfirst(Auth::guard('admin')->user()->name) }}</span></h1>          
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown d-none d-lg-block user-dropdown">
            <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <img class="img-xs rounded-circle" src="{{ asset('admin') }}/images/faces/face8.jpg" alt="Profile image">
             
            </a>
            
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <div class="dropdown-header text-center">
                <img class="img-md rounded-circle" src="{{ asset('admin') }}/images/faces/face8.jpg" alt="Profile image">
                <p class="mb-1 mt-3 font-weight-semibold">{{ ucfirst(Auth::guard('admin')->user()->name) }}</p>
                <p class="fw-light text-muted mb-0">{{ Auth::guard('admin')->user()->email }}</p>
              </div>
              
              <a class="dropdown-item" href="{{ route('auth.handle.logout') }}"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Đăng xuất</a>
            </div>
          </li>
        </ul>
        <h4 class="nav-link count-indicator">{{ ucfirst(Auth::guard('admin')->user()->name) }}</h4> 
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          @foreach ($menus as $menu)
          @if (!isset($menu['items']))       
          <li class="nav-item">
            <a class="nav-link" href="{{ route($menu['route']) }}">
              <i class="menu-icon mdi mdi-{{ $menu['icon'] }}"></i>
              <span class="menu-title">{{ $menu['label'] }}</span>
            </a>
          </li>           
          @else
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#{{ $menu['tag'] }}" aria-expanded="false" aria-controls="{{ $menu['tag'] }}">
              <i class="menu-icon mdi mdi-{{ $menu['icon'] }}"></i>
              <span class="menu-title">{{ $menu['label'] }}</span>
              <i class="menu-arrow"></i> 
            </a>
            <div class="collapse" id="{{ $menu['tag'] }}">
              <ul class="nav flex-column sub-menu">
                @foreach ($menu['items'] as $item)
                <li class="nav-item"> 
                  <a class="nav-link" href="{{ route($item['route'],['model'=>$item['model']]) }}" >{{ $item['label'] }}</a>
                </li>
                @endforeach
              </ul>
            </div>
          </li>
          @endif              
          @endforeach
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  
                  @yield('title')
                  @yield('main')
                </div>
              </div>
            </div> 
            @yield('support')
          </div>
        </div>     
      </div>
    </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block"></span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All rights reserved.</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset('admin') }}/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{ asset('admin') }}/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('admin') }}/js/off-canvas.js"></script>
  <script src="{{ asset('admin') }}/js/hoverable-collapse.js"></script>
  <script src="{{ asset('admin') }}/js/template.js"></script>
  <!-- Custom JS -->
  @yield('js')
  <!-- endinject -->
</body>

</html>
