{!! Form::open(['method' => 'DELETE', 'route' => ['admin.feedback.destroy', $feedback], 'class' => 'form-delete', 'onsubmit' => 'return confirm("Do you really want to delete this feedback?")']) !!}
  {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-flat']) !!}
{!! Form::close() !!}