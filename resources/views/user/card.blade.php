<div class="info-box">
  <span class="info-box-icon">
    <img src="{{ $user->getPhoto(110, 110) }}" alt="{{ $user->name }}" style="margin-top: -8px">
  </span>
  <div class="info-box-content text-primary">
    <span class="info-box-text"><a href="{{ route('user.show', $user) }}">{{ $user->name }}</a></span>
    <span class="info-box-text">
      <div class="col-sm-1 no-padding"><i class="fa fa-heart text-primary"></i></div>
      <div class="col-sm-10 no-padding">
        @foreach($user->interests as $interest)
          <span class="label label-primary">{{ $interest }}</span>
        @endforeach  
      </div>
    </span>
    <span class="info-box-text">
      <div class="col-sm-1 no-padding"><i class="fa fa-gears text-primary"></i></div>
      <div class="col-sm-10 no-padding">
        @foreach($user->skills as $skill)
          <span class="label label-primary">{{ $skill }}</span>
        @endforeach
      </div>
    </span>
    <span class="info-box-text">
    <div class="col-sm-1 no-padding"><i class="fa fa-suitcase text-primary"></i></div>
    <div class="col-sm-10 no-padding">{{ $user->profession }}</div>
    </span>
    <span class="info-box-text">
    <div class="col-sm-1 no-padding"><i class="fa fa-map-marker text-primary"></i></div>
    <div class="col-sm-10 no-padding">{{ $user->live_at }}</div>
    </span>
  </div>
  @if($idea->hasInvite($user) && !$idea->isMember($user))
    <a href="{{ route('idea.invitation.remove', [$idea, $user]) }}" class="btn btn-primary btn-block">Hapus Undangan</a>
  @elseif(!$idea->hasInvite($user) && !$idea->isMember($user))
    <a href="{{ route('idea.invitation', [$idea, $user]) }}" class="btn btn-primary btn-block">Undang</a>
  @endif
  <!-- /.info-box-content -->
</div>