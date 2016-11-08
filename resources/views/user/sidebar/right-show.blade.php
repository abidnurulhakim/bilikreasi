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
            @forelse ($ideas as $idea)
            <div class="col-md-4 col-padding">
              <div class="card">
                <div class="card-block">
                  <h4 class="card-title">
                    <a href="{{ route('idea.show', $idea) }}">{{str_limit($idea->title, 18)}}</a> — <i class="fa fa-calendar text-primary" alt="event"></i>
                  </h4>
                  <h6 class="card-subtitle text-muted">
                    <i class="fa fa-tags"></i> 
                    @foreach($idea->tags as $tag)
                      {{ $labels = ['primary', 'danger', 'info', 'warning', 'success']}}
                    <span class="label label-{{ $labels[array_rand($labels)] }}">{{ $tag->name }}</span>
                    @endforeach
                  </h6>
                </div>
                <img src="{{ $idea->getCover(250) }}" class='img-responsive' alt="card image">
                <div class="card-block">
                  <p class="card-text">{{ str_limit($idea->description, 150) }}</p>
                  <a href="{{ route('idea.show', $idea) }}" class="pull-right btn btn-primary">Baca</a>
                </div>
                <div class="card-footer text-muted">
                  <i class="fa fa-clock-o" aria-hidden="true"></i> <span>bergabung sejak {{ $idea->members->find($user->id)->member_at->diffForHumans() }}</span>
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