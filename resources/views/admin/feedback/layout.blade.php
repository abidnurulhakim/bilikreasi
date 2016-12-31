@extends('admin.layout.app')

@section('dashboard-header')
  <h1>
    Dashboard Feedback
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="{{ route('admin.feedback.index') }}"><i class="fa fa-envelope"></i> Feedbacks</a></li>
  </ol>
@endsection

@section('admin-content')
  @yield('feedback-content')
@endsection