{!! Form::open(['method' => 'DELETE', 'route' => ['admin.popular.idea.destroy', $popularIdea], 'class' => 'form-delete']) !!}
  {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-flat']) !!}
{!! Form::close() !!}