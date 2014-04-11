<!DOCTYPE HTML>
<html lang="en"><head>
  @include('includes.head')
  {{ HTML::style('css/home.css') }}    
  </head>

  <body>

    @include('includes.header')

    <div class="container">
      <div class="home-template">
        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">FotoFollow <span class="text-muted">The app for SnapChat.</span></h2>
            <p class="lead">FotoFollow is a helper app for SnapChat. It allows you to follow your friends, and
            express yourself. Don't get us wrong, we love SnapChat...but FotoFollow makes SnapChat better. Sign up
            today and see what we're talking about.</p>
            <a class='btn btn-primary btn-lg'>Login</a>
          </div>
          <div class="col-md-5">

           

          </div>
        </div>
      </div>
    </div><!-- /.container -->

<div class="footer">
  @include('includes.footer')
</div>
</body></html>