@extends('discussion.layout')
@section('discussion-content')
  <div class="col-xs-12">
    @include('discussion.show-desktop')
    @include('discussion.show-mobile')
  </div>
@endsection
