@extends('layouts.feedLayoutDefault')
@section('feedList')
{{ Form::open(['url' => 'uploadPhoto', 'files' => true, 'method' => 'post', 'class' => 'clearfix']) }}
<div class="form-group">
     <label class="col-sm-3 control-label">Image</label>
     <div class="col-sm-6">
         {{ Form::file('image') }}
     </div>
</div>
{{ Form::submit('Upload', array('class' => 'btn btn-primary')) }}</p>	
{{ Form::close() }}

</br>
@include('includes.feed-dropdown')
@stop
