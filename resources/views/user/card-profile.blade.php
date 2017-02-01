<div class="card card-profile z-depth-2">
  <div class="card-image waves-effect waves-block card-profile--background-image">
    <img class="activator" src="{{ asset('assets/images/background-user.jpg') }}" alt="user background">                    
  </div>
  <figure class="card-profile--user-image">
    <img src="{{ $user->getPhoto(100) }}" alt="profile image" class="rounded-circle z-depth-2 img-responsive activator">
  </figure>
  <div class="card-content">
    <div class="row">
      <div class="col-xs-12 offset-xs-0 col-md-3 offset-md-2 text-xs-center text-md-left">
        <h4 class="card-title grey-text text-darken-4">{{ $user->name }}</h4>
        <p class="medium-small grey-text">{{ $user->profession }}</p>
      </div>
      <div class="col-xs-12 offset-xs-0 text-xs-center col-md-2">
          <h4 class="card-title grey-text text-darken-4">{{ $user->ideas()->count() }}</h4>
          <p class="medium-small grey-text">Ide dibuat</p>                        
      </div>
      <div class="col-xs-12 offset-xs-0 text-xs-center col-md-2">
          <h4 class="card-title grey-text text-darken-4">{{ $user->memberOf()->count() }}</h4>
          <p class="medium-small grey-text">Ide berpartisipasi</p>                        
      </div>
      <ul class="card-profile--action-buttons">
        <li>
          <a class="btn-floating activator waves-effect waves-light darken-2 right z-depth-2" title="User detail">
            <i class="fa fa-user"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
  <div class="card-reveal card-profile--user-detail">
    <p>
      <span class="card-title grey-text text-darken-4">{{ $user->name }}<i class="fa fa-close float-xs-right"></i></span>
    </p>
    <hr>
    <div class="row flex-items-xs-middle">
      <div class="col-xs-1 text-xs-center">
        <i class="fa fa-suitcase fa-lg cyan-text"></i>
      </div>
      <div class="col-xs-11">
        <div class="chip">
          {{ $user->profession }}
        </div>
      </div>
    </div>      
    <div class="row flex-items-xs-middle">
      <div class="col-xs-1 text-xs-center">
        <i class="fa fa-birthday-cake fa-lg cyan-text"></i>
      </div>
      <div class="col-xs-11">
        <div class="chip">
          {{ $user->birthday }}
        </div>
      </div>
    </div>
    <div class="row flex-items-xs-middle">
      <div class="col-xs-1 text-xs-center">
        <i class="fa fa-map-marker fa-lg cyan-text"></i>
      </div>
      <div class="col-xs-11">
        <div class="chip">
          {{ $user->live_at }}
        </div>
      </div>
    </div>
    <div class="row flex-items-xs-top">
      <div class="col-xs-1 text-xs-center">
        <i class="fa fa-heart fa-lg cyan-text"></i>
      </div>
      <div class="col-xs-11">
        @foreach(collect($user->interests)->take(10) as $interest)
          <div class="chip tag-primary">{{ $interest }}</div>
        @endforeach  
      </div>
    </div>
    <div class="row flex-items-xs-top">
      <div class="col-xs-1 text-xs-center">
        <i class="fa fa-gears fa-lg cyan-text"></i>
      </div>
      <div class="col-xs-11">
        @foreach(collect($user->skills)->take(10) as $skill)
          <div class="chip tag-primary">{{ $skill }}</div>
        @endforeach  
      </div>
    </div>
  </div>
</div>