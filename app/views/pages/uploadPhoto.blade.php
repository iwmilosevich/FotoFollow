@extends('layouts.feedLayoutDefault')
@section('feedList')
<div class="row">
  <div class="col-md-6 col-md-offset-3">
  <div class="jumbotron">
    <h1>Upload Photo</h1>
    <p>Upload Photos to your feed. Select the feed you want to upload to 
    and the photo to upload, and it will be sent to all your followers</p>
  </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6 col-md-offset-3">
  {{ Form::open(['url' => 'uploadPhoto', 'files' => true, 'method' => 'post', 'class' => 'clearfix']) }}

  {{ Form::select('subscribeFeed', $subscribed, Input::old('subscribeFeed'), array('class' => 'btn btn-success center-block')) }}
  <br>

  {{ Form::file('image', array('class' => 'btn btn-success center-block')) }}
  <br>
  {{ Form::submit('Upload', array('class' => 'btn btn-lg btn-primary center-block')) }}
    <br>
  {{ Form::close() }}
</div>
</div>

</br>
@stop
