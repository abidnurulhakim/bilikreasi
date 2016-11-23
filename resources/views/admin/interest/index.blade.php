@extends('admin.interest.layout')
@section('interest-content')
  <div class="box">
    <div class="box-header">
      <h2 class="box-title">Data Interest</h2>
      <div class="col-md-1 pull-right">
        <a href="{{ route('admin.interest.create') }}" class="btn btn-success btn-flat btn-block">
        <i class="fa fa-plus"></i> Create </a>  
      </div>
      
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
          <th data-visible="false" data-width="10%">ID</th>
          <th data-visible="true" data-width="10%">Name</th>
          <th data-visible="true" data-width="10%">Slug</th>
          <th data-visible="true" data-width="10%">Publish</th>
          <th data-visible="false" data-width="10%">Updated At</th>
          <th data-visible="false" data-width="10%">Created At</th>
          <th data-visible="true" data-width="20%">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($interests as $interest)
        <tr>
          <td>{{ $interest->id }}</td>
          <td>{{ $interest->name }}</td>
          <td>{{ $interest->slug }}</td>
          <td>
            @if($interest->publish)
              <span class="label label-success">Published</span>
            @else
              <span class="label label-danger">Not published</span>
            @endif
          </td>
          <td>{{ $interest->updated_at }}</td>
          <td>{{ $interest->created_at }}</td>
          <td>
            @if($interest->publish)
              <a href="{{ route('admin.interest.unpublish', $interest) }}" class="btn btn-info btn-flat">Unpublish</a>
            @else
              <a href="{{ route('admin.interest.publish', $interest) }}" class="btn btn-info btn-flat">Publish</a>
            @endif
            <a href="{{ route('admin.interest.edit', $interest) }}" class="btn btn-success btn-flat">Edit</a>
            @include('admin.interest.concerns.form-delete', compact('interest'))
          </td>
        </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
          <th data-visible="false" data-width="10%">ID</th>
          <th data-visible="true" data-width="10%">Name</th>
          <th data-visible="true" data-width="10%">Slug</th>
          <th data-visible="true" data-width="10%">Publish</th>
          <th data-visible="false" data-width="10%">Updated At</th>
          <th data-visible="false" data-width="10%">Created At</th>
          <th data-visible="true" data-width="20%">Action</th>
        </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
@endsection
