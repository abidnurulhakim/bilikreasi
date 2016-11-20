{!! Form::open(['route' => ['admin.user.store'], 'method' => 'POST']) !!}
  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  {!! Form::formText('username', null, ['placeholder' => 'Masukkan Username Anda'] ) !!}
  {!! Form::formEmail('email', null, ['label' => 'Alamat Email', 'placeholder' => 'Masukkan Alamat Email Anda'] ) !!}
  {!! Form::formText('name', null, ['label' => 'Nama', 'placeholder' => 'Masukkan Nama Anda'] ) !!}
  {!! Form::formPassword('password', ['placeholder' => 'Masukkan Password Anda'] ) !!}
  {!! Form::formPassword('password_confirmation', ['label' => 'Konfirmasi Password', 'placeholder' => 'Masukkan Password Anda Kembali'] ) !!}
  {!! Form::formSelect('role', \App\Models\User::TYPE, 'user', ['label' => 'Role User', 'placeholder' => 'Role User'] ) !!}
  <a href="{{ route('admin.user.index') }}" class="btn btn-warning btn-lg pull-left btn-flat">Back</a>
  {!! Form::submit('Create', ['class' => 'btn btn-primary btn-lg btn-flat pull-right']); !!}
{!! Form::close() !!}
