{!! Form::open(['method' => 'DELETE', 'route' => ['admin.skill.destroy', $skill], 'class' => 'form-delete', 'onsubmit' => 'return confirm("Do you really want to delete this skill?")']) !!}
  {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-flat']) !!}
{!! Form::close() !!}