@extends('layouts.feedLayoutDefault')
@section('feedList')
 	<div class="jumbotron text-center">
		<h2>{{ $user->username }}</h2>
		<p>
			<strong>Email:</strong> {{ $user->password }}
		</p>
	</div>
@stop
