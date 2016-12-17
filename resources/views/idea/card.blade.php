<div class="card medium sticky-action">
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
    <img src="{{ $idea->getCover(400, 400) }}" alt="image" class="activator">
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
    <div class="card-title activator grey-text text-darken-4">
      {{ str_limit($idea->title, 50) }}
    </div>
    <hr>
    <div class="card-meta">
      <div class="col s12 m12">
        <i class="fa fa-tags fa-lg primary-text"></i>
        @foreach(collect($idea->tags)->take(4) as $tag)
          <div class="chip chip-idea">
            {{ $tag }}
          </div>
        @endforeach
      </div>    
      <div class="col s6 m6">
        <i class="fa fa-thumbs-up fa-lg primary-text"></i>
        <label>{{ $idea->like_count }}</label>
      </div>
      <div class="col s6 m6">
        <i class="fa fa-eye fa-lg primary-text"></i>
        <label>100K</label>
      </div>
      <div class="col s12 m12 card-members">
        @foreach($idea->members->take(7) as $member)
          <a href="{{ route('user.show', $member) }}">
            <img src="{{ $member->getPhoto(30) }}" class="circle responsive-img" alt="{{ $member->name }}" title="{{ $member->name }}">
          </a>
        @endforeach
        @if($idea->members->count() > 7)
          <a href="{{ route('idea.members', $idea) }}" class="more">(+{{ $idea->members->count() - 8 }})</a>
        @endif
      </div>
    </div>
  </div>
  <div class="card-reveal">
    <span class="card-title grey-text text-darken-4"><div class="title-ellipsis">{{ str_limit($idea->title, 50) }}</div><i class="material-icons right">close</i></span>
    <p>
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
      <i class="fa fa-clock-o" aria-hidden="true"></i> <small>Bergabung sejak <span class="time-humanize " title="{{ Carbon::parse($idea->members()->find($user->id)->pivot->join_at)->toIso8601String() }}"></span></small>
    @else
      <a class="btn btn-flat btn-block primary" href="{{ route('idea.show', $idea) }}">Lihat</a>  
    @endif
  </div>
</div>
