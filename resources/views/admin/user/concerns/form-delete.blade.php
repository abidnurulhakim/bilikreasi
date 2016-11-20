{!! Form::open(['method' => 'DELETE', 'route' => ['admin.user.destroy', $user], 'class' => 'form-delete']) !!}
  {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-flat']) !!}
{!! Form::close() !!}