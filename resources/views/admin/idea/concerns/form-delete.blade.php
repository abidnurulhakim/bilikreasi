{!! Form::open(['method' => 'DELETE', 'route' => ['admin.idea.destroy', $idea], 'class' => 'form-delete']) !!}
  {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-flat']) !!}
{!! Form::close() !!}