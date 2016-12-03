{!! Form::open(['method' => 'DELETE', 'route' => ['admin.user.destroy', $user], 'class' => 'form-delete', 'onsubmit' => 'return confirm("Do you really want to delete this user?")']) !!}
  {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-flat']) !!}
{!! Form::close() !!}