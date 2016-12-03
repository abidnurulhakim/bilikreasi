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
  {!! Form::formText('username', null, ['placeholder' => 'Masukkan Username Anda'] ) !!}
  {!! Form::formEmail('email', null, ['label' => 'Alamat Email', 'placeholder' => 'Masukkan Alamat Email Anda'] ) !!}
  {!! Form::formText('name', null, ['label' => 'Nama', 'placeholder' => 'Masukkan Nama Anda'] ) !!}
  {!! Form::formRadio('gender', ['male' => 'Laki-laki', 'female' => 'Perempuan'], ['label' => 'Jenis Kelamin', 'checked' => 'male']) !!}
  {!! Form::formBirthDate('birthday', null, ['label' => 'Tanggal Lahir']) !!}
  {!! Form::formPassword('password', ['placeholder' => 'Masukkan Password Anda'] ) !!}
  {!! Form::formPassword('password_confirmation', ['label' => 'Konfirmasi Password', 'placeholder' => 'Masukkan Password Anda Kembali'] ) !!}
  <div class="form-group">
    {!! Form::label('term_agreement', 'Syarat & Ketentuan', ['class' =>'col-sm-12 form-label', 'style' => 'padding-left: 0']) !!}
    <div class="checkbox">
      <label class="form-check-inline">
        {!! Form::checkbox('term_agreement', '1') !!} Saya setuju mengikuti syarat dan ketentuan yang berlaku. Syarat dan ketentuan dapat dilihat <a href="#">di sini</a>.
      </label>
    </div>
  </div>
  {!! Form::submit('Daftar', ['class' => 'btn btn-primary btn-lg btn-block']) !!}
{!! Form::close() !!}
