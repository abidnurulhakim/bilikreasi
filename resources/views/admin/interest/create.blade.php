@extends('admin.interest.layout')
@section('interest-content')
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Create Interest</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      @include('admin.interest.concerns.form-create')
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
@endsection
