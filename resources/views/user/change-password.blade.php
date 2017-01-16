@extends('user.layout')
@section('user-content')
  <div class="col-xs-12 col-sm-12 col-md-10 offset-md-1">
    <div class="card z-depth-3">
      <div class="card-panel row">
        <div class="col-xs">
          <h3 class="text-xs-center">
            Ganti password
          </h3>
          <hr>
          <br>
          @include('user.forms.change-password')
        </div>
      </div>
    </div>
  </div>
@endsection