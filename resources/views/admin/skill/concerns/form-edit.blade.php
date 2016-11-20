{!! Form::model($skill, ['route' => ['admin.skill.update', $skill], 'method' => 'PUT']) !!}
  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  {!! Form::formText('name', null, ['label' => 'Nama Kemampuan', 'placeholder' => 'Nama Kemampuan', 'required' => true] ) !!}
  {!! Form::formSelect('publish', ['Not Publish', 'Publish'], $skill->publish, ['label' => 'Publish'] ) !!}
  <a href="{{ route('admin.skill.index') }}" class="btn btn-warning btn-lg pull-left btn-flat">Back</a>
  {!! Form::submit('Save', ['class' => 'btn btn-primary btn-lg btn-flat pull-right']); !!}
{!! Form::close() !!}
