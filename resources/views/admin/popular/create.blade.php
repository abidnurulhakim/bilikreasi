@extends('admin.popular.layout')
@section('popular-content')
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Create Popular</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      @include('admin.popular.concerns.form-create')
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
@endsection
