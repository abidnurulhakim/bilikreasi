@extends('admin.tag.layout')
@section('tag-content')
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Edit Tag</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      @include('admin.tag.concerns.form-edit')
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
@endsection
