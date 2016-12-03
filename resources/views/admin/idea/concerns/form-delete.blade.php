{!! Form::open(['method' => 'DELETE', 'route' => ['admin.idea.destroy', $idea], 'class' => 'form-delete', 'onsubmit' => 'return confirm("Do you really want to delete this idea?")']) !!}
  {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-flat']) !!}
{!! Form::close() !!}