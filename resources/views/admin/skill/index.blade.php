@extends('admin.skill.layout')
@section('skill-content')
  <div class="box">
    <div class="box-header">
      <h2 class="box-title">Data Skill</h2>
      <div class="col-md-1 pull-right">
        <a href="{{ route('admin.skill.create') }}" class="btn btn-success btn-flat btn-block">
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
        @foreach($skills as $skill)
        <tr>
          <td>{{ $skill->id }}</td>
          <td>{{ $skill->name }}</td>
          <td>{{ $skill->slug }}</td>
          <td>
            @if($skill->publish)
              <span class="label label-success">Published</span>
            @else
              <span class="label label-danger">Not published</span>
            @endif
          </td>
          <td>{{ $skill->updated_at }}</td>
          <td>{{ $skill->created_at }}</td>
          <td>
            @if($skill->publish)
              <a href="{{ route('admin.skill.unpublish', $skill) }}" class="btn btn-info btn-flat">Unpublish</a>
            @else
              <a href="{{ route('admin.skill.publish', $skill) }}" class="btn btn-info btn-flat">Publish</a>
            @endif
            <a href="{{ route('admin.skill.edit', $skill) }}" class="btn btn-success btn-flat">Edit</a>
            @include('admin.skill.concerns.form-delete', compact('skill'))
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
