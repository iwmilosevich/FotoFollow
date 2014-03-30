<!doctype html>
<html>
<head>
	<title>FotoFollow</title>
</head>
<body>
	{{ Form::open(['url' => 'login', 'method' => 'post', 'class' => 'clearfix']) }}
		<h2>FotoFollow</h2>
		<!-- if there are login errors, show them here -->
		@if (Session::get('loginError'))
		<div class="alert alert-danger">{{ Session::get('loginError') }}</div>
		@endif

		<p>
			{{ $errors->first('email') }}
			{{ $errors->first('password') }}
		</p>

		<p>{{ Form::email('email', '', array('class' => 'form-control', 'placeholder' => 'Email')) }}</p>
		<p>{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}</p>
		<p>{{ Form::submit('Login', array('class' => 'btn btn-primary')) }}</p>
	{{ Form::close() }}
</body>
</html>