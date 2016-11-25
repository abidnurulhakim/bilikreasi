@extends('admin.popular.layout')
@section('popular-content')
  <div class="box">
    <div class="box-header">
      <h2 class="box-title">Data Popular</h2>
      <div class="col-md-1 pull-right">
        <a href="{{ route('admin.popular.create') }}" class="btn btn-success btn-flat btn-block">
        <i class="fa fa-plus"></i> Create </a>  
      </div>
      
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
          <th data-visible="false" data-width="10%">ID</th>
          <th data-visible="true" data-width="10%">Title</th>
          <th data-visible="true" data-width="10%">Slug</th>
          <th data-visible="true" data-width="10%">Publish</th>
          <th data-visible="true" data-width="10%">Order Number</th>
          <th data-visible="false" data-width="10%">Updated At</th>
          <th data-visible="false" data-width="10%">Created At</th>
          <th data-visible="true" data-width="20%">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($populars as $popular)
        <tr>
          <td>{{ $popular->id }}</td>
          <td>{{ $popular->title }}</td>
          <td>{{ $popular->slug }}</td>
          <td>
            @if($popular->publish)
              <span class="label label-success">Published</span>
            @else
              <span class="label label-danger">Not published</span>
            @endif
          </td>
          <td>{{ $popular->order_number }}</td>
          <td>{{ $popular->updated_at }}</td>
          <td>{{ $popular->created_at }}</td>
          <td>
            @if($popular->publish)
              <a href="{{ route('admin.popular.unpublish', $tag) }}" class="btn btn-info btn-flat">Unpublish</a>
            @else
              <a href="{{ route('admin.popular.publish', $tag) }}" class="btn btn-info btn-flat">Publish</a>
            @endif
            <a href="{{ route('admin.popular.edit', $tag) }}" class="btn btn-success btn-flat">Edit</a>
            @include('admin.popular.concerns.form-delete', compact('popular'))
          </td>
        </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
          <th data-visible="false" data-width="10%">ID</th>
          <th data-visible="true" data-width="10%">Title</th>
          <th data-visible="true" data-width="10%">Slug</th>
          <th data-visible="true" data-width="10%">Publish</th>
          <th data-visible="true" data-width="10%">Order Number</th>
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
