@extends('user.layout')
@section('user-content')
  <div class="col-xs-12 col-sm-12 col-md-10 offset-md-1">
    <div class="card">
      <div class="card-panel row">
        <div class="col-xs">
          @include('user.forms.edit')
        </div>
      </div>
    </div>
  </div>
@endsection