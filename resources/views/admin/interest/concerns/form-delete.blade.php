{!! Form::open(['method' => 'DELETE', 'route' => ['admin.interest.destroy', $interest], 'class' => 'form-delete']) !!}
  {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-flat']) !!}
{!! Form::close() !!}