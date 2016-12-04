@extends('discussion.layout')
@section('discussion-content')
  <div class="col-sm-12">
    <!-- left -->
    <div class="col-sm-4 col-padding">
      <div class="box box-primary">
        <div class="box-body">
          {!! Form::open(['route' => ['discussion.index'], 'method' => 'GET']) !!}
            <div class="form-group">
              {!! Form::text('name', app('request')->input('name', ''), ['placeholder' => 'Cari diskusi', 'type' => 'search', 'class' => 'form-control']) !!}
            </div>
            <button type="submit" class='hidden'></button>
          {!! Form::close() !!}
          <ul class="list-group">
            @foreach($discussions as $dis)
              @if($dis->id == $discussion->id)
              <a class="list-group-item discussion active" href="{{ route('discussion.show', $dis) }}">{{ str_limit($dis->name, 50) }}</a>
              @else
              <a class="list-group-item discussion" href="{{ route('discussion.show', $dis) }}">{{ str_limit($dis->name, 50) }}</a>
              @endif
            @endforeach
          </ul>
        </div>
      </div>
    </div>
    <!-- right -->
    <div class="col-sm-8 col-padding">
      @if($discussion)
      <div class="box box-primary direct-chat direct-chat-primary">
        <!-- /.box-header -->
        <div class="box-body">
          <!-- Conversations are loaded here -->
          <div class="direct-chat-messages slimscroll" id="discussion-idea" data-user-name="{{ auth()->user()->name }}" data-user-photo="{{ auth()->user()->getPhoto(128) }}" data-user-id="{{ auth()->user()->id }}" data-url-read-message="{{ route('discussion.message.read', $discussion) }}" data-url-unread-message="{{ route('discussion.message.unread', $discussion) }}" data-has-more-page="{{ $messages->hasMorePages() }}">
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