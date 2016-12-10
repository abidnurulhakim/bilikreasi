<div class="card__idea">
  <div class="card__image border-tlr-radius">
    <img src="{{ $idea->getCover(400, 200) }}" alt="image" class="border-tlr-radius">
  </div>
  <div class="card__content card__padding">
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
      <a id="share" class="share-toggle share-icon" href="#"></a>
    </div>

    <div class="card__meta">
      <a href="{{ route('search.index', ['category' => $idea->category]) }}">{{ ucfirst($idea->category) }}</a>
      <time>{{ $idea->created_at->format('d M Y') }}</time>
    </div>

    <article class="card__article">
      <h4><a href="{{ route('idea.show', $idea) }}">{{ str_limit($idea->title, 50) }}</a></h4>
      <p>
        {{ str_limit(htmlClear($idea->description), 200) }}
        @if(strlen(htmlClear($idea->description)) > 200)
          <a href="{{ route('idea.show', $idea) }}" class="read__more">lanjut baca</a>
        @endif
      </p>
    </article>
    <div class="card__meta">
      <i class="fa fa-tags text-primary"></i> <span class="text-muted">{{ join(', ', $idea->tags) }}</span>
    </div>
  </div>
  <div class="card__action">
    <div class="card__author">
    @if(empty($user))
      <img src="{{ $idea->user->getPhoto(80) }}" alt="{{ $idea->user->name }}">
      <div class="card__author-content">
        <a href="{{ route('user.show', $idea->user) }}">{{ $idea->user->name }}</a>
      </div>
    @else
      <i class="fa fa-clock-o" aria-hidden="true"></i> <small>Bergabung sejak <span class="time-humanize " title="{{ Carbon::parse($idea->members()->find($user->id)->pivot->join_at)->toIso8601String() }}"></span></small>
    @endif
    </div>
  </div>
</div>