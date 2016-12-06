@extends('layout.app')

@section('content')
  @yield('discussion-content')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection