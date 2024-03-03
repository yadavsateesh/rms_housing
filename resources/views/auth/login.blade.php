<html>
	<head>
		<title>RMS Admin Login</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css/home.css">
		<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css">
	</head>
	<style type="text/css">
		.logo h1 {
		font-size: 35px;
		font-weight: 800;
		margin: 0;
		text-transform: uppercase;
		text-align: center;
		}
		.logo h1 a{
		color:#df453e;
		}
		.logo h1 a span{
		color:#1b3e41;
		}
		.logo h1 a:hover{
		text-decoration: none;
		}
	</style>
	<body>
	
		<div class="admin_login">
			<div class="logo">
				<h1><a href="">RMS<span>Housing</span></a></h1>
			</div>
			<h3 class="top_head">ADMIN LOGIN</h3>
			 <form method="POST" action="{{ route('login') }}">
				@csrf
				<div class="user">
					<i class="fas fa-user-circle"></i>
					 <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your Email">
					 
					 @error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				<div class="user">
					<i class="fas fa-lock-alt"></i>
					<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your Password" >
					@error('password')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
			
				<div class="admin_btn">
					<button type="submit" >Login</button>
				</div>
			</form>
			<p class="last">Forgot your password? 
			@if (Route::has('password.request'))
				<a href="{{ route('password.request') }}">
					{{ __('Reset Password ') }}
				</a>
			@endif </p>
		</div>
	</body>
</html>