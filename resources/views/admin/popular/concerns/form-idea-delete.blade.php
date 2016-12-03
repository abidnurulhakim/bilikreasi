{!! Form::open(['method' => 'DELETE', 'route' => ['admin.popular.idea.destroy', $popularIdea], 'class' => 'form-delete', 'onsubmit' => 'return confirm("Do you really want to delete this popular idea?")']) !!}
  {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-flat']) !!}
{!! Form::close() !!}