{!! Form::open(['route' => ['session.register'], 'method' => 'POST']) !!}
  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  {!! Form::formMaterializeText('username', null, ['label' => 'Username Anda'] ) !!}
  {!! Form::formMaterializeEmail('email', null, ['label' => 'Alamat Email'] ) !!}
  {!! Form::formMaterializeText('name', null, ['label' => 'Nama', ] ) !!}
  <br>
  <div class="row col-xs">
    Jenis Kelamin
  </div>
  {!! Form::formMaterializeRadio('gender', ['male' => 'Laki-laki', 'female' => 'Perempuan'], ['checked' => ['male']]) !!}
  {!! Form::formBirthDate('birthday', null, ['label' => 'Tanggal Lahir']) !!}
  {!! Form::formMaterializePassword('password', ['label' => 'Password'] ) !!}
  {!! Form::formMaterializePassword('password_confirmation', ['label' => 'Konfirmasi Password'] ) !!}
  <div class="row col-xs">
    Syarat & Ketentuan
    <br>
    <div class="materialize-input">
      <input type="checkbox" class="filled-in" id="term_agreement" value="1">
      <label for="term_agreement">Saya setuju mengikuti syarat dan ketentuan yang berlaku. Syarat dan ketentuan dapat dilihat</label> <a href="#">di sini</a>.
    </div>
  </div>
  {!! Form::submit('Daftar', ['class' => 'btn btn-primary btn-flat btn-block']) !!}
{!! Form::close() !!}
