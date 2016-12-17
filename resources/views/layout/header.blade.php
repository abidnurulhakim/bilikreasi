<nav role="navigation">
  <div class="nav-wrapper container">
    <a id="logo-container" href="{{ route('home.index') }}" class="brand-logo">
      <img src="{{ asset('assets/images/logo.png') }}" alt="Bilikreasi">
    </a>
    <ul class="right hide-on-med-and-up menu-mobile">
      <li class="searchbox-mobile-icon"><i class="material-icons">search</i></li>
      <li><i class="fa fa-bell"></i></li>
    </ul>
    <ul class="right hide-on-med-and-down">
      <li class="dropdown-menubar">
        <a class='popover btn primary' href='#' data-placement="bottom">Kategory</a>
        <div class="webui-popover-content">
          <ul>
            <a href="{{ route('search.index', ['category' => 'bussiness']) }}">
              <li><i class="fa fa-money"></i> Usaha</li>
            </a>
            <a href="{{ route('search.index', ['category' => 'community']) }}">
              <li><i class="fa fa-users"></i> Komunitas</li>
            </a>
            <a href="{{ route('search.index', ['category' => 'campaign']) }}">
              <li><i class="fa fa-bullhorn"></i> Kampanye</li>
            </a>
            <a href="{{ route('search.index', ['category' => 'project']) }}">
              <li><i class="fa fa-suitcase"></i> Proyek</li>
            </a>
            <a href="{{ route('search.index', ['category' => 'event']) }}">
              <li><i class="fa fa-calendar"></i> Kegiatan</li>
            </a>
            <a href="{{ route('search.index', ['category' => 'other']) }}">
              <li><i class="fa fa-bars"></i> Lain</li>
            </a>
          </ul>
        </div>
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
      <li class="user-menubar">
        @if(auth()->check())
          <a class="popover right" href="#" data-placement="bottom-left">
            <img src="{{ auth()->user()->getPhoto(40) }}" class="circle responsive-img">
          </a>
          <div class="webui-popover-content">
            <ul>
              @if(auth()->user()->isAdmin())
              <a href="{{ route('admin.index') }}">
                <li><i class="fa fa-dashboard"></i> Admin Dashboard</li>
              </a>
              @endif
              <a href="{{ route('user.show', auth()->user()->username) }}">
                <li><i class="fa fa-home"></i> Beranda</li>
              </a>
              <a href="{{ route('idea.create') }}">
                <li><i class="fa fa-lightbulb-o"></i> Buat Ide Baru</li>
              </a>
              @if(\App\Models\IdeaMember::where('user_id', auth()->user()->id)->count() > 0)
              <a href="{{ route('discussion.index') }}">
                <li><i class="fa fa-comments"></i> Ruang Diskusi</li>
              </a>
              @endif
              <a href="{{ route('user.edit', auth()->user()->username) }}">
                <li><i class="fa fa-user"></i> Perbaharui Profil</li>
              </a>
              <a href="{{ route('user.edit-password', auth()->user()->username) }}">
                <li><i class="fa fa-key"></i> Ganti Password</li>
              </a>
              <br>
              <a href="{{ route('session.logout') }}" <a class="btn-flat btn-block btn-social primary">
                <i class="fa fa-sign-out"></i> Keluar
              </a>
            </ul>
          </div>
          <a class="right" href="{{ route('user.show', auth()->user())}}">
            {{ str_limit(auth()->user()->name, 15) }}
          </a>
        @else
          <a class='popover btn primary' href='#' data-placement="bottom">Masuk</a>
          <div class="webui-popover-content">
            {!! Form::open(['route' => 'session.login', 'method' => 'post', 'class' => 'col s12']) !!}
              <div class="row">
                <div class="input-field col s12">
                  {!! Form::text('username', null, ['id' => 'username']) !!}
                  {!! Form::label('username', 'Username/Email') !!}
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  {!! Form::password('password', ['id' => 'password']) !!}
                  {!! Form::label('password', 'Password') !!}
                </div>
              </div>
              <div class="row">
                <div class="col s12">
                  <input type="checkbox" class="filled-in" id="remember_me"/>
                  <label for="remember_me">Ingatkan saya</label>
                </div>
              </div>
              {!! Form::submit('Masuk', ['class' => 'btn btn-flat primary btn-block']); !!}
              <div class="col s12 col m12 hr-custom">
                <hr class="hr-or">
                <span class="span-or">atau</span>
              </div>
              <a class="btn btn-flat btn-block btn-social btn-facebook" href="{{ route('auth.social.facebook') }}">
                <i class="fa fa-facebook"></i> Masuk dengan Facebook
              </a>
              <a class="btn btn-flat btn-block btn-social btn-google-plus" href="{{ route('auth.social.google') }}">
                <i class="fa fa-google"></i> Masuk dengan Google
              </a>
            {!! Form::close() !!}
          </div>
          <a href="{{ route('home.register') }}" class="waves-effect waves-light btn primary">Daftar</a>
        @endif
      </li>
    </ul>
    <ul id="nav-mobile" class="side-nav">
      @include('layout.side-nav')
    </ul>
    <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
  </div>
</nav>
@if(empty(app('request')->input('q')))
  {!! Form::open(['route' => ['search.index'], 'method' => 'GET', 'class' => 'searchbox-mobile hide-on-med-and-up']) !!}
@else
  {!! Form::open(['route' => ['search.index'], 'method' => 'GET', 'class' => 'searchbox-mobile hide-on-med-and-up open']) !!}
@endif
  {!! Form::text('q', app('request')->input('q', ''), ['class' => 'searchbox-mobile-input', 'placeholder' => 'Cari Ide']) !!}
  <span class="input-group-btn searchbox-mobile-icon-submit">
    <i class="fa fa-search" type="submit"></i>
  </span>
{!! Form::close() !!}