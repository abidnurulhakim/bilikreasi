@extends('admin.tag.layout')
@section('tag-content')
  <div class="box">
    <div class="box-header">
      <h2 class="box-title">Data Tag</h2>
      <div class="col-md-1 pull-right">
        <a href="{{ route('admin.tag.create') }}" class="btn btn-success btn-flat btn-block">
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
        @foreach($tags as $tag)
        <tr>
          <td>{{ $tag->id }}</td>
          <td>{{ $tag->name }}</td>
          <td>{{ $tag->slug }}</td>
          <td>
            @if($tag->publish)
              <span class="label label-success">Published</span>
            @else
              <span class="label label-danger">Not published</span>
            @endif
          </td>
          <td>{{ $tag->updated_at }}</td>
          <td>{{ $tag->created_at }}</td>
          <td>
            @if($tag->publish)
              <a href="{{ route('admin.tag.unpublish', $tag) }}" class="btn btn-info btn-flat">Unpublish</a>
            @else
              <a href="{{ route('admin.tag.publish', $tag) }}" class="btn btn-info btn-flat">Publish</a>
            @endif
            <a href="{{ route('admin.tag.edit', $tag) }}" class="btn btn-success btn-flat">Edit</a>
            @include('admin.tag.concerns.form-delete', compact('tag'))
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
