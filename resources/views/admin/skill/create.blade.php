@extends('admin.skill.layout')
@section('skill-content')
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Create Skill</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      @include('admin.skill.concerns.form-create')
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
@endsection
