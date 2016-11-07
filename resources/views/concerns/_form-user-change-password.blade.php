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
  {!! Form::formPassword('old_password', ['label' => 'Password Lama', 'placeholder' => 'Masukkan Password Lama Anda'] ) !!}
  {!! Form::formPassword('password', ['label' => 'Password Baru', 'placeholder' => 'Masukkan Password Baru Anda'] ) !!}
  {!! Form::formPassword('password_confirmation', ['label' => 'Konfirmasi Password', 'placeholder' => 'Masukkan Password Baru Anda Kembali'] ) !!}
  {!! Form::reset('Reset', ['class' => 'btn btn-danger btn-lg pull-left']); !!}
  {!! Form::submit('Simpan', ['class' => 'btn btn-primary btn-lg pull-right']); !!}
{!! Form::close() !!}
