@extends('layouts.feedLayoutDefault')
@section('feedList')
	<div class="jumbotron text-center">
		<h2>{{ $feed->feedName }}</h2>
		<p>
			<strong>Description:</strong> {{ $feed->description }}
		</p>
	</div>
@stop
