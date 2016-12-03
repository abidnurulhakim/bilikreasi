<div class="card idea">
  <div class="card-block">
    <h5 class="card-title">
      <a href="{{ route('idea.show', $idea) }}" class="title">{{ $idea->title }} </a> &mdash;
      @if($idea->category == 'business')
        <i class="fa fa-money text-primary" alt="business"></i>
      @elseif($idea->category == 'campaign')
        <i class="fa fa-bullhorn text-primary" alt="campaign"></i>
      @elseif($idea->category == 'community')
        <i class="fa fa-users text-primary" alt="community"></i>
      @elseif($idea->category == 'project')
        <i class="fa fa-gears text-primary" alt="project"></i>
      @elseif($idea->category == 'event')
        <i class="fa fa-calendar text-primary" alt="event"></i>
      @else
        <i class="fa fa-bookmark-o text-primary" alt="other"></i>
      @endif
    </h5>
    <h6 class="card-subtitle">
      <div class="col-md-1 col-sm-1 no-padding">
        <i class="fa fa-tags text-primary"></i>   
      </div>
      <div class="col-md-11 col-sm-11 col-padding">
        @foreach($idea->tags as $tag)
          <span class="label label-info">{{ $tag }}</span>
        @endforeach
      </div>
    </h6>
    @if($idea->like_count > 0)
    <h5 class="card-subtitle">
      <i class="fa fa-heart text-primary"></i> 
      {{ $idea->like_count }} Orang menyukai
    </h5>
    @endif
  </div>
  <a href="{{ route('idea.show', $idea) }}">
    <img src="{{ $idea->getCover(400, 200) }}" class='img-responsive' alt="{{ $idea->title }}">
  </a>
  <div class="card-block">
    <p class="card-text">{{ str_limit(strip_tags($idea->description), 150) }}</p>
    <a href="{{ route('idea.show', $idea) }}" class="btn btn-primary btn-block">Baca</a>
  </div>
  @unless(empty($user))
  <div class="card-footer text-muted">
    <i class="fa fa-clock-o" aria-hidden="true"></i> <small>Bergabung sejak <span class="time-humanize " title="{{ Carbon::parse($idea->members()->find($user->id)->pivot->join_at)->toIso8601String() }}"></span></small>
  </div>
  @endunless
</div>