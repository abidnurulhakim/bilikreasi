@extends('admin.layout.app')

@section('dashboard-header')
  <h1>
    Dashboard Skill
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="{{ route('admin.skill.index') }}"><i class="fa fa-gears"></i> Skills</a></li>
  </ol>
@endsection

@section('admin-content')
  @yield('skill-content')
@endsection