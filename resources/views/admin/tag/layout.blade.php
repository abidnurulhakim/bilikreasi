@extends('admin.layout.app')

@section('dashboard-header')
  <h1>
    Dashboard Tag
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="{{ route('admin.tag.index') }}"><i class="fa fa-tags"></i> Tags</a></li>
  </ol>
@endsection

@section('admin-content')
  @yield('tag-content')
@endsection