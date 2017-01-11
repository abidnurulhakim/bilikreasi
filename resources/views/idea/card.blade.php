<div class="card sticky-action">
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
    <div class="card-share">
      <div class="card-social">
        <a class="share-icon facebook" href="https://www.facebook.com/dialog/feed?app_id={{ ENV('FACEBOOK_APP_ID') }}&display=popup&caption={{ urlencode($idea->title) }}&link={{ route('idea.show', $idea) }}&redirect_uri={{ route('idea.show', $idea) }}" target="_blank">
          <span class="fa fa-facebook"></span>
        </a>
        <a class="share-icon twitter" href="https://twitter.com/intent/tweet?text={{ urlencode(str_limit($idea->title, 100)) }}&url={{ urlencode(route('idea.show', $idea)) }}" target="_blank">
          <span class="fa fa-twitter"></span>
        </a>
        <a class="share-icon googleplus" href="#">
          <span class="fa fa-google-plus"></span>
        </a>
      </div>
      <a id="share" class="share-toggle share-icon primary-text" href="#"></a>
    </div>
    <span class="card-title grey-text text-darken-4">{{ str_limit($idea->title, 50) }}</span>
    <hr>
    <div class="card-block row flex-items-xs-top">
      <div class="col-xs-1">
        <i class="fa fa-tags fa-lg"></i>
      </div>
      <div class="col-xs-11">
        @foreach(collect($idea->tags)->take(100) as $tag)
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
      <a class="btn btn-flat btn-block primary" href="{{ route('idea.join', $idea) }}">Gabung</a>
      <a class="btn btn-flat btn-block primary" href="{{ route('idea.show', $idea) }}">Lihat</a>
    @elseif(isset($user))
      <a class="btn btn-flat btn-block primary" href="{{ route('idea.show', $idea) }}">Lihat</a>
      <i class="fa fa-clock-o" aria-hidden="true"></i> <small>Bergabung sejak <span class="time-humanize " title="{{ Carbon::parse($idea->members()->find($user->id)->pivot->join_at)->toIso8601String() }}"></span></small>
    @else
      <a class="btn btn-flat btn-block btn-primary" href="{{ route('idea.show', $idea) }}">Lihat</a>
    @endif
  </div>
</div>  