{!! Form::open(['method' => 'DELETE', 'route' => ['admin.skill.destroy', $skill], 'class' => 'form-delete']) !!}
  {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-flat']) !!}
{!! Form::close() !!}