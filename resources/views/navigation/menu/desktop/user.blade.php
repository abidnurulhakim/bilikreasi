<li class="user-menu">
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
    <a class='popover' href='#' data-placement="bottom">Masuk</a>
    <div class="webui-popover-content">
      {!! Form::open(['route' => 'session.login', 'method' => 'post', 'class' => 'col-md-12']) !!}
        <div class="materialize-input">
          <div class="input-field">
            {!! Form::text('username', null, ['id' => 'username_menu']) !!}
            {!! Form::label('username_menu', 'Username/Email') !!}
          </div>  
        </div>
        <div class="materialize-input">
          <div class="input-field">
            {!! Form::password('password', ['id' => 'password_menu']) !!}
            {!! Form::label('password_menu', 'Password') !!}
          </div>
        </div>
        <div class="materialize-input">
          <input type="checkbox" class="filled-in" id="remember_me_menu" value="1"/>
          <label for="remember_me_menu">Ingatkan saya</label>
        </div>
        {!! Form::submit('Masuk', ['class' => 'btn btn-flat btn-primary btn-block waves-effect waves-light']); !!}
        <div class="col-md hr-custom">
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
    <a href="{{ route('home.register') }}">Daftar</a>
  @endif
</li>