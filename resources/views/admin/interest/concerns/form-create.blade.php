{!! Form::open(['route' => ['admin.interest.store'], 'method' => 'POST']) !!}
  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  {!! Form::formText('name', null, ['label' => 'Nama Minat', 'placeholder' => 'Nama Minat', 'required' => true] ) !!}
  {!! Form::formSelect('publish', ['Not Publish', 'Publish'], null, ['label' => 'Publish'] ) !!}
  <a href="{{ route('admin.interest.index') }}" class="btn btn-warning btn-lg pull-left btn-flat">Back</a>
  {!! Form::submit('Create', ['class' => 'btn btn-primary btn-lg btn-flat pull-right']); !!}
{!! Form::close() !!}
