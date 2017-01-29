{!! Form::open(['route' => ['session.login'], 'method' => 'post']) !!}
  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif  
  {!! Form::formMaterializeText('username', old('username'), ['label' => 'Username/Email Anda']) !!}
  {!! Form::formMaterializePassword('password', ['label' => 'Password']) !!}
  <br>
  <div class="materialize-input">
    <input type="checkbox" class="filled-in" id="remember_me" name="remember_me" value="1"/>
    <label for="remember_me">Ingatkan saya</label>
  </div>
  <br>
  <div class='col-xs'>
    Belum terdaftar? <a href="{{ route('home.register') }}">Daftar disini</a>
  </div>
  <br>
  {!! Form::submit('Masuk', ['class' => 'btn btn-primary btn-block']); !!}
{!! Form::close() !!}
