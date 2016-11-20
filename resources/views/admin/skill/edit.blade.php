@extends('admin.skill.layout')
@section('skill-content')
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Edit Skill</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      @include('admin.skill.concerns.form-edit')
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
@endsection
