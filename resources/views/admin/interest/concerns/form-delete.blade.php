{!! Form::open(['method' => 'DELETE', 'route' => ['admin.interest.destroy', $interest], 'class' => 'form-delete', 'onsubmit' => 'return confirm("Do you really want to delete this interest?")']) !!}]) !!}
  {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-flat']) !!}
{!! Form::close() !!}