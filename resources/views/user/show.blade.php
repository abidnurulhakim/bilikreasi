@extends('user.layout')
@section('user-content')
  <div class="nav-tab-custom">
    <ul class="nav-tabs">
      <li class="tab active"><a href="{{ route('user.show', $user) }}"><i class="fa fa-lightbulb-o"></i> Ide Terhubung</a></li>
      <li class="tab"><a href="{{ route('user.invitation', $user) }}"><i class="fa fa-envelope-o"></i> Undangan Bergabung</a></li>
      <hr class="tab-underline"/>
    </ul>
  </div>
  <div class="grid col-sm-12 no-padding">
    @include('user.profile-mini', $user)
    @forelse($ideas as $idea)
      <div class="grid-item col-sm-3 col-padding">
        @include('idea.card', $idea)
      </div>
    @empty
      <div class="grid-item col-sm-3 col-padding">
        <h4 class="text-center text-muted">-- Tidak ada ide yang ditemukan --</h4>
      </div>
    @endforelse
    @if($ideas->hasMorePages())
      <div class="grid-item read-more hidden">
        <a href="{{ $ideas->nextPageUrl() }}"></a>
      </div>
    @endif
  </div>
@endsection