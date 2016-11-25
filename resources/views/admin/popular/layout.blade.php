@extends('admin.layout.app')

@section('dashboard-header')
  <h1>
    Dashboard Tag
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="{{ route('admin.popular.index') }}"><i class="fa fa-bookmark"></i> Populars</a></li>
  </ol>
@endsection

@section('admin-content')
  @yield('popular-content')
@endsection