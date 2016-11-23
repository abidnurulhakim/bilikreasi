@extends('admin.idea.layout')
@section('idea-content')
  <div class="box">
    <div class="box-header">
      <h2 class="box-title">Data Idea</h2>
      <div class="col-md-1 pull-right">
        <a href="{{ route('admin.idea.create') }}" class="btn btn-success btn-flat btn-block">
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
          <th data-visible="true" data-width="10%">Owner</th>
          <th data-visible="true" data-width="10%">Total Like</th>
          <th data-visible="true" data-width="10%">Total Member</th>
          <th data-visible="false" data-width="10%">Updated At</th>
          <th data-visible="false" data-width="10%">Created At</th>
          <th data-visible="true" data-width="20%">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($ideas as $idea)
        <tr>
          <td>{{ $idea->id }}</td>
          <td>{{ $idea->title }}</td>
          <td>{{ $idea->slug }}</td>
          <td><a href="{{ route('user.show', $idea->user) }}">{{ $idea->user->name }}</a></td>
          <td>{{ $idea->like_count }}</td>
          <td>{{ $idea->member_count }}</td>
          <td>{{ $idea->updated_at }}</td>
          <td>{{ $idea->created_at }}</td>
          <td>
            <a href="{{ route('admin.idea.edit', $idea) }}" class="btn btn-success btn-flat">Edit</a>
            @include('admin.idea.concerns.form-delete', compact('idea'))
          </td>
        </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
          <th data-visible="false" data-width="10%">ID</th>
          <th data-visible="true" data-width="10%">Nama</th>
          <th data-visible="true" data-width="10%">Slug</th>
          <th data-visible="true" data-width="10%">Owner</th>
          <th data-visible="true" data-width="10%">Total Like</th>
          <th data-visible="true" data-width="10%">Total Member</th>
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
