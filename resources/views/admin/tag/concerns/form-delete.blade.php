{!! Form::open(['method' => 'DELETE', 'route' => ['admin.tag.destroy', $tag], 'class' => 'form-delete']) !!}
  {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-flat']) !!}
{!! Form::close() !!}