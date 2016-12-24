@extends('idea.layout')
@section('idea-content')
  <div class="row">
    <div class="col s12 m10 offset-m1">
      <div class="card">
        <div class="card-panel">
          @include('concerns._form-idea-create')
        </div>
      </div>
    </div>
  </div>
@endsection