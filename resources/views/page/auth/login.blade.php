<!DOCTYPE html>
<html>
<head>
	<title>Đăng nhập</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('page/css/login.css') }}">
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="{{ asset('page/images/wave.png') }}">
	<div class="container">
		<div class="return-home">
			@if (count($errors) > 0)
				<div class="alert alert-invalid" >
					<strong>{{ $errors->first() }}</strong>
				</div>
			@endif
			@if(Session::has('invalid'))
				<div class="alert alert-invalid" >
					<strong>{{Session::get('invalid')}}</strong>
				</div>
			@endif
			@if(Session::has('success'))
				<div class="alert alert-success" >
					<strong>{{Session::get('success')}}</strong>
				</div>
			@endif
		</div>
		<div class="img">
			<img src="{{ asset('page/images/person.svg') }}">
		</div>
		<div class="login-content">
			<form action="{{ route('page.handle.login') }}" method="POST" enctype="multipart/form-data">
                @csrf
				<img src="{{ asset('page/images/avatar.svg') }}">
				<h2 class="title">Chào Bạn</h2>
				<div class="inf">
					<div class="input-div">
						<div class="i">
								<i class="fas fa-user"></i>
						</div>
						<div class="div">
								<h5>Email</h5>
								<input type="text" class="input" name='email'/>
						</div>
					</div>
					<div class="input-div">
						<div class="i"> 
								<i class="fas fa-lock"></i>
						</div>
						<div class="div">
								<h5>Mật Khẩu</h5>
								<input type="password" class="input" name="password" />
						</div>
					</div>
				</div>
            	<input type="submit" class="btn" value="Đăng Nhập">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('page/js/login.js') }}"></script>
</body>
</html>