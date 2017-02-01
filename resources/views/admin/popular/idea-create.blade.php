@extends('admin.popular.layout')
@section('popular-content')
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Add Idea</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      @include('admin.popular.concerns.form-idea-create')
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
@endsection
