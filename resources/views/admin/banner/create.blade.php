@extends('admin.banner.layout')
@section('banner-content')
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Create Banner</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      @include('admin.banner.concerns.form-create')
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
@endsection
