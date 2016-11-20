@extends('admin.idea.layout')
@section('idea-content')
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Create Idea</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      @include('admin.idea.concerns.form-create')
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
@endsection
