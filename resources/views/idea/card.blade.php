<div class="card sticky-action z-depth-2">
  <div class="card-image">
    <div class="card-date">
      @if($idea->created_at->diffInYears(\Carbon::now()) > 0)
      <div class="card-date-year">
        {{ $idea->created_at->format('Y') }}
      </div>
      @else
      <div class="card-date-day">
        {{ $idea->created_at->format('d') }}
      </div>
      <div class="card-date-month">
        {{ $idea->created_at->format('M') }}
      </div>
      @endif
    </div>
    <img src="{{ $idea->getCover(400, 200) }}" alt="image" class="activator">
    <div class="card-category">{{ $idea->category }}</div>
  </div>
  <div class="card-content">
    <ul class="card-action-buttons">
      <li>
        <a href="{{ route('idea.quick-look', $idea) }}" class="btn-floating light-blue quick-look" title="Quick Look"><i class="fa fa-search"></i></a>
      </li>
    </ul>
    <span class="card-title grey-text text-darken-4">{{ str_limit($idea->title, 50) }}</span>
    <hr>
    <div class="card-block row flex-items-xs-top">
      <div class="col-xs-1">
        <i class="fa fa-tags fa-lg"></i>
      </div>
      <div class="col-xs-11">
        @foreach(collect($idea->tags)->take(10) as $tag)
          <div class="tag tag-pill tag-primary">{{ $tag }}</div>
        @endforeach  
      </div>
    </div>
    <div class="card-block row flex-items-xs-middle text-xs-center meta">
      <ul class="meta-info">
        <li class="meta-info--item">
          <div class="col-xs-12">
            <i class="fa fa-thumbs-up fa-lg"></i>
          </div>
          <div class="col-xs-12">
            <span class="abbr-number meta-info--number">{{ $idea->like_count }}</span>
          </div>
        </li>
        <li class="meta-info--item">
          <div class="col-xs-12">
            <i class="fa fa-users fa-lg"></i>
          </div>
          <div class="col-xs-12">
            <span class="abbr-number meta-info--number">{{ $idea->member_count }}</span>
          </div>
        </li>
        <li class="meta-info--item">
          <div class="col-xs-12">
            <i class="fa fa-eye fa-lg"></i>
          </div>
          <div class="col-xs-12">
            <span class="abbr-number meta-info--number">{{ $idea->viewer_count }}</span>
          </div>
        </li>
      </ul>
    </div>
    <div class="card-block row flex-items-xs-middle text-xs-center meta-share">
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
  <div class="card-reveal">
    <span class="card-title grey-text text-darken-4"><div class="title-ellipsis">{{ str_limit($idea->title, 50) }}</div><i class="material-icons right">close</i></span>
    <p class="flow-text">
      {{ str_limit(htmlClear($idea->description), 300) }}
      @if(strlen(htmlClear($idea->description)) > 300)
        <a href="{{ route('idea.show', $idea) }}" class="read-more">selengkapnya</a>
      @endif
    </p>
  </div>
  <div class="card-action">
    @if(isset($invitation))
      <a class="btn btn-flat btn-block btn-primary" href="{{ route('idea.join', $idea) }}">Gabung</a>
    @endif
    <a class="btn btn-flat btn-block btn-primary" href="{{ route('idea.show', $idea) }}">Lihat</a>
  </div>
</div>  