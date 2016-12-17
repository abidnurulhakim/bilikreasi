
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Starter Template - Materialize</title>

  <!-- CSS  -->
  <link rel="stylesheet" href="{{ elixir('css/base.css') }}">
</head>
<body>
  <nav role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="#" class="brand-logo">
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
        <li class="dropdown-menubar">
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
        </li>
        <li>
          <a href="{{ route('home.register') }}" class="waves-effect waves-light btn primary">Daftar</a>
        </li>
      </ul>
      <ul id="nav-mobile" class="side-nav">
        {!! Form::open(['route' => 'session.login', 'method' => 'post', 'class' => 'col s12']) !!}
          <div class="row">
            <div class="input-field col s12">
              {!! Form::text('username', null, ['id' => 'username-sidenav']) !!}
              {!! Form::label('username-sidenav', 'Username/Email') !!}
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              {!! Form::password('password', ['id' => 'password-sidenav']) !!}
              {!! Form::label('password-sidenav', 'Password') !!}
            </div>
          </div>
          <div class="row">
            <div class="col s12">
              <input type="checkbox" class="filled-in" id="remember_me-sidenav"/>
              <label for="remember_me-sidenav">Ingatkan saya</label>
            </div>
          </div>
          {!! Form::submit('Masuk', ['class' => 'btn btn-flat primary btn-block']); !!}
          <div class="col s12 col m12 hr-custom">
            <hr class="hr-or">
            <span class="span-or">atau</span>
          </div>
          <a class="btn-flat btn-block btn-social btn-facebook" href="{{ route('auth.social.facebook') }}">
            <i class="fa fa-facebook"></i> Masuk dengan Facebook
          </a>
          <a class="btn-flat btn-block btn-social btn-google-plus" href="{{ route('auth.social.google') }}">
            <i class="fa fa-google"></i> Masuk dengan Google
          </a>
        {!! Form::close() !!}
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
  <div class="container">
    <section id="banners">
      <div class="banners">
        <div class="banner-item"><img class="responsive-img" src="http://lorempixel.com/1200/600/food/1"></div>
        <div class="banner-item"><img class="responsive-img" src="http://lorempixel.com/1200/600/food/2"></div>
        <div class="banner-item"><img class="responsive-img" src="http://lorempixel.com/1200/600/food/3"></div>
        <div class="banner-item"><img class="responsive-img" src="http://lorempixel.com/1200/600/food/4"></div>
      </div>
    </section>
    <section id="popular-idea" class="popular-idea">
      <div id="popular_idea_1" class="pushpin-block">
        <div class="pushpin" data-target="popular_idea_1">
        <h4 class="btn primary btn-block btn-flat">Ide Terbaru</h4>
        </div>
        <div class="pushpin-content">
          @foreach(App\Models\Idea::take(6)->get()->chunk(3) as $ideas)
          <div class="row idea-list">
            @foreach($ideas as $idea)
              <div class="col s12 m4">
                @include('idea.card', $idea)
              </div>
            @endforeach
          </div>
          @endforeach
        </div>
      </div>
      <div id="popular_idea_2" class="pushpin-block">
        <div class="pushpin" data-target="popular_idea_2">
        <h4 class="btn primary btn-block btn-flat">Ide Keren</h4>
        </div>
        <div class="pushpin-content">
          @foreach(App\Models\Idea::take(6)->offset(6)->get()->chunk(3) as $ideas)
          <div class="row idea-list">
            @foreach($ideas as $idea)
              <div class="col s12 m4">
                @include('idea.card', $idea)
              </div>
            @endforeach
          </div>
          @endforeach
        </div>
      </div>
    </section>
  </div>

  <footer class="page-footer teal">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Company Bio</h5>
          <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>


        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Settings</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Connect</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      Made by <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize</a>
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="{{ elixir('js/modernizr.min.js') }}"></script>
  <link rel="stylesheet" href="{{ elixir('css/application.css') }}">
  <script type="text/javascript"> var myPrefix = '{{ asset('') }}';</script>
  <script src="{{ elixir('js/application.js') }}"></script>
  </body>
</html>
