<!--Header-->
<div class="quick-look--header">
  <h3 class="quick-look--title">{{ $idea->title }}</h3>
</div>
<div class="quick-look--body">
  <div class="container-fluid">
    <div class="row">
      <!--First column-->
      <div class="col-xs-12 col-md-4 quick-look--info">
        <h4>Gallery</h4>
        <hr>
        <div class="col-xs-12 slick-mobile">
          <div class="gallery">
            <div class="gallery-item"><img class="img-responsive" src="{{ $idea->getCover(450, 200) }}"></div>
            @foreach($idea->media()->where('type', 'image')->take(5)->get() as $image)
              <div class="gallery-item"><img class="img-responsive" src="{{ $image->getUrl(450, 200) }}"></div>
            @endforeach
          </div>
        </div>
      </div>
      <!--/.First column-->

      <!--Second column-->
      <div class="col-xs-12 col-md-4 quick-look--info">
        <!--Title-->
        <h4>Deskripsi Singkat</h4>
        <hr>
        {{ $idea->description }}
        <br>
        <hr>
        <!--Social buttons-->
        <p class="text-xs-center"><b>Bagikan ke teman kamu!</b></p>
        <div class="row">
          <div class="col-xs">
            <a class="btn btn-flat btn-social btn-facebook" href="https://www.facebook.com/dialog/feed?app_id={{ ENV('FACEBOOK_APP_ID') }}&display=popup&caption={{ urlencode($idea->title) }}&link={{ route('idea.show', $idea) }}&redirect_uri={{ route('idea.show', $idea) }}" target="_blank" title="Share to Facebook">
              <span class="fa fa-facebook"></span>
            </a>  
          </div>
          <div class="col-xs">
            <a class="btn btn-flat btn-social btn-twitter" href="https://twitter.com/intent/tweet?text={{ urlencode(str_limit($idea->title, 100)) }}&url={{ urlencode(route('idea.show', $idea)) }}" target="_blank" title="Tweet to Twitter">
              <span class="fa fa-twitter"></span>
            </a>
          </div>
          <div class="col-xs">
            <a class="btn btn-flat btn-social btn-google-plus" href="https://plus.google.com/share?url={{ route('idea.show', $idea) }}" title="Share to Google Plus">
              <span class="fa fa-google"></span>
            </a>
          </div>
          <div class="col-xs">
            <a class="btn btn-flat btn-social btn-whatsapp" href="whatsapp://send?text={{ $idea->title }} {{ route('idea.show', $idea) }}" target="_blank" title="Share to WhatsApp">
              <span class="fa fa-whatsapp"></span>
            </a>
          </div>
          <div class="col-xs">
            <a class="btn btn-flat btn-social btn-line-messenger" href="http://line.me/R/msg/text/?{{ $idea->title }} {{ route('idea.show', $idea) }}" target="_blank" title="Share to LINE Messenger">
              <img src="{{ asset('assets/images/line-messenger-30x30.png') }}" width="20px" height="20px">
            </a>
          </div>  
        </div>
      </div>
      <!--/.Second column-->

      <!--Third column-->
      <div class="col-xs-12 col-md-4 quick-look--info">
        <h4>Informasi</h4>
        <hr>
        <div class="quick-look--block row flex-items-xs-middle">
          <div class="col-xs-2 text-xs-center">
            <i class="fa fa-user fa-lg"></i>
          </div>
          <div class="col-xs-10">
            <a href="{{ route('user.show', $idea->user) }}">
              <div class="chip">
                <img src="{{ $idea->user->getPhoto(40) }}" alt="Creator">
                {{ user_name_limit($idea->user->name, 30) }}
              </div>
            </a>
          </div>
        </div>
        <div class="quick-look--block row flex-items-xs-top">
          <div class="col-xs-2 text-xs-center">
            <i class="fa fa-tags fa-lg"></i>
          </div>
          <div class="col-xs-10">
            @foreach(collect($idea->tags)->take(100) as $tag)
              <div class="tag tag-pill tag-primary">{{ $tag }}</div>
            @endforeach  
          </div>
        </div>
        <div class="quick-look--block row flex-items-xs-top">
          <div class="col-xs-2 text-xs-center">
            <i class="fa fa-thumbs-up fa-lg"></i>
          </div>
          <div class="col-xs-10">
            <span class="quick-look--meta-number">{{ $idea->like_count }}</span>
          </div>
        </div>
        <div class="quick-look--block row flex-items-xs-middle">
          <div class="col-xs-2 text-xs-center">
            <i class="fa fa-map-marker fa-lg"></i>
          </div>
          <div class="col-xs-10">
            <div class="chip">
              {{ $idea->location }}
            </div>
          </div>
        </div>
        <hr>

        <h4>Anggota ({{ $idea->member_count }})</h4>
        <hr>
        <div class="row flex-items-xs-middle">
          @foreach($idea->members()->take(8)->get() as $user)
            <a href="{{ route('user.show', $user) }}">
              <div class="chip chip-member">
                <img src="{{ $user->getPhoto(40) }}" alt="member">
                {{ user_name_limit($user->name, 10) }}
              </div>
            </a>
          @endforeach  
          @if($idea->members()->count() > 8)
            <div class="col-xs-12 text-xs-center">
              <a href="{{ route('idea.members', $idea) }}">
                <div class="chip chip-member">
                  Semua Anggota
                </div>
              </a>
            </div>
          @endif
        </div>
      </div>
      <!--/.Third column-->
      </div>
  </div>
</div>
<!--Footer-->
<div class="quick-look--footer">
  @if(auth()->check())
    <a class="btn btn-flat orange" href="{{ route('idea.join', $idea) }}">Gabung</a>
  @endif
  <a class="btn btn-flat btn-primary" href="{{ route('idea.show', $idea) }}">Lihat</a>
</div>