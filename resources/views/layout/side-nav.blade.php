@if(auth()->check())
  <ul class="side-user-menu">
  <div class="row valign-wrapper">
    <div class="col s3">
      <img class="circle responsive-img valign" src="{{ auth()->user()->getPhoto(50) }}">  
    </div>
    <div class="col s9">
      <span class="black-text">
        {{ auth()->user()->name }}
      </span>
    </div>
  </div>
  @if(auth()->user()->isAdmin())
    <li>
      <a href="{{ route('admin.index') }}" class="list-item"><i class="fa fa-dashboard"></i> Admin Dashboard</a>
    </li>
  @endif
  <li>
    <a href="{{ route('user.show', auth()->user()->username) }}" class="list-item"><i class="fa fa-home"></i> Beranda</a>
  </li>
  <li>
    <a href="{{ route('idea.create') }}" class="list-item"><i class="fa fa-lightbulb-o"></i> Buat Ide Baru</a>
  </li>
  @if(\App\Models\IdeaMember::where('user_id', auth()->user()->id)->count() > 0)
    <li>
      <a href="{{ route('discussion.index') }}" class="list-item"><i class="fa fa-comments"></i> Ruang Diskusi</a>
    </li>
  @endif
  <li>
  <a href="{{ route('user.edit', auth()->user()->username) }}" class="list-item"><i class="fa fa-user"></i> Perbaharui Profil</a>
  </li>
  <li>
    <a href="{{ route('user.edit-password', auth()->user()->username) }}" class="list-item"><i class="fa fa-key"></i> Ganti Password</a>
  </li>
  <a href="{{ route('session.logout') }}" <a class="btn-flat btn-block btn-social primary">
    <i class="fa fa-sign-out"></i> Keluar
  </a>
  </ul>
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