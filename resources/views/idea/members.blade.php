@extends('idea.layout')
@section('idea-content')
  <div class="row col-xs-12">
    <div class="card col-xs-12 primary z-depth-3">
      <div class="card-content white-text text-xs-center">
        <h2>Anggota dari {{ $idea->title }}</h2>
      </div>
    </div>
  </div>
  <div class="row col-xs-12 grid">
    @forelse($users as $user)
      <div class="grid-item col-xs-12 col-md-4">
        @include('user.card', $user)
      </div>
    @empty
      <h4 class="text-xs-center text-muted">-- Tidak ada user yang ditemukan --</h4>
    @endforelse
  </div>
  @if($users->hasMorePages())
    <div class="grid-item read-more hidden">
      <a href="{{ $users->nextPageUrl() }}"></a>
    </div>
  @endif
@endsection