<!DOCTYPE HTML>
<html>
<head>
	@include('includes.head')
</head>
<body>
	{{ Form::open(['url' => 'login', 'method' => 'post', 'class' => 'clearfix']) }}
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
			<h2>FotoFollow</h2>
				<!-- if there are login errors, show them here -->
				@if (Session::get('loginError'))
				<div class="alert alert-danger alert-dismissable">{{ Session::get('loginError') }}</div>
				@endif

				@if ($errors->first('email'))
				<div class="alert alert-danger alert-dismissable">
					{{ $errors->first('email') }}
				</div>
				@endif

				@if ($errors->first('password'))
				<div class="alert alert-danger alert-dismissable">
					{{ $errors->first('password') }}
				</div>
				@endif

				<p>{{ Form::email('email', '', array('class' => 'form-control', 'placeholder' => 'Email')) }}</p>
				<p>{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}</p>
				<a class="btn btn-success" href="{{ URL::to('/') }}">Back</a>
				<p>{{ Form::submit('Login', array('class' => 'btn btn-primary')) }}</p>	
			{{ Form::close() }}
			</div>
			<div class="col-md-4"></div>
			</div>
		</div>

	<div class="footer">
	@include('includes.footer')
	</div>
</body>
</html>
