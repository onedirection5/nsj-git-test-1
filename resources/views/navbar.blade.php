<nav class="navbar navbar-default">
<div class="container-fluid">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed"
				data-toggle="collapse"
				data-target="#bs-example-navbar-collapse-1"
				aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="{{url('/') }}">LaravelApp</a>
	</div>
	<div class="collapse navbar-collapse"
		id="bs-example-navbar-collapse-1">
		
	<ul class="nav navbar-nav">
	 {{-- Siswa --}}
	  @if (!empty($halaman) && $halaman == 'siswa')
		<li class="active"><a href="{{ url('siswa') }}">Siswa
		<span class="sr-only">(current)</span></a></li>
	  @else
		<li><a href="{{ url('siswa') }}">Siswa</a></li>
	  @endif
	  
	 {{-- Kelas --}}
	 @if (Auth::check())
	  @if (!empty($halaman) && $halaman == 'kelas')
		  <li class="active"><a href="{{ url('kelas') }}">Kelas
		  <span class="sr-only">(current)</span></a></li>
	  @else
		  <li><a href="{{ url('kelas') }}">Kelas</a></li>
	  @endif
	 @endif
	 
	  {{-- Hobi --}}
	 @if (Auth::check())
	  @if (!empty($halaman) && $halaman == 'hobi')
		  <li class="active"><a href="{{ url('hobi') }}">Hobi
		  <span class="sr-only">(current</span></a></li>
	  @else
		  <li><a href="{{ url('hobi') }}">Hobi</a></li>
	  @endif
	 @endif
	
	{{-- About --}}
	  @if (!empty($halaman) && $halaman == 'about')
		<li class="active"><a href="{{ url('about') }}">About
		<span class="sr-only">(current)</span></a></li>
	  @else
		<li><a href="{{ url('about') }}">About</a></li>
	  @endif

	{{-- User --}}
	@if (Auth::check() && Auth::user()->level == 'admin')
	  @if (!empty($halaman) && $halaman == 'user')
		  <li class="active"><a href="{{ url('user') }}">User
		  <span class="sr-only">(current)</span></a></li>
	  @else
		  <li><a href="{{ url('user') }}">User</a></li>
	  @endif
	 @endif
	</ul>
	
	{{-- Link Login --}}
	<ul class="nav navbar-nav navbar-right">
		@if (Auth::check())		<!--memeriksa apakah ada user yg sedang login. Jika ada maka lakukan perintah berikutnya-->
	<li><a href="{{ url('logout') }}">	<!--perintah untuk mendapatkan nama user yg login saat ini-->
	{{ Auth::user()->name }}</a></li>
		@else
			<li><a href="{{ url('login') }}">Login</a></li>	<!--jika tidak ada user yg login maka arahkan untuk login-->
		@endif
	</ul>
</div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>