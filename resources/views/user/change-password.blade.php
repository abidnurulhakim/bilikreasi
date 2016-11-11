@extends('user.layout')
@section('user-sidebar-left')
  @include('user.sidebar.left')
@endsection
@section('user-sidebar-right')
  <div class="col-md-8">
    <div class="card">
      <div class="card-header profile text-center">Ganti Password</div>
      <div class="card-block">
        @include('concerns._form-user-change-password')
      </div>
    </div>
  </div>
@endsection