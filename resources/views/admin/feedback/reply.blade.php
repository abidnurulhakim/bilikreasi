@extends('admin.skill.layout')
@section('skill-content')
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Reply Feedback</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      @include('admin.feedback.concerns.form-reply')
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
@endsection
