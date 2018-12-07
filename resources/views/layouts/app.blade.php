<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Bootstrap core CSS -->
	<link href="{{ asset('css/backend_css/bootstrap.min.css') }}" rel="stylesheet">
	<!-- Material Design Bootstrap -->
	<link href="{{ asset('css/backend_css/mdb.min.css') }}" rel="stylesheet">
	<!-- Your custom styles (optional) -->
	<link href="{{ asset('css/backend_css/style.css') }}" rel="stylesheet">
	<!-- JQuery -->
	<script type="text/javascript" src="{{ asset('js/backend_js/jquery-3.3.1.min.js') }}"></script>
	<!-- Bootstrap tooltips -->
	<!-- <script type="text/javascript" src="{{ asset('js/backend_js/popper.min.js') }}"></script> -->
	<!-- Bootstrap core JavaScript -->
	<!-- <script type="text/javascript" src="{{ asset('js/backend_js/bootstrap.min.js') }}"></script> -->
	<!-- MDB core JavaScript -->
	<!-- <script type="text/javascript" src="{{ asset('js/backend_js/mdb.min.js') }}"></script> -->
</head>
<body>

	@if(!isset(Auth::user()->email))
		<script type="text/javascript">window.location = "/login";</script> 
	@endif
	<header>
		@section('navbar')
			@if(isset(Auth::user()->email) == true)
			<nav class="navbar navbar-expand-lg navbar-dark primary-color">
			  	<a href="{{ url('/home').'/'.Auth::id() }}" class="navbar-brand">{{ Auth::user()->name }}</a> 
			  	<div class="collapse navbar-collapse" id="basicExampleNav">
					<!-- Links -->
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
						</li>
					</ul>
					<!-- Links -->

					<div class="md-form my-0">
						<a href="{{ url('/logout') }}" class="btn btn-warning btn-sm pull-right">Logout <i class="fa fa-sign-out"></i></a>
					</div>
			  	</div>
			</nav>
			<!--/.Navbar-->
			@endif
		@show
	</header>
	<main>
		<div class="main mt-5">
		  	<div class="container">
			    <div class="row">
			      	<div class="col-lg-6 offset-lg-3">
				        <div class="card">
				          	<h5 class="card-header bg-primary info-color white-text text-center py-4">
				            	<strong>@yield('content-title')</strong>
				          	</h5>

				          	@yield('content')
				        </div>
			      	</div>
			    </div>
		  	</div>
		</div>
	</main>
	<footer class="page-footer text-center text-md-left font-small indigo pt-4 mt-4">
		<!--Copyright-->
		<div class="footer-copyright py-3 text-center">
		  	© 2018 Copyright:
		  	<a href="https://mdbootstrap.com/bootstrap-tutorial/"> MDBootstrap.com </a>
		</div>
		<!--/.Copyright-->
	</footer>
</body>
</html>