{!! Form::open(['method' => 'DELETE', 'route' => ['admin.banner.destroy', $banner], 'class' => 'form-delete', 'onsubmit' => 'return confirm("Do you really want to delete this banner?")']) !!}
  {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-flat']) !!}
{!! Form::close() !!}