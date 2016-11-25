{!! Form::open(['method' => 'DELETE', 'route' => ['admin.banner.destroy', $banner], 'class' => 'form-delete']) !!}
  {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-flat']) !!}
{!! Form::close() !!}