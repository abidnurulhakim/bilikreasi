@extends('admin.user.layout')
@section('user-content')
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Edit User</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      @include('admin.user.concerns.form-edit')
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
@endsection
