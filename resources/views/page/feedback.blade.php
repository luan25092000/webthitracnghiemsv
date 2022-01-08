<!DOCTYPE html>
<html>
<head>
	<title>Góp ý</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('page/css/feedback.css') }}">
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="{{ asset('page/images/wave.png') }}">
	<div class="container">
        
        <div class="return-home"><a href="{{ route('page.index') }}"><i class="fas fa-angle-left"></i> Quay về trang chủ</a></div>
		<div class="img">
			<img src="{{ asset('page/images/person.svg') }}">
		</div>
		<div class="login-content">
            
			<form action="{{ route('feedback.store') }}" method="POST">
				@csrf
				<img src="{{ asset('page/images/avatar.svg') }}">
				<h3 class="title">LIÊN HỆ VỚI CHÚNG TÔI</h3>
				<div class="inf">
					<!-- user -->
					<div class="input-div focus">
						<div class="i">
								<i class="fas fa-user"></i>
						</div>
						<div class="div">
								<h5>Tên</h5>
								<input type="text"  value="{{ Auth::user()->name }}" class="input" required>
								<input type="hidden"  value="{{ Auth::user()->id }}" name="student_id" >
						</div>
					</div>
					<!-- email -->
					<div class="input-div focus">
						<div class="i"> 
								<i class="fas fa-at"></i>
						</div>
						<div class="div">
								<h5>Email</h5>
								<input type="email"  value="{{ Auth::user()->email }}" class="input" required>
						</div>
					</div>
					<!-- title -->
					<div class="input-div">
						<div class="i"> 
							<i class="fas fa-pen"></i>
						</div>
						<div class="div">
								<h5>Tiêu Đề</h5>
								<input type="text" name="title" value="{{ old('title') }}" class="input" required>
						</div>
					</div>
					<!-- content -->
					<div class="input-div">
						<div class="i"> 
							<i class="fas fa-file-alt"></i>
						</div>
						<div class="div text">
								<h5>Nội Dung</h5>
								<textarea   cols="30" rows="10" name="content" value="{{ old('content') }}" class="input" required></textarea>
						</div>
					</div>
				</div>
            	<input type="submit" class="btn" value="Gửi">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('page/js/feedback.js') }}"></script>
</body>
</html>