@extends('discussion.layout')
@section('discussion-content')
  <div class="col-xs-12">
    <div class="card z-depth-3 discussion">
      <div class="discussion--title">
        {{ $discussion->name }}
      </div>
      <div class="row">
        <div class="col-md-4 discussion--list">
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
        <div class="col-md-8">
          <div class="col-md-12 discussion--messages" data-id="{{ $discussion->id }}" data-user-name="{{ auth()->user()->name }}" data-user-photo="{{ auth()->user()->getPhoto(128) }}" data-user-id="{{ auth()->user()->id }}" data-url-read-message="{{ route('discussion.message.read', $discussion) }}" data-url-unread-message="{{ route('discussion.message.unread', $discussion) }}" data-has-more-page="{{ $messages->hasMorePages() }}">          
            <ul class="discussion--message-group">
              @foreach($messages->reverse() as $message)
                @if($message->isOwner(auth()->user()))
                  @php
                    $user = auth()->user()
                  @endphp
                  <li class="discussion--message current-user">
                @else
                  @php
                    $user = $message->user
                  @endphp
                  <li class="discussion--message">
                @endif
                <div class="discussion--message-info">
                  <span class="discussion--message-name">{{ user_name_limit($user->name, 40) }}</span>
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
          <hr>
          <div class="col-md-12 discussion--input-message">
            {!! Form::open(['route' => ['discussion.send.message', $discussion], 'method' => 'POST', 'id' => 'discussion--input-message--form']) !!}
              <div class=" row flex-items-xs-bottom">
                <div class="col-md-11">
                  {!! Form::textArea('content', null, ['class' => 'form-control discussion--input-text', 'rows' => 1]) !!}
                </div>
                <div class="col-md-1">
                  <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-send"></i></button>  
                </div>  
              </div>
            {!! Form::close() !!}
          </div>
        </div>
        
      </div>
    </div>
  </div>
  <div class="col-sm-12">
    <!-- right -->
    <div class="col-sm-8 col-padding">
      @if($discussion)
      <div class="box box-primary direct-chat direct-chat-primary">
        <!-- /.box-header -->
        <div class="box-body">
          <!-- Conversations are loaded here -->
          <div class="direct-chat-messages slimscroll" id="discussion-idea" data-id="{{ $discussion->id }}" data-user-name="{{ auth()->user()->name }}" data-user-photo="{{ auth()->user()->getPhoto(128) }}" data-user-id="{{ auth()->user()->id }}" data-url-read-message="{{ route('discussion.message.read', $discussion) }}" data-url-unread-message="{{ route('discussion.message.unread', $discussion) }}" data-has-more-page="{{ $messages->hasMorePages() }}">
            @if($messages->hasMorePages())
            <div class='col-sm-12 text-center hidden' id="alert_loading">
              <i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i><span class="sr-only">Loading...</span>
            </div>
            @endif
            @forelse($messages->reverse() as $message)
              @if($message->isOwner(auth()->user()))
              <!-- Message to the right -->
              <div class="direct-chat-msg right" data-message-id="{{ $message->id }}" data-dump="false">
                <div class="direct-chat-info clearfix">
                  <span class="direct-chat-name pull-right">{{ auth()->user()->name }}</span>
                  <span class="direct-chat-timestamp pull-left time-humanize " title="{{ $message->created_at->toIso8601String() }}"></span>
                </div>
                <!-- /.direct-chat-info -->
                <img class="direct-chat-img" src="{{ auth()->user()->getPhoto(128) }}" alt="{{ auth()->user()->name }}"><!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                  {!! $message->content !!}
                </div>
                <!-- /.direct-chat-text -->
              </div>
              @else
              <!-- Message. Default to the left -->
              <div class="direct-chat-msg" data-message-id="{{ $message->id }}" data-dump="false">
                <div class="direct-chat-info clearfix">
                  <span class="direct-chat-name pull-left">{{ $message->user->name }}</span>
                  <span class="direct-chat-timestamp pull-right time-humanize " title="{{ $message->created_at->toIso8601String() }}"></span>
                </div>
                <!-- /.direct-chat-info -->
                <img class="direct-chat-img" src="{{ $message->user->getPhoto(128) }}" alt="{{ $message->user->name }}"><!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                  {!! $message->content !!}
                </div>
                <!-- /.direct-chat-text -->
              </div>
              <!-- /.direct-chat-msg -->
              @endif
            @empty
            @endforelse
            <!-- /.direct-chat-msg -->
          </div>
          <!--/.direct-chat-messages-->
        </div>
        <!-- /.box-body -->
        <div class="box-footer" style="display: block;">
          {!! Form::open(['route' => ['discussion.send.message', $discussion], 'method' => 'POST', 'id' => 'discussion-form']) !!}
            <div class="form-group col-sm-11 col-padding">
              {!! Form::textArea('content', null, ['class' => 'form-control', 'rows' => 1, 'id' => 'discussion-msg']) !!}
            </div>
            <button type="submit" class="btn btn-primary pull-right">Kirim</button>
          {!! Form::close() !!}
        </div>
        <!-- /.box-footer-->
      </div>
      @endif
    </div>
  </div>
@endsection
