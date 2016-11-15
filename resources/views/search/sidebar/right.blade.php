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
              <div class="col-md-12">
                <a href="#" class="btn btn-primary btn-xs">Like</a>
                @if(\Auth::check() && !$idea->members()->find(auth()->user()->id))
                <a href="{{ route('idea.join', $idea) }}" class="btn btn-primary btn-xs pull-right">Bergabung</a>
                @endif
              </div>
            </div>
          </div>
          <div class="col-md-7 col-padding idea">
            <div class="col-md-12 no-padding title">
              <span class="subject"><a href="{{ route('idea.show', $idea) }}">{{ str_limit($idea->title, 30)}} </a></span> &mdash;
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
              <!-- <a href="#" class="creator">Joshua</a> -->
            </div>
            <div class="col-md-12 no-padding category">
              <i class="fa fa-tags text-primary"></i> 
              @foreach($idea->tags->take(5) as $tag)
                <?php $labels = ['primary', 'danger', 'info', 'warning', 'success']?>
              <span class="label label-{{ $labels[array_rand($labels)] }}">{{ $tag->name }}</span>
              @endforeach
            </div>
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
          <p>Tidak ada ide yang ditemukan.</p>
        @endforelse
      </ul>
    </div>
  </div>
</div>