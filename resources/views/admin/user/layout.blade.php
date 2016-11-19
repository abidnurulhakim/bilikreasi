@extends('admin.layout.app')

@section('dashboard-header')
  <h1>
    Dashboard User
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><i class="fa fa-users"></i> Users</li>
  </ol>
@endsection

@section('admin-content')
  @yield('user-content')
@endsection