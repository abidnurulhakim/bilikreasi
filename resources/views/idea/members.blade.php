@extends('idea.layout')
@section('idea-content')
  <div class="col-md-12">
    <div class="card">
      <div class="card-block">
        @foreach($users as $user)
        <div class="text-center col-md-2 col-sm-6">
          <img src="{{ $user->getPhoto(160) }}" class="img-responsive img-circle"><br>
          <a href="{{ route('user.show', $user) }}" class="">{{ $user->name }}</a>
        </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection