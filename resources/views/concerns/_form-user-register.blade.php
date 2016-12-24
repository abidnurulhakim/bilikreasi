{!! Form::open(['route' => 'session.register', 'method' => 'POST']) !!}
  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  {!! Form::formText('username', null, ['label' => 'Username'] ) !!}
  {!! Form::formEmail('email', null, ['label' => 'Alamat Email'] ) !!}
  {!! Form::formText('name', null, ['label' => 'Nama'] ) !!}
  <div class="col s12">
    {!! Form::formRadio('gender', ['male' => 'Laki-laki', 'female' => 'Perempuan'], ['label' => 'Jenis Kelamin', 'checked' => 'male']) !!}
  </div>
  {!! Form::formBirthDate('birthday', null, ['label' => 'Tanggal Lahir']) !!}
  {!! Form::formPassword('password', ['label' => 'Password Anda'] ) !!}
  {!! Form::formPassword('password_confirmation', ['label' => 'Konfirmasi Password'] ) !!}
  <div class="col s12">
    Syarat & Ketentuan
    <br>
    {!! Form::formCheckbox('term_agreement', 1, ['label' => 'Saya setuju mengikuti syarat dan ketentuan yang berlaku. Syarat dan ketentuan dapat dilihat']) !!}<a href="#">di sini</a>.
  </div>
  <div class="col s12">
    {!! Form::submit('Daftar', ['class' => 'btn btn-flat primary btn-block']) !!}
  </div>
{!! Form::close() !!}
