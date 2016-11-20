<div class="col-md-8">
  <div class="card">
    <div class="card-block">
      <ul class="list-group">
        @forelse($ideas as $idea)
        <li class="list-group-item idea">
          <div class="col-md-3 col-padding">
            <div class="col-md-12 no-padding">
              <img class="img-responsive img-rounded img-idea-search" src="{{ $idea->getCover(160) }}">
              <br>
              <div class="col-md-12 text-center">
                @if(\Auth::check())
                  @unless($idea->hasLike(auth()->user()))
                    <a href="{{ route('idea.unlike', ['idea' => $idea, 'user' => auth()->user()]) }}" class="btn btn-primary"> <i class='fa fa-heart-o'></i> Suka </a>
                  @endunless
                @endif
              </div>
            </div>
          </div>
          <div class="col-md-7 col-padding idea">
            <div class="col-md-12 no-padding title">
              <span class="subject"><a href="{{ route('idea.show', $idea) }}">{{ $idea->title }} </a></span> &mdash;
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
            </div>
            <div class="col-md-12 no-padding category">
              <i class="fa fa-tags text-primary"></i> 
              @foreach($idea->tags->take(5) as $tag)
              <span class="label label-info">{{ $tag->name }}</span>
              @endforeach
            </div>
            <div class="col-md-12 no-padding status">
              <i class='fa fa-flag text-primary'></i> {{ ucfirst($idea::STATUS[$idea->status]) }}
            </div>
            @if($idea->like_count > 0)
            <div class="col-md-12 no-padding like">
              <i class='fa fa-heart text-primary'></i> {{ $idea->like_count }} orang
            </div>
            @endif
            <div class="col-md-12 no-padding location">
              <i class='fa fa-map-marker text-primary'></i> {{ $idea->location }}
            </div>
            <br><br>
            <div class="col-md-12 no-padding description">
              <p>{{ str_limit(strip_tags($idea->description), 300) }}</p>
            </div>
          </div>
          <div class="col-md-2 col-padding text-center">
            <a href="{{ route('user.show', $idea->user) }}">
              <img class="img-circle img-creator" src="{{ $idea->user->getPhoto(100) }}">
            </a>
            <br>
            <b>
              <a href="{{ route('user.show', $idea->user) }}" class="creator">{{ $idea->user->name }}</a>
            </b>
            <br>
            <br>
            <div class="col-md-12 text-center read-idea">
              <a href="{{ route('idea.show', $idea) }}" class="btn btn-primary">Baca</a>
            </div>
          </div>
        </li>
        @empty
          <h4 class="text-center text-muted">-- Tidak ada ide yang ditemukan --</h4>
        @endforelse
        <div class="col-md-12 text-center">
          {!! $ideas->links() !!}
        </div>
      </ul>
    </div>
  </div>
</div>