<!DOCTYPE HTML>
<html lang="en"><head>
  @include('includes.head')
  {{ HTML::style('css/home.css') }}    
  </head>

  <body>

    @include('includes.navbar')

    <div class="container">
      <div class="home-template">
        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">FotoFollow <span class="text-muted">Follow your photos</span></h2>
            <p class="lead">FotoFollow is a app about following your friends photos. </p>
            <a class='btn btn-primary btn-lg' href="{{ URL::to('login') }}">Login</a>
          </div>
          <div class="col-md-5">
          {{ Form::open(['url' => 'signUp', 'method' => 'post', 'class' => 'clearfix']) }}

          <!-- if there are login errors, show them here -->
          @if (Session::get('signUpError'))
          <div class="alert alert-danger alert-dismissable">{{ Session::get('signUpError') }}</div>
          @endif

          @if ($errors->first('username'))
          <div class="alert alert-danger alert-dismissable">
            {{ $errors->first('username') }}
          </div>
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


          <p>{{ Form::text('name', '', array('class' => 'form-control', 'placeholder' => 'Name')) }}</p>
          <p>{{ Form::text('username', '', array('class' => 'form-control', 'placeholder' => 'Username')) }}</p>
          <p>{{ Form::email('email', '', array('class' => 'form-control', 'placeholder' => 'Email')) }}</p>
          <p>{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}</p>
          <p>{{ Form::submit('Sign Up', array('class' => 'btn btn-primary')) }}</p> 
        {{ Form::close() }}
          </div>
        </div>
      </div>
    </div><!-- /.container -->

<div class="footer">
  @include('includes.footer')
</div>
</body></html>