<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ route('home.index') }}">
        <img src="http://lorempixel.com/150/50" alt="">
      </a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class='menubar active'>
          <a href="#">Cari Ide</a>
        </li>
        <li class='menubar'>
          <a href="#">Blog</a>
        </li>
        <li class='menubar'>
          <a href="#">Trending</a>
        </li>
      </ul>
      <ul class="nav navbar-nav pull-right">
        <!-- User Account: style can be found in dropdown.less -->
        @if(\Auth::check())
          <li class="dropdown user user-menu pull-right">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ \Auth::user()->getPhoto(100,100) }}" class="user-image" alt="User Image">
              <span class="hidden-xs">Alexander Pierce</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ \Auth::user()->getPhoto(100,100) }}" class="img-circle" alt="User Image">
                <p>
                  Alexander Pierce - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-12 text-center">
                    <a href="#">My Ideas</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('session.logout') }}" class="btn btn-default btn-flat">Keluar</a>
                </div>
              </li>
            </ul>
          </li>
        @else
          <li class='dropdown user-menu menubar-xs pull-right'>
            <a href="#" class="login" data-toggle="dropdown">Masuk</a>
            <ul class="dropdown-menu dropdown-login">
              {!! Form::open(['route' => 'session.login', 'method' => 'post']) !!}
                <div class="form-group">
                  {!! Form::text('username', old('username'), ['class' => 'form-control', 'placeholder' => 'Email/Username']) !!}
                </div>
                <div class="form-group">
                  {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                </div>
                <a href="{{ route('session.register') }}" class="btn btn-primary">Daftar</a>
                {!! Form::submit('Masuk', ['class' => 'btn btn-primary pull-right']); !!}
              {!! Form::close() !!}
            </ul>
          </li>
        @endif
        
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container -->
</nav>

