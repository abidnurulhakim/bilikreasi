@extends('admin.tag.layout')
@section('tag-content')
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Create Tag</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      @include('admin.tag.concerns.form-create')
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
@endsection
