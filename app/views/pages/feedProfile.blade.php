@extends('layouts.feedLayoutDefault')
@section('feedList')
	<div class="jumbotron text-center">
		<h2>{{ $feed->feedName }}</h2>
		<p>
			<strong>Description:</strong> {{ $feed->description }}
		</p> 
		<div class="row">
		@foreach($photos as $key => $value)
		<div class="col-md-3">
		{{HTML::image($value, "Image not loaded...", array('class' => 'img-responsive img-rounded', 'style' => 'width:200px; height:200px'));}}
		</div>

		@endforeach
		</div>
	</div>
	{{ Form::open(array('url' => 'feeds/' . $feed->id, 'class' => 'pull-right')) }}
		{{ Form::hidden('_method', 'DELETE') }}
		{{ Form::submit('Delete this Feed', array('class' => 'btn btn-warning')) }}
	{{ Form::close() }}
@stop
