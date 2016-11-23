@extends('admin.layout.app')

@section('dashboard-header')
  <h1>
    Dashboard Idea
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="{{ route('admin.idea.index') }}"><i class="fa fa-lightbulb-o"></i> Ideas</a></li>
  </ol>
@endsection

@section('admin-content')
  @yield('idea-content')
@endsection