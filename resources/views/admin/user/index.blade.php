@extends('admin.user.layout')
@section('user-content')
  <div class="box">
    <div class="box-header">
      <h2 class="box-title">Data User</h2>
      <div class="col-md-1 pull-right">
        <a href="{{ route('admin.user.create') }}" class="btn btn-success btn-flat btn-block">
        <i class="fa fa-plus"></i> Create </a>  
      </div>
      
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
          <th data-visible="false" data-width="10%">ID</th>
          <th data-visible="true" data-width="10%">Nama</th>
          <th data-visible="true" data-width="10%">Username</th>
          <th data-visible="true" data-width="10%">Email</th>
          <th data-visible="true" data-width="10%">Gender</th>
          <th data-visible="false" data-width="10%">Confirmed Status</th>
          <th data-visible="true" data-width="10%">Role</th>
          <th data-visible="false" data-width="10%">Freeze Until</th>
          <th data-visible="false" data-width="10%">Updated At</th>
          <th data-visible="false" data-width="10%">Created At</th>
          <th data-visible="true" data-width="20%">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
          <td>{{ $user->id }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->username }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ ucfirst($user->gender) }}</td>
          <td>
            @if($user->confirmed)
              <span class="label label-success">Confirmed</span>
            @else
              <span class="label label-danger">Not confirmed</span>
            @endif
          </td>
          <td>{{ $user->role }}</td>
          <td>{{ $user->freeze }}</td>
          <td>{{ $user->updated_at }}</td>
          <td>{{ $user->created_at }}</td>
          <td>
            <a href="{{ route('admin.user.edit', $user) }}" class="btn btn-success btn-flat">Edit</a>
            @include('admin.user.concerns.form-delete', compact('user'))
          </td>
        </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
          <th data-visible="false" data-width="10%">ID</th>
          <th data-visible="true" data-width="10%">Nama</th>
          <th data-visible="true" data-width="10%">Username</th>
          <th data-visible="true" data-width="10%">Email</th>
          <th data-visible="true" data-width="10%">Gender</th>
          <th data-visible="false" data-width="10%">Confirmed Status</th>
          <th data-visible="true" data-width="10%">Role</th>
          <th data-visible="false" data-width="10%">Freeze Until</th>
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
