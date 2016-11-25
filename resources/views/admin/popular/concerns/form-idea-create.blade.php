{!! Form::open(['route' => ['admin.popular.idea.store', $popular], 'method' => 'POST']) !!}
  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  {!! Form::formSelect('idea', $ideas, null, ['label' => 'Idea Name'] ) !!}
  <a href="{{ route('admin.popular.show', $popular) }}" class="btn btn-warning btn-lg pull-left btn-flat">Back</a>
  {!! Form::submit('Add', ['class' => 'btn btn-primary btn-lg btn-flat pull-right']); !!}
{!! Form::close() !!}
