<ul id="nav-mobile" class="side-nav">
  @if(auth()->check())
  <li>
    <div class="userView text-xs-center">
      <div class="background">
        <img src="{{ asset('assets/images/background-user.jpg') }}">
      </div>
      <a href="{{ route('user.show', auth()->user()) }}"><img class="rounded-circle" src="{{ auth()->user()->getPhoto(64) }}"></a>
      <a href="{{ route('user.show', auth()->user()) }}"><span class="white-text name">{{ auth()->user()->name }}</span></a>
      <a href="{{ route('user.show', auth()->user()) }}"><span class="white-text email">{{ auth()->user()->email }}</span></a>
    </div>
  </li>
  @if(auth()->user()->isAdmin())
  <li>
    <a href="{{ route('admin.index') }}">
      <i class="fa fa-dashboard"></i> Admin Dashboard
    </a>
  </li>
  @endif
  <li>
    <a href="{{ route('user.show', auth()->user()->username) }}">
      <i class="fa fa-home"></i> Beranda
    </a>
  </li>
  <li>
    <a href="{{ route('idea.create') }}">
      <i class="fa fa-lightbulb-o"></i> Buat Ide Baru
    </a>
  </li>
  @if(\App\Models\IdeaMember::where('user_id', auth()->user()->id)->count() > 0)
  <li>
    <a href="{{ route('discussion.index') }}">
      <i class="fa fa-comments"></i> Ruang Diskusi
    </a>
  </li>
  @endif
  <li>
    <a href="{{ route('user.edit', auth()->user()->username) }}">
      <i class="fa fa-user"></i> Perbaharui Profil
    </a>
  </li>
  <li>
    <a href="{{ route('user.invitation', auth()->user()->username) }}">
      <i class="fa fa-envelope-open"></i> Undangan gabung
    </a>
  </li>
  <li>
    <a href="{{ route('user.edit-password', auth()->user()->username) }}">
      <i class="fa fa-key"></i> Ganti Password
    </a>
  </li>
  <div class="col-xs-12">
    <a href="{{ route('session.logout') }}" <a class="btn-flat btn-block btn-social primary">
      <i class="fa fa-sign-out"></i> Keluar
    </a>  
  </div>
  @else
  {!! Form::open(['route' => 'session.login', 'method' => 'post', 'class' => 'col-md-12']) !!}
    <div class="materialize-input">
      <div class="input-field">
        {!! Form::text('username', null, ['id' => 'username_side-nav']) !!}
        {!! Form::label('username_side-nav', 'Username/Email') !!}
      </div>  
    </div>
    <div class="materialize-input">
      <div class="input-field">
        {!! Form::password('password', ['id' => 'password_side-nav']) !!}
        {!! Form::label('password_side-nav', 'Password') !!}
      </div>
    </div>
    <div class="materialize-input">
      <input type="checkbox" class="filled-in" id="remember_me_side-nav" value="1"/>
      <label for="remember_me_side-nav">Ingatkan saya</label>
    </div>
    <div class="col-xs note text-muted">
      <span>Belum memiliki akun? Daftar di</span> <a href="{{ route('home.register') }}">sini</a>
    </div>
    {!! Form::submit('Masuk', ['class' => 'btn btn-flat btn-primary btn-block waves-effect waves-light']); !!}
    <div class="col-xs hr-custom">
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
  @endif
</ul>
