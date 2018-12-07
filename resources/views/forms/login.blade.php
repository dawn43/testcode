<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Bootstrap core CSS -->
	<link href="{{ asset('css/backend_css/bootstrap.min.css') }}" rel="stylesheet">
	<!-- Material Design Bootstrap -->
	<link href="{{ asset('css/backend_css/mdb.min.css') }}" rel="stylesheet">
	<!-- Your custom styles (optional) -->
	<link href="{{ asset('css/backend_css/style.css') }}" rel="stylesheet">
</head>
<body>
	<main>
		<div class="main mt-5">
		  	<div class="container">
			    <div class="row">
			      	<div class="col-lg-4 offset-lg-4">
				        <div class="card">
				          	<h5 class="card-header bg-primary info-color white-text text-center py-4">
				            	<strong>Please Login To Start The App</strong>
				          	</h5>
				          	<div class="card-body px-lg-5 pt-0">

				          		@if(isset(Auth::user()->email))
				          			<script type="text/javascript">window.location="/home/{{ Auth::user()->id }}"</script>
				          		@endif

				          		@if($message = Session::get('error'))
				          			<div class="alert alert-danger alert-block" style="margin-top: 30px;">
				          				<button type="button" class="close" data-dismiss="alert">x</button>
				          				<strong>{{ $message }}</strong>
				          			</div>
				          		@endif

				          		@if(count($errors) > 0)
								<div class="alert alert-danger" style="margin-top: 30px;">
									<ul>
										@foreach ($errors->all() as $error)
											<li><small>{{ $error }}</small></li>
										@endforeach
									</ul>
								</div>
								@endif
								
				          		<form method="post" action="{{ url('/login/process') }}" style="color: #757575; margin-top: 20px;">
				          			{{ csrf_field() }}
								  	<div class="form-group">
								  		<label>E-mail:</label>
								    	<input type="email" name="email" class="form-control">
								  	</div>

									<div class="form-group">
											<label>Password:</label>
										<input type="password" name="password" class="form-control">
									</div>
									<div class="text-center">
										<button class="btn btn-outline-info btn-rounded my-4 waves-effect z-depth-0" type="submit">Login</button>
									</div>
				          		</form>
				          	</div>
				        </div>
			      	</div>
			    </div>
		  	</div>
		</div>
	</main>

	<!-- JQuery -->
	<script type="text/javascript" src="{{ asset('js/backend_js/jquery-3.3.1.min.js') }}"></script>
	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="{{ asset('js/backend_js/popper.min.js') }}"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="{{ asset('js/backend_js/bootstrap.min.js') }}"></script>
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="{{ asset('js/backend_js/mdb.min.js') }}"></script>
</body>
</html>