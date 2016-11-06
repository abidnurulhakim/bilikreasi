{!! Form::model($user, ['route' => ['user.update', $user->username], 'method' => 'PUT', 'files' => true]) !!}
  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  {!! Form::formFile('photo', null, ['placeholder' => 'Masukkan Photo Anda', 'data-initial-preview-url' => '['.$user->photo.']', 'data-file-count' => '1'] ) !!}
  {!! Form::formText('name', null, ['label' => 'Nama', 'placeholder' => 'Masukkan Nama Anda'] ) !!}
  {!! Form::formRadio('gender', ['male' => 'Laki-laki', 'female' => 'Perempuan'], ['label' => 'Jenis Kelamin', 'checked' => 'male']) !!}
  {!! Form::formBirthDate('birthday', null, ['label' => 'Tanggal Lahir']) !!}
  {!! Form::formTags('interest', $userInterests, ['label' => 'Minat', 'collection' => $interests]) !!}
  {!! Form::formTags('skill', $userSkills, ['label' => 'Kemampuan', 'collection' => $skills]) !!}
  {!! Form::formText('phone_number', null, ['label' => 'Nomor Hp', 'placeholder' => 'Masukkan Nomor Handphone Anda'] ) !!}
  {!! Form::formPassword('password', ['placeholder' => 'Masukkan Password Anda'] ) !!}
  {!! Form::formPassword('password_confirmation', ['label' => 'Konfirmasi Password', 'placeholder' => 'Masukkan Password Anda Kembali'] ) !!}
  {!! Form::reset('Reset', ['class' => 'btn btn-danger btn-lg pull-left']); !!}
  {!! Form::submit('Simpan', ['class' => 'btn btn-primary btn-lg pull-right']); !!}
{!! Form::close() !!}
