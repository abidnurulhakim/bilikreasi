<!--Header-->
<div class="quick-look--header">
  <h4 class="quick-look--title">{{ $idea->title }}</h4>
</div>
<div class="quick-look--body">
  <div class="container-fluid">
    <div class="row">
      <!--First column-->
      <div class="col-xs-12 col-md-4">
        <h4>Gallery</h4>
        <hr>
        <div class="gallery">
          <div class="gallery-item"><img class="img-responsive" src="{{ $idea->getCover(400, 200) }}"></div>
          @foreach($idea->media()->where('type', 'image')->take(5)->get() as $image)
            <div class="gallery-item"><img class="img-responsive" src="{{ $banner->getUrl(400, 200) }}"></div>
          @endforeach
        </div>
      </div>
      <!--/.First column-->

      <!--Second column-->
      <div class="col-xs-12 col-md-4">
        <!--Title-->
        <h4>Deskripsi Singkat</h4>
        <hr>
        {{ $idea->description }}
        <br>
        <!--Social buttons-->
        <p class="text-xs-center">Bagikan ke teman kamu!</p>
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
      <div class="col-xs-12 col-md-4">
        <h4>Meta</h4>
        <hr>

        <hr>

        <h4>Anggota ({{ $idea->member_count }})</h4>
        <hr>
        <div class="row">
          @foreach($idea->members()->take(7)->get() as $user)
            <div class="col-xs-6 col-md-3 text-xs-center">
              <div class="col-xs-12">
                <a href="{{ route('user.show', $user) }}"><img class="rounded-circle" src="{{ $user->getPhoto(50) }}"></a>  
              </div>
              <div class="col-xs-12">
                <a href="{{ route('user.show', $user) }}">{{ str_limit($user->name, 10) }}</a>
              </div>
            </div>
          @endforeach  
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