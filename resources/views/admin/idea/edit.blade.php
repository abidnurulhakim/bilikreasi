@extends('admin.idea.layout')
@section('idea-content')
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Edit Idea</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      @include('admin.idea.concerns.form-edit')
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
@endsection
