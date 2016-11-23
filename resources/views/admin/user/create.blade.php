@extends('admin.user.layout')
@section('user-content')
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Create User</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      @include('admin.user.concerns.form-create')
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
@endsection
