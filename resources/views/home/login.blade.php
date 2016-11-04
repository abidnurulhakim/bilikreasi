@extends('layout.app')

@section('content')
  <div class="col-md-4 col-md-offset-4 col-sm-12">
    <div class="card">
      <div class="card-block">
        @include('concerns._form-user-login')
      </div>
    </div>
  </div>
@endsection