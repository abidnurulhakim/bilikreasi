{!! Form::model($user, ['route' => ['user.update', $user], 'method' => 'PUT', 'files' => true]) !!}
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
    <div class="col-xs-12 text-xs-center col-md-3">
      {!! Form::avatar('photo', $user->getPhoto(), []) !!}
    </div>
    <div class="col-xs-12 col-md-9">
      {!! Form::formMaterializeText('name', null, ['label' => 'Nama', ] ) !!}
      <div class="row col-xs">
        Jenis Kelamin
      </div>
      {!! Form::formMaterializeRadio('gender', ['male' => 'Laki-laki', 'female' => 'Perempuan'], ['checked' => [$user->gender]]) !!}
    </div>
    <div class="col-xs-12">
      {!! Form::formMaterializeBirthDate('birthday', null, ['label' => 'Tanggal Lahir']) !!}
      {!! Form::formTags('interests', $interests, $user->interests, ['label' => 'Minat']) !!}
      {!! Form::formTags('skills', $skills, $user->skills, ['label' => 'Kemampuan']) !!}
      {!! Form::formMaterializeText('profession', null, ['label' => 'Profesi', ] ) !!}
      {!! Form::formMaterializeText('live_at', null, ['label' => 'Tempat tinggal', ] ) !!}
      {!! Form::formMaterializeText('phone_number', null, ['label' => 'Nomor HP', ] ) !!}
    </div>
  </div>
  {!! Form::reset('Reset', ['class' => 'btn btn-danger btn-lg pull-left']); !!}
  {!! Form::submit('Simpan', ['class' => 'btn btn-primary btn-lg pull-right']); !!}
{!! Form::close() !!}
