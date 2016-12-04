@extends('idea.layout')
@section('idea-content')
  <div class="col-sm-12">
    @foreach ($users->chunk(2) as $chunk)
    <div class="row">
      @foreach ($chunk as $user)
      <div class="col-sm-4">
        @include('user.card', ['idea' => $idea, 'user' => $user])
      </div>
      @endforeach
    </div>
    @endforeach
    <div class="col-sm-12 text-center">
      {!! $users->links() !!}
    </div>
  </div>
@endsection