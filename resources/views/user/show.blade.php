@extends('user.layout')
@section('user-content')
  @include('user.card-profile', ['user' => $user])
  <div class="row">
    <div class="col-xs-12 grid">
      <div class="grid-item col-xs-12 col-md-4">
        <div class="card light-blue">
          <div class="card-content white-text">
            <h3>Tentang Saya!</h3>
            <p>{{ $user->about }}</p>
          </div>
          <br>
        </div>
      </div>
    
      @forelse($ideas as $idea)
        <div class="grid-item col-xs-12 col-md-4">
          @include('idea.card', $idea)
        </div>
      @empty
        <div class="grid-item col-xs-12 col-md-12">
          <div class="card z-depth-2">
            <div class="card-panel">
              <h4 class="text-center text-muted">-- Tidak ada ide yang ditemukan --</h4>
            </div>
          </div>
        </div>
      @endforelse
      @if($ideas->hasMorePages())
        <div class="grid-item read-more hidden">
          <a href="{{ $ideas->nextPageUrl() }}"></a>
        </div>
      @endif
    </div>  
  </div>
@endsection