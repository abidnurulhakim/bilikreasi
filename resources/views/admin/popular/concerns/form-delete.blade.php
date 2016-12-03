{!! Form::open(['method' => 'DELETE', 'route' => ['admin.popular.destroy', $popular], 'class' => 'form-delete', 'onsubmit' => 'return confirm("Do you really want to delete this popular?")']) !!}
  {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-flat']) !!}
{!! Form::close() !!}