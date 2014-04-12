<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ URL::to('feeds') }}">FotoFollow</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{ URL::to('userProfile') }}">Profile</a></li>
        <li class="dropdown">
          <a href="" class="dropdown-toggle" data-toggle="dropdown">Feeds <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="{{ URL::to('feeds') }}">Search Feed</a></li>
            <li><a href="{{ URL::to('feeds/create') }}">Create Feed</a></li>
            <li><a href="{{ URL::to('uploadPhoto') }}">Upload Photo</a></li>
          </ul>
        </li>
      <li><a href="{{ URL::to('logout') }}">Logout</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
