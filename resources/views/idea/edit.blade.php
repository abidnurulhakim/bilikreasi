@extends('idea.layout')
@section('idea-content')
  <div class="col-xs-12 col-sm-12 col-md-10 offset-md-1">
    <div class="card z-depth-3">
      <div class="card-panel row">
        <div class="col-xs">
          <h3 class="text-xs-center">
            <b>Perbaharui</b> Ide
          </h3>
          <hr>
          <br>
          @include('idea.forms.update')
        </div>
      </div>
    </div>
  </div>
@endsection