<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/png" href="{{asset('page/images/logo.png')}}" />
    <title>Trắc nghiệm trực tuyến</title>
    <!-- Font Awaesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link type="text/css" rel="stylesheet" href="{{ asset('page/css/bootstrap.css') }}"/>
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.0/css/mdb.min.css" rel="stylesheet">
    <!-- Custom CSS here -->
    @yield('css')
    <link type="text/css" rel="stylesheet" href="{{ asset('page/css/style.css') }}"/>
    
    
    <script type="text/javascript" src="{{ asset('page/js/jquery-3.6.0.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</head>
<body>
    {{-- HEADER --}}
    <div class="navbar-dark bg-dark">
        <nav class="navbar navbar-expand-md container navbar-dark bg-dark">
            <a href="{{ route('page.index') }}" class="navbar-brand">
                <img style="background-color:white;border-radius:50px;" src="{{ asset('page/images/logo.png') }}" height="100" width="100" alt="CoolBrand">
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav menu-content">
                    <a href="{{ route('page.index') }}" class="nav-item nav-link active">Trang chủ</a>
                    @auth
                    <a href="{{ route('history') }}" class="nav-item nav-link">Lịch sử thi</a>
                    <a href="{{ route('feedback.create') }}" class="nav-item nav-link">Góp ý</a>
                    @endauth
                </div>
                <div class="navbar-nav ml-auto menu-content">
                  @auth
                    <a href="{{ route('page.handle.logout') }}" class="nav-item nav-link">
                    <i class="fas fa-sign-out-alt"></i>
                        Đăng xuất
                    </a>
                    <a href="?url=myself" class="nav-item nav-link">
                        <i class="fas fa-user-graduate"></i>
                        {{ Auth::user()->name }}
                    </a>
                  @endauth
                  @guest
                    <a href="{{ route('page.show.login') }}" class="nav-item nav-link">
                      <i class="fa fa-lock"></i>
                      Login
                    </a>
                  @endguest
                </div>
            </div>
        </nav>
    </div>
    {{-- END HEADER --}}
    @yield('main')
    {{-- FOOTER --}}
    <footer class="page-footer bg-dark">
        <div class="container text-center text-md-left mt-5">
          <div class="row">
      
            <div class="col-md-12 mx-auto mb-4">
              <hr class="bg-success mb-4 mt-0 d-inline-block mx-auto" style="width: 75px; height: 2px">
                <ul class="list-unstyled">
                  <li class="my-2"><i class="fas fa-home mr-3"></i> Cộng Hòa, phường 2, Tân Bình</li>
                  <li class="my-2"><i class="fas fa-envelope mr-3"></i> kmaABC@gmail.com</li>
                  <li class="my-2"><i class="fas fa-phone mr-3"></i> + 098765432</li>
                </ul>
            </div>
          </div>
        </div>
      
        <div class="footer-copyright text-center py-3">
          <p>&copy; Copyright
          <a href="#">kmaABC.com</a></p>
        </div>
    </footer>
    {{-- END FOOTER --}}
</body>
</html>