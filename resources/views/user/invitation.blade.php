@extends('user.layout')
@section('user-content')
  <div class="nav-tab-custom">
    <ul class="nav-tabs">
      <li class="tab"><a href="{{ route('user.show', $user) }}"><i class="fa fa-lightbulb-o"></i> Ide Terhubung</a></li>
      <li class="tab active"><a href="{{ route('user.invitation', $user) }}"><i class="fa fa-envelope-o"></i> Undangan Bergabung</a></li>
      <hr class="tab-underline"/>
    </ul>
  </div>
  <div class="grid col-sm-12 no-padding">
    @include('user.profile-mini', $user)
    @forelse($invitations as $invitation)
      @php
        $idea = $invitation->idea;
        $user = null
      @endphp
      <div class="grid-item col-sm-3 col-padding">
        @include('idea.card', compact('idea', 'invitation', 'user'))
      </div>
    @empty
      <div class="grid-item col-sm-3 col-padding">
        <h4 class="text-center text-muted">-- Tidak ada ide yang ditemukan --</h4>
      </div>
    @endforelse
    @if($invitations->hasMorePages())
      <div class="grid-item read-more hidden">
        <a href="{{ $invitations->nextPageUrl() }}"></a>
      </div>
    @endif
  </div>
@endsection