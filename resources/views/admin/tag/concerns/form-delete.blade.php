{!! Form::open(['method' => 'DELETE', 'route' => ['admin.tag.destroy', $tag], 'class' => 'form-delete', 'onsubmit' => 'return confirm("Do you really want to delete this delete?")']) !!}
  {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-flat']) !!}
{!! Form::close() !!}