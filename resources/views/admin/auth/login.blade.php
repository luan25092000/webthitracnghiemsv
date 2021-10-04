<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Đăng nhập</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Css -->
    <link rel="stylesheet" href="{{asset('admin/css/login.css')}}" media="all" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{asset('favicon.ico')}}" />
</head>
<body>
    <div class="container">
      @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible mt-2">
          <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{ $errors->first() }}
        </div>
      @endif
      @if(Session::has('invalid'))
      <div class="alert alert-danger alert-dismissible">
           <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
           {{Session::get('invalid')}}
      </div>
      @endif
      @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible">
                <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{Session::get('success')}}
            </div>
      @endif
        <div class="row">
          <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
              <div class="card-body">
                <h5 class="card-title text-center">Đăng nhập</h5>
                <form class="form-signin" action="{{ route('auth.handle.login') }}" method="POST" enctype="multipart/form-data">

                  @csrf
                  
                  <div class="form-label-group">
                    <input type="email" id="inputEmail" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" autofocus>
                    <label for="inputEmail">Email</label>
                  </div>
    
                  <div class="form-label-group">
                    <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password">
                    <label for="inputPassword">Mật khẩu</label>
                  </div>
                  <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Đăng nhập</button>
                </form>
              </div>
            </div>
          </div>
        </div>
    </div>
</body>
</html>