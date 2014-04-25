@extends('layouts.feedLayoutDefault')
@section('feedList')
	<div class="jumbotron text-center">
		<h2>{{ $feed->feedName }}</h2>
		<p>
			<strong>Description:</strong> {{ $feed->description }}
		</p>
	</div>
	{{ Form::open(array('url' => 'feeds/' . $feed->id, 'class' => 'pull-right')) }}
		{{ Form::hidden('_method', 'DELETE') }}
		{{ Form::submit('Delete this Feed', array('class' => 'btn btn-warning')) }}
	{{ Form::close() }}
@stop
