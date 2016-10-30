@extends('layout.app')
@section('content')
  <div class='col-md-12'>
    @include('user.header')
  </div>
  <br><br><br><br><br><br><br><br>
  @yield('user-sidebar-left')
  @yield('user-sidebar-right')  
@endsection