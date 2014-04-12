@extends('layouts.feedCreateLayout')
@section('feedCreate')

{{ Form::open(['url' => 'feeds', 'method' => 'post', 'class' => 'clearfix']) }}
	<p>{{ Form::text('feedName', '', array('class' => 'form-control', 'placeholder' => 'Feed Name')) }}</p>
	<p>{{ Form::text('description', '', array('class' => 'form-control', 'placeholder' => 'Description')) }}</p>
	<p>{{ Form::submit('Create Feed', array('class' => 'btn btn-primary')) }}</p> 
{{ Form::close() }}

@stop
