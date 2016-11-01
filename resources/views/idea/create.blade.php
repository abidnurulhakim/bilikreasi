@extends('idea.layout')
@section('idea-content')
  <div class="col-md-12">
    <div class="card">
      <div class="card-block">
        <div class="col-md-12 col-padding">
          @include('concerns._form-idea-create')
        </div>
      </div>
    </div>
  </div>
@endsection