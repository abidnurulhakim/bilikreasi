<div class="card-container">
  <div class="card">
    <div class="front">
      <div class="cover">
        <img src="{{ asset('assets/images/background-user.jpg') }}"/>
      </div>
      <div class="user">
        <img class="rounded-circle" src="{{ $user->getPhoto(50)}}"/>
      </div>
      <div class="content">
        <div class="main">
          <h3 class="name">{{ $user->name }}</h3>
          <p class="profession">{{ $user->profession ? $user->profession : '-' }}</p>
          <p class="text-center">"{{ str_limit($user->about, 250) }}"</p>
        </div>
        <div class="footer row">
          @if(!$idea->hasInvite($user) && !$idea->isMember($user))
            <div class="col-xs">
              <a href="{{ route('idea.invitation', [$idea, $user]) }}" class="btn btn-primary btn-block">Undang</a>  
            </div>
          @endif
          <div class="col-xs">
            <a href="{{ route('user.show', $user) }}" class="btn btn-primary btn-block">Profil</a>
          </div>
        </div>
      </div>
    </div> <!-- end front panel -->
     <div class="back">
        <div class="content">
          <div class="main">
            <div class="row">
              <div class="stats col-xs">
                <h3>{{ $user->ideas()->count() }}</h3>
                <p>
                  Ide dibuat
                </p>
              </div>
              <div class="stats col-xs">
                <h3>{{ $user->memberOf()->count() }}</h3>
                <p>
                  Ide berpartisipai
                </p>
              </div>
            </div>
            <hr>
            <div class="row flex-items-xs-top">
              <div class="col-xs-1">
                <i class="fa fa-heart fa-lg"></i>
              </div>
              <div class="col-xs-11">
                @foreach(collect($user->interests)->take(10) as $interest)
                  <div class="chip tag-primary">{{ $interest }}</div>
                @endforeach  
              </div>
            </div>
            <hr>
            <div class="row flex-items-xs-top">
              <div class="col-xs-1">
                <i class="fa fa-gears fa-lg"></i>
              </div>
              <div class="col-xs-11">
                @foreach(collect($user->skills)->take(10) as $skill)
                  <div class="chip tag-primary">{{ $skill }}</div>
                @endforeach  
              </div>
            </div>
            <hr>
            <div class="row flex-items-xs-top">
              <div class="col-xs-1">
                <i class="fa fa-home fa-lg"></i>
              </div>
              <div class="col-xs-11">
                <div class="chip tag-primary">{{ $user->live_at ? $user->live_at : 'Indonesia'}}</div>
              </div>
            </div>
          </div>
        </div>
        <div class="footer row">
          @if(!$idea->hasInvite($user) && !$idea->isMember($user))
            <div class="col-xs">
              <a href="{{ route('idea.invitation', [$idea, $user]) }}" class="btn btn-primary btn-block">Undang</a>  
            </div>
          @endif
          <div class="col-xs">
            <a href="{{ route('user.show', $user) }}" class="btn btn-primary btn-block">Profil</a>
          </div>
        </div>
    </div> <!-- end back panel -->
  </div> <!-- end card -->
</div> <!-- end card-container -->