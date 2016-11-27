@extends('user.sidebar.right.layout')
@section('user.sidebar.right.content')
  <div class="box box-primary">
    <div class="box-body">
      @include('concerns._form-user-change-password')
    </div>
  </div>
@endsection
