@extends('user.layout')
@section('user-content')
  <div class="grid row">
    @forelse($ideas as $idea)
      <div class="grid-item col s12 m3">
        @include('idea.card', $idea)
      </div>
    @empty
      <div class="grid-item col s12 m12">
        <h5 class="center-align text-muted">-- Tidak ada ide yang ditemukan --</h5>
      </div>
    @endforelse
    @if($ideas->hasMorePages())
      <div class="grid-item read-more hidden">
        <a href="{{ $ideas->nextPageUrl() }}"></a>
      </div>
    @endif
  </div>
@endsection