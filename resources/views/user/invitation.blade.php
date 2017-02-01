@extends('user.layout')
@section('user-content')
  <div class="card z-depth-2">
    <div class="card-panel">
      <h3 class="text-xs-center">
        Undangan Bergabung
      </h3>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 grid">
      @forelse($invitations as $invitation)
        @php
          $idea = $invitation->idea 
        @endphp
        <div class="grid-item col-xs-12 col-md-4">
          @include('idea.card', $idea)
        </div>
      @empty
        <div class="grid-item col-xs-12 col-md-12">
          <div class="card z-depth-2">
            <div class="card-panel">
              <h4 class="text-xs-center text-muted">-- Belum ada undangan untuk bergabung --</h4>
            </div>
          </div>
        </div>
      @endforelse
      @if($invitations->hasMorePages())
        <div class="grid-item read-more hidden">
          <a href="{{ $invitations->nextPageUrl() }}"></a>
        </div>
      @endif
    </div>  
  </div>
@endsection