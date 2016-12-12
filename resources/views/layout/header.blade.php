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
        <img src="{{ asset('assets/images/logo.png') }}" alt="Bilikreasi">
      </a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navbar-collapse">
      <ul class="nav navbar-nav">
        <li class='dropdown category-idea'>
          <a href="#" class="text-center" data-toggle="dropdown">Kategori</a>
          <ul class="dropdown-menu">
            <div class="list-group">
              <a href="{{ route('search.index').'?category=business' }}" class="list-group-item"><i class="fa fa-money"></i> Usaha</a>
              <a href="{{ route('search.index').'?category=community' }}"" class="list-group-item"><i class="fa fa-users"></i> Komunitas</a>
              <a href="{{ route('search.index').'?category=campaign' }}"" class="list-group-item"><i class="fa fa-bullhorn"></i> Kampanye</a>
              <a href="{{ route('search.index').'?category=project' }}"" class="list-group-item"><i class="fa fa-suitcase"></i> Proyek</a>
              <a href="{{ route('search.index').'?category=event' }}"" class="list-group-item"><i class="fa fa-calendar"></i> Kegiatan</a>
              <a href="{{ route('search.index').'?category=other' }}"" class="list-group-item"><i class="fa fa-bars"></i> Lain</a>
            </div>
          </ul>
        </li>
        <li class="search-menu">
          @if(empty(app('request')->input('q')))
            {!! Form::open(['route' => ['search.index'], 'method' => 'GET', 'class' => 'searchbox']) !!}
          @else
            {!! Form::open(['route' => ['search.index'], 'method' => 'GET', 'class' => 'searchbox searchbox-open']) !!}
          @endif
            {!! Form::text('q', app('request')->input('q', ''), ['class' => 'searchbox-input', 'placeholder' => 'Cari Ide']) !!}
            <span class="input-group-btn searchbox-icon">
              <i class="fa fa-search"></i>
            </span>
          {!! Form::close() !!}
        </li>
      </ul>
      @if(\Auth::check())
      <ul class="nav navbar-nav user-menu-mobile hidden-sm hidden-md hidden-lg">
        <li class="list-group">
          <a href="{{ route('search.index').'?category=business' }}" class="list-group-item"><i class="fa fa-money"></i> Usaha</a>
          <a href="{{ route('search.index').'?category=community' }}"" class="list-group-item"><i class="fa fa-users"></i> Komunitas</a>
          <a href="{{ route('search.index').'?category=campaign' }}"" class="list-group-item"><i class="fa fa-bullhorn"></i> Kampanye</a>
          <a href="{{ route('search.index').'?category=project' }}"" class="list-group-item"><i class="fa fa-suitcase"></i> Proyek</a>
          <a href="{{ route('search.index').'?category=event' }}"" class="list-group-item"><i class="fa fa-calendar"></i> Kegiatan</a>
          <a href="{{ route('search.index').'?category=other' }}"" class="list-group-item"><i class="fa fa-bars"></i> Lain</a>
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
              <span>{{ str_limit(\Auth::user()->name, 30) }}</span>
              <span class="fa fa-caret-down fa-inverse"></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ \Auth::user()->getPhoto(100,100) }}" class="img-circle" alt="User Image">
                <p>
                  {{ \Auth::user()->name }}
                  <small>Bergabung sejakt {{ \Auth::user()->created_at->format('%B %Y') }}</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="list-group">
                  @if(auth()->user()->isAdmin())
                  <a href="{{ route('admin.index') }}" class="list-group-item"><i class="fa fa-dashboard"></i> Admin Dashboard</a>
                  @endif
                  <a href="{{ route('user.show', auth()->user()->username) }}" class="list-group-item"><i class="fa fa-home"></i> Beranda</a>
                  <a href="{{ route('idea.create') }}" class="list-group-item"><i class="fa fa-lightbulb-o"></i> Buat Ide Baru</a>
                  @if(\App\Models\IdeaMember::where('user_id', auth()->user()->id)->count() > 0)
                  <a href="{{ route('discussion.index') }}" class="list-group-item"><i class="fa fa-users"></i> Ruang Diskusi</a>
                  @endif
                  <a href="{{ route('user.edit', auth()->user()->username) }}" class="list-group-item"><i class="fa fa-pencil"></i> Perbaharui Profil</a>
                  <a href="{{ route('user.edit-password', auth()->user()->username) }}" class="list-group-item"><i class="fa fa-key"></i> Ganti Password</a>
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
                  {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Email/Username']) !!}
                </div>
                <div class="form-group">
                  {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                </div>
                <div class="form-group">
                  <div class="checkbox">
                    <label class="text-primary">
                      {!! Form::checkbox('remember_me', '1') !!} Ingatkan saya
                    </label>
                  </div>
                </div>
                <center>
                  {!! Form::submit('Masuk', ['class' => 'btn btn-primary btn-block']); !!}
                </center>
                <div class="form-group text-center text-muted">
                  <h5>atau</h5>
                </div>
                <a class="btn btn-block btn-social btn-facebook" href="{{ route('auth.social.facebook') }}">
                  <i class="fa fa-facebook"></i> Masuk dengan Facebook
                </a>
                <a class="btn btn-block btn-social btn-google" href="{{ route('auth.social.google') }}">
                  <i class="fa fa-google"></i> Masuk dengan Google
                </a>
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

