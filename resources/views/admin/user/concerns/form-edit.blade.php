{!! Form::model($user, ['route' => ['admin.user.update', $user], 'method' => 'PUT', 'files' => true]) !!}
  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  {!! Form::formFile('photo', null, ['placeholder' => 'Foto Anda', 'data-initial-preview-url' => '["'.$user->getPhoto().'"]', 'data-max-file-count' => '1', 'data-max-file-size' => '2048', 'data-allowed-file-types' => '["image", "video"]'] ) !!}
  {!! Form::formText('name', null, ['label' => 'Nama', 'placeholder' => 'Nama Anda'] ) !!}
  {!! Form::formRadio('gender', ['male' => 'Laki-laki', 'female' => 'Perempuan'], ['label' => 'Jenis Kelamin', 'checked' => 'male']) !!}
  {!! Form::formBirthDate('birthday', null, ['label' => 'Tanggal Lahir']) !!}
  {!! Form::formTags('interest', $interests, $userInterests, ['label' => 'Minat']) !!}
  {!! Form::formTags('skill', $skills, $userSkills, ['label' => 'Kemampuan']) !!}
  {!! Form::formText('profession', null, ['label' => 'Profesi', 'placeholder' => 'Profesi Anda'] ) !!}
  {!! Form::formText('live_at', null, ['label' => 'Tempat Tinggal', 'placeholder' => 'Kota Tempat Tinggal Anda'] ) !!}
  {!! Form::formText('phone_number', null, ['label' => 'Nomor Hp', 'placeholder' => 'Nomor Handphone Anda'] ) !!}
  {!! Form::formSelect('role', \App\Models\User::TYPE, null, ['label' => 'Role User', 'placeholder' => 'Role User'] ) !!}
  <a href="{{ route('admin.user.index') }}" class="btn btn-warning btn-lg pull-left btn-flat">Back</a>
  {!! Form::submit('Save', ['class' => 'btn btn-primary btn-lg pull-right btn-flat']); !!}
{!! Form::close() !!}
