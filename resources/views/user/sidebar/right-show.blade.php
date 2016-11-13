<div class="col-md-9">
  <div class="card">
    <div class="card-header profile text-center">Beranda</div>
    <div class="card-block">
      <!-- Nav tabs -->
      <div class='tabs-x tabs-above tab-bordered tab-align-right tab-height-lg tabs-krajee'>
        <ul id="myTab-5" class="nav nav-tabs" role="tablist">
          <li><a href="{{ route('idea.create') }}" role="tab"><i class="fa fa-plus"></i> Buat Ide Baru</a></li>
          <li class="active"><a href="{{ route('user.show', $user->username) }}" role="tab"><i class="fa fa-share-alt"></i> Ide Terhubung</a></li>
          <li><a href="#" role="tab"><i class="fa fa-envelope"></i> Permintaan Bergabung</a></li>
        </ul>
        <div id="myTabContent-5" class="tab-content">
          <div class="tab-pane fade in active" id="home-5">
            {{ Carbon::setLocale('id') }}
            @forelse ($ideas as $idea)
            <div class="col-md-4 col-padding">
              <div class="card">
                <div class="card-block">
                  <h4 class="card-title">
                    <a href="{{ route('idea.show', $idea) }}">{{ str_limit($idea->title, 18)}} </a> —
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
                  </h4>
                  <h6 class="card-subtitle text-muted">
                    <i class="fa fa-tags"></i> 
                    @foreach($idea->tags->take(3) as $tag)
                      <?php $labels = ['primary', 'danger', 'info', 'warning', 'success']?>
                    <span class="label label-{{ $labels[array_rand($labels)] }}">{{ $tag->name }}</span>
                    @endforeach
                  </h6>
                </div>
                <a href="{{ route('idea.show', $idea) }}">
                  <img src="{{ $idea->getCover(250, 150) }}" class='img-responsive' alt="{{ $idea->title }}">
                </a> —
                <div class="card-block">
                  <p class="card-text">{{ str_limit(strip_tags($idea->description), 150) }}</p>
                  <a href="{{ route('idea.show', $idea) }}" class="pull-right btn btn-primary">Baca</a>
                </div>
                <div class="card-footer text-muted">
                  <i class="fa fa-clock-o" aria-hidden="true"></i> Bergabung sejak <span class="time-humanize " title="{{ Carbon::parse($idea->members()->find($user->id)->pivot->join_at)->toIso8601String() }}"></span>
                </div>
              </div>
            </div>
            @empty
              <h4 class="text-center text-muted">-- Belum bergabung dengan ide manapun. --</h4>
            @endforelse
          </div>
        </div>
    </div>
    </div>
  </div>
</div>