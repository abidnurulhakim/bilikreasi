<ul id="nav-mobile" class="side-nav">
  @if(auth()->check())
  <li><div class="userView">
    <div class="background">
      <img src="">
    </div>
    <a href="#!user"><img class="circle" src=""></a>
    <a href="#!name"><span class="white-text name">John Doe</span></a>
    <a href="#!email"><span class="white-text email">jdandturk@gmail.com</span></a>
  </div></li>
  <li><a href="#!"><i class="material-icons">cloud</i>First Link With Icon</a></li>
  <li><a href="#!">Second Link</a></li>
  <li><div class="divider"></div></li>
  <li><a class="subheader">Subheader</a></li>
  <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
  @else
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
  @endif
</ul>
