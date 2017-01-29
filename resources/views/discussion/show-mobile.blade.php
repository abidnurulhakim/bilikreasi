<div class="card z-depth-3 discussion-mobile hidden-md-up">
  <div class=" z-depth-2">
    <div class="discussion--title">
      {{ $discussion->name }}
    </div>
    <ul class="nav nav-pills" role="tablist">
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#discussion-list" role="tab">
          <i class="fa fa-users fa-lg"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#discussion-messages" role="tab">
          <i class="fa fa-comments fa-lg"></i>
        </a>
      </li>
    </ul>
  </div>
  <!-- Tab panes -->
  <div class="tab-content">
    <div class="tab-pane discussion--list" id="discussion-list" role="tabpanel">
      {!! Form::open(['route' => ['discussion.index'], 'method' => 'GET', 'class' => 'discussion--search']) !!}
        <div class="input-group">
          {!! Form::text('name', app('request')->input('name', ''), ['placeholder' => 'Cari diskusi', 'type' => 'search', 'class' => 'form-control']) !!}
          <span class="input-group-btn">
            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
          </span>
        </div>
      {!! Form::close() !!}
      <hr>
      <ul class="discussion--list-group">
        @foreach($discussions as $dis)
          @if($dis->id == $discussion->id)
          <a class="discussion--list-item active" href="{{ route('discussion.show', $dis) }}">
          @else
          <a class="discussion--list-item" href="{{ route('discussion.show', $dis) }}">
          @endif
            <div class="row flex-items-xs-top">
              <div class="col-xs-2 discussion--list-item--img-wrapper">
                <img src="{{ $dis->idea->getCover() }}">
              </div>
              <div class="col-xs-10 discussion--list-item--wrapper">
                <div class="discussion--list-item--title">
                  {{ $dis->name }}
                </div>
                <div class="discussion--list-item--message">
                  @php
                    $message = $dis->getLastMessage();
                  @endphp
                  @if($message)
                    {{ str_limit($message->content, 50) }}
                  @else
                    Belum ada diskusi
                  @endif
                </div>
              </div>
            </div>
          </a>
        @endforeach
      </ul>
    </div>
    <div class="tab-pane discussion--messages-tab active" id="discussion-messages" role="tabpanel">
      <div class="col-md-12 discussion--messages" data-id="{{ $discussion->id }}" data-user-name="{{ auth()->user()->name }}" data-user-photo="{{ auth()->user()->getPhoto(128) }}" data-user-id="{{ auth()->user()->id }}" data-url-read-message="{{ route('discussion.message.read', $discussion) }}" data-url-unread-message="{{ route('discussion.message.unread', $discussion) }}" data-has-more-page="{{ $messages->hasMorePages() }}" data-last-message-id="{{ $messages->last()->id }}">
        <li class="discussion--message hidden-xs-up text-xs-center text-primary" id="alert_loading">
          <i class="fa fa-spinner fa-pulse fa-lg"></i><span> Loading...</span>
        </li>
        <ul class="discussion--message-group">
          <li class="discussion--message text-xs-center btn-load-more">
            <a class="btn btn-primary btn-flat btn-block">Muat pesan lebih banyak</a>
          </li>
          @foreach($messages->reverse() as $message)
            @if($message->isOwner(auth()->user()))
              @php
                $user = auth()->user()
              @endphp
              <li class="discussion--message current-user" data-message-id="{{ $message->id }}" data-dump="false">
            @else
              @php
                $user = $message->user
              @endphp
              <li class="discussion--message" data-message-id="{{ $message->id }}" data-dump="false">
            @endif
            <div class="discussion--message-info">
              <a href="{{ route('user.show', $user) }}" class="discussion--message-name">{{ user_name_limit($user->name, 40) }}</a>
              <span class="discussion--message-timestamp time-humanize" title="{{ $message->created_at->toIso8601String() }}"></span>
            </div>
            <img class="discussion--message-avatar" src="{{ $user->getPhoto() }}" alt="Message User Image">
            <div class="discussion--message-text--wrapper">
              <div class="discussion--message-text">
                {!! nl2br($message->content) !!}
              </div>
            </div>
          </li>
          @endforeach
        </ul>
      </div>
      <div class="col-md-12 discussion--input-message">
        {!! Form::open(['route' => ['discussion.send.message', $discussion], 'method' => 'POST', 'id' => 'discussion--input-message--form--mobile']) !!}
          <div class=" row flex-items-xs-bottom">
            <div class="col-xs-10">
              {!! Form::textArea('content', null, ['class' => 'form-control discussion--input-text', 'rows' => 1]) !!}
            </div>
            <div class="col-xs-2">
              <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-send"></i></button>  
            </div>  
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>