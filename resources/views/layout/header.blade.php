<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ route('home.index') }}">
        <img src="http://lorempixel.com/150/50" alt="Bilikreasi">
      </a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navbar-collapse">
      <ul class="nav navbar-nav">
        <li class='dropdown category-idea'>
          <a href="#" class="text-center" data-toggle="dropdown">Kategori</a>
          <ul class="dropdown-menu">
            <div class="list-group">
              <a href="#" class="list-group-item"><i class="fa fa-money"></i> Usaha</a>
              <a href="#" class="list-group-item"><i class="fa fa-users"></i> Komunitas</a>
              <a href="#" class="list-group-item"><i class="fa fa-bullhorn"></i> Kampanye</a>
              <a href="#" class="list-group-item"><i class="fa fa-suitcase"></i> Proyek</a>
              <a href="#" class="list-group-item"><i class="fa fa-calendar"></i> Kegiatan</a>
              <a href="#" class="list-group-item"><i class="fa fa-bars"></i> Lain</a>
            </div>
          </ul>
        </li>
        <li class="search-input">
          {!! Form::open(['url' => '/', 'method' => 'get']) !!}
          <div class="input-group col-md-12">
            {!! Form::text('q', old('q'), ['class' => 'form-control input-lg', 'placeholder' => 'Cari Ide']) !!}
            <span class="input-group-btn">
              <button type='submit' class="btn btn-lg" type="button">
                <i class="fa fa-search"></i>
              </button>
            </span>
          </div>
          {!! Form::close() !!}
        </li>
      </ul>
      @if(\Auth::check())
      <ul class="nav navbar-nav user-menu-mobile hidden-sm hidden-md hidden-lg">
        <li class="list-group">
          <a href="#" class="list-group-item"><i class="fa fa-money"></i> Usaha</a>
          <a href="#" class="list-group-item"><i class="fa fa-users"></i> Komunitas</a>
          <a href="#" class="list-group-item"><i class="fa fa-bullhorn"></i> Kampanye</a>
          <a href="#" class="list-group-item"><i class="fa fa-suitcase"></i> Proyek</a>
          <a href="#" class="list-group-item"><i class="fa fa-calendar"></i> Kegiatan</a>
          <a href="#" class="list-group-item"><i class="fa fa-bars"></i> Lain</a>
        </li>
        <center>
          <a href="{{ route('session.logout') }}" class="btn btn-primary btn-lg">Keluar</a>  
        </center>
      </ul>
      @endif
      <ul class="nav navbar-nav pull-right hidden-xs">
        <!-- User Account: style can be found in dropdown.less -->
        @if(\Auth::check())
          <li class="dropdown user-menu pull-right hidden-xs">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ \Auth::user()->getPhoto(50) }}" class="img-circle" alt="User Image">
              <span>{{ \Auth::user()->name }}</span>
              <span class="fa fa-caret-down fa-inverse"></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ \Auth::user()->getPhoto(100,100) }}" class="img-circle" alt="User Image">
                <p>
                  {{ \Auth::user()->name }}
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="list-group">
                  <a href="#" class="list-group-item"><i class="fa fa-home"></i> Beranda</a>
                  <a href="#" class="list-group-item"><i class="fa fa-bell"></i> Notifikasi</a>
                  <a href="{{ route('user.edit', \Auth::user()->username) }}" class="list-group-item"><i class="fa fa-pencil"></i> Edit Profil</a>
                </div>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer text-center">
                <a href="{{ route('session.logout') }}" class="btn btn-primary btn-lg">Keluar</a>
              </li>
            </ul>
          </li>
        @else
          <li class="pull-right">
            <a href="{{ route('home.register') }}" class="btn btn-primary">Daftar</a>  
          </li>
          <li class='dropdown pull-right'>
            <a href="#" data-toggle="dropdown">Masuk</a>
            <ul class="dropdown-menu dropdown-login">
              {!! Form::open(['route' => 'session.login', 'method' => 'post']) !!}
                <div class="form-group">
                  {!! Form::text('username', old('username'), ['class' => 'form-control', 'placeholder' => 'Email/Username']) !!}
                </div>
                <div class="form-group">
                  {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                </div>
                <center>
                  {!! Form::submit('Masuk', ['class' => 'btn btn-primary btn-lg']); !!}
                </center>
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

