<div class="card__idea">
  <div class="card__image border-tlr-radius">
    <div class="card__date">
      @if($idea->created_at->diffInYears(\Carbon::now()) > 0)
      <div class="card__date__year">
        {{ $idea->created_at->format('Y') }}
      </div>
      @else
      <div class="card__date__day">
        {{ $idea->created_at->format('d') }}
      </div>
      <div class="card__date__month">
        {{ $idea->created_at->format('M') }}
      </div>
      @endif
    </div>
    @if(\Auth::check())
      @if($idea->hasLike(auth()->user()))
        <a href="{{ route('idea.unlike', ['idea' => $idea, 'user' => auth()->user()]) }}" class="card__like fa fa-heart active" title="{{ $idea->like_count }} menyukai"></a>
      @else
        <a href="{{ route('idea.like', ['idea' => $idea, 'user' => auth()->user()]) }}" class="card__like fa fa-heart" title="{{ $idea->like_count }} menyukai"></a>
      @endif
    @endif
    <img src="{{ $idea->getCover(400, 250) }}" alt="image" class="border-tlr-radius">
  </div>
  <div class="card__content card__padding">
    <div class="card__category">{{ $idea->category }}</div>
    <div class="card__share">
      <div class="card__social">
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
      <a id="share" class="share-toggle share-icon text-primary" href="#"></a>
    </div>

    <article class="card__article">
      <h4><a href="{{ route('idea.show', $idea) }}">{{ str_limit($idea->title, 50) }}</a></h4>
      <p>
        {{ str_limit(htmlClear($idea->description), 175) }}
        @if(strlen(htmlClear($idea->description)) > 175)
          <a href="{{ route('idea.show', $idea) }}" class="read__more">lanjut baca</a>
        @endif
      </p>
    </article>
    <div class="card__meta">
      <i class="fa fa-tags text-primary"></i> <span class="text-muted">{{ join(', ', $idea->tags) }}</span>
    </div>
  </div>
  <div class="card__action">
    <div class="card__footer">
    @if(isset($invitation))
      <a href="{{ route('idea.join', $idea) }}" class="pull-left btn btn-primary btn-block">Gabung</a>
    @elseif(isset($user))
      <i class="fa fa-clock-o" aria-hidden="true"></i> <small>Bergabung sejak <span class="time-humanize " title="{{ Carbon::parse($idea->members()->find($user->id)->pivot->join_at)->toIso8601String() }}"></span></small>
    @else
      @foreach($idea->members->take(4) as $member)
      <a href="{{ route('user.show', $member) }}">
        <img src="{{ $member->getPhoto(40) }}" alt="{{ $member->name }}" title="{{ $member->name }}">
      </a>
      @endforeach
      @if($idea->members->count() > 4)
      <span class="card__member_more">(+{{ $idea->members->count() - 4 }})</span>
      @endif
    @endif
    </div>
  </div>
</div>
