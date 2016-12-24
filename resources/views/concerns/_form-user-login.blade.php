{!! Form::open(['route' => 'session.login', 'method' => 'post']) !!}
  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <div class="row">
    {!! Form::formText('username', old('username'), ['label' => 'Username/Email']) !!}
  </div>
  <div class="row">
    {!! Form::formPassword('password', old('password')) !!}
  </div>
  <div class="row">
    <div class="col s12">
      {!! Form::formCheckbox('remember_me', 1, ['label' => 'Ingatkan Saya']) !!}  
    </div>
  </div>
  <br>
  <button class="btn btn-flat primary btn-block" type="submit"><i class="fa fa-sign-in"></i> Masuk</button>
{!! Form::close() !!}