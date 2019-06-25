<!--Master Template-->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>LaravelApp</title>
		
		{{--Memanggil Bootstrap.
		Komentar ini tidak akan tampak di browser.--}}
		<link href="{{ asset
	('bootstrap_3_3_6/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('css/style.css') }}" rel="stylesheet">
		
		<!--[If It IE 9]>
		  <script src={{ asset
('http://laravelapp.dev/js/html5shiv_3_7_2.min.js') }}"></script>
		  <script src="{{ asset
('http://laravelapp.dev/js/respond_1_4_2.min.js') }}"></script>
		<![endif]-->
	</head>
	<body>
		<?php 
		$halaman = '';
		if (Request::segment(1) == 'siswa') {
			$halaman = 'siswa';
		}
		
		if (Request::segment(1) == 'about') {
			$halaman = 'about';
		}
		
		if (Request::segment(1) == 'kelas') {
			$halaman = 'kelas';
		}
		
		if (Request::segment(1) == 'hobi') {
			$halaman = 'hobi';
		}
		
		if (Request::segment(1) == 'user') {
			$halaman = 'user';
		}
		
		?>
		
		<div class="container">
			@include('navbar')
			@yield('main')
		</div>
		
		@yield('footer')
		
<script src="{{ asset('js/jquery_2_2_1.min.js') }}"></script>
<script src="{{ asset('bootstrap_3_3_6/css/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/laravelapp.js') }}"></script> <!--kode ini akan memasukkan skrip laravelapp.js yg sudah dibuat sebelumnya-->
</body>
</html>