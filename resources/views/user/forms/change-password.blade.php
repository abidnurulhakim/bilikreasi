{!! Form::open(['route' => ['user.update-password', \Auth::user()->username], 'method' => 'POST']) !!}
  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  {!! Form::formMaterializePassword('old_password', ['label' => 'Password Lama'] ) !!}
  {!! Form::formMaterializePassword('password', ['label' => 'Password Baru'] ) !!}
  {!! Form::formMaterializePassword('password_confirmation', ['label' => 'Konfirmasi Password Baru'] ) !!}
  {!! Form::reset('Reset', ['class' => 'btn btn-danger pull-left']); !!}
  {!! Form::submit('Simpan', ['class' => 'btn btn-primary pull-right']); !!}
{!! Form::close() !!}
