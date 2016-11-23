@extends('admin.layout.app')

@section('dashboard-header')
  <h1>
    Dashboard Interest
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="{{ route('admin.interest.index') }}"><i class="fa fa-heart"></i> Interests</a></li>
  </ol>
@endsection

@section('admin-content')
  @yield('interest-content')
@endsection