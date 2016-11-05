@extends('layout.app')

@section('content')
  @include('home.banner')
  <h2 class="text-center text-primary header-index">
    Trending Ide
  </h2>
  <br>
  @include('home.top-idea')
@endsection