{!! Form::open(['method' => 'DELETE', 'route' => ['admin.poular.destroy', $popular], 'class' => 'form-delete']) !!}
  {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-flat']) !!}
{!! Form::close() !!}