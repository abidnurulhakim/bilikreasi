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
  <div class="form-group">
    {!! Form::label('username', 'Username/Email') !!}
    {!! Form::text('username', old('username'), ['class' => 'form-control', 'placeholder' => 'Masukkan Username/Email Anda']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('password', 'Password') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
  </div>
  <div class='col-sm-12 no-padding'>
    Belum terdaftar? <a href="{{ route('home.register') }}">Daftar disini</a>
  </div>
  <br><br>
  <center>
    {!! Form::submit('Masuk', ['class' => 'btn btn-primary btn-lg']); !!}
  </center>
{!! Form::close() !!}
