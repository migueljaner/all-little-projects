<!DOCTYPE html>
<html>
<head>
	<title>UMAMI</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
</head>
<body>
	<div id="login">
		<div class="left_content">
			<div id="wallscreen">
				<img src="{{asset('img/wallpaper.jpg')}}">
				<div id="presentation">
					<h1>Bienvenido a tu perfil U-Circle.</h1>
					<h2>Vive aventuras inspiradoras en nuestra comunidad.</h2>
				</div>
			</div>
		</div>

		<div class="right_content">
			<div class="right_container">
				<div id="logo_space">
					<a href="#"><img src="{{asset('img/logo.png')}}"></a>
				</div>
				@yield('content')
				<footer>
					<p>
						©2019 UMAMI GROUP | Todos los derechos reservados | <a href="#">Aviso Legal</a>&nbsp; | Powered by <a href="#">W34 Marketing</a>
					</p>
				</footer>
			</div>
		</div>
	</div>
	<script src="{{asset('js/fbsdk.js')}}"></script>
</body>
</html>