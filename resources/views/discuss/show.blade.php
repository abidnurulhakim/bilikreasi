@extends('discuss.layout')
@section('discuss-content')
  <div class="col-md-12">
        <!-- left -->
    <div class="col-md-4 col-padding">
      <div class="card">
        <div class="card-block">
          <div class="col-md-12 no-padding">
            <form>
              <div class="form-group">
                <input type="search" class="form-control" id="search-discuss" aria-describedby="search-discuss" placeholder="Cari">
              </div>
            </form>
          </div>
          <ul class="list-group">
            @forelse($discusses as $dis)
              @if($dis->id == $discuss->id)
              <a class="list-group-item discuss active" href="{{ route('discuss.show', $dis) }}">{{ str_limit($dis->name, 50) }}</a>
              @else
              <a class="list-group-item discuss" href="{{ route('discuss.show', $dis) }}">{{ str_limit($dis->name, 50) }}</a>
              @endif
            @empty
              <a class="list-group-item discuss" href="#">Anda tidak memiliki diskusi</a>
            @endforelse
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-8 col-padding">
      <div class="box box-primary direct-chat direct-chat-primary">
        <!-- /.box-header -->
        <div class="box-body" style="display: block;">
          <!-- Conversations are loaded here -->
          <div class="direct-chat-messages">
            @forelse($messages as $message)
              @if($message->isOwner(auth()->user()))
              <!-- Message to the right -->
              <div class="direct-chat-msg right">
                <div class="direct-chat-info clearfix">
                  <span class="direct-chat-name pull-right">{{ auth()->user()->name }}</span>
                  <span class="direct-chat-timestamp pull-left time-humanize " title="{{ $message->created_at->toIso8601String() }}"></span>
                </div>
                <!-- /.direct-chat-info -->
                <img class="direct-chat-img" src="{{ auth()->user()->getPhoto(128) }}" alt="Message User Image"><!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                  {{ $message->content }}
                </div>
                <!-- /.direct-chat-text -->
              </div>  
              @else
              <!-- Message. Default to the left -->
              <div class="direct-chat-msg">
                <div class="direct-chat-info clearfix">
                  <span class="direct-chat-name pull-left">{{ $message->user->name }}</span>
                  <span class="direct-chat-timestamp pull-right time-humanize " title="{{ $message->created_at->toIso8601String() }}"></span>
                </div>
                <!-- /.direct-chat-info -->
                <img class="direct-chat-img" src="{{ $message->user->getPhoto(128) }}" alt="Message User Image"><!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                  {{ $message->content }}
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
          {!! Form::open(['route' => ['discuss.send.message', $discuss], 'method' => 'POST']) !!}
            <div class="form-group col-sm-11 col-padding">
              {!! Form::textArea('content', null, ['class' => 'form-control', 'rows' => 1]) !!}
            </div>
            <button type="submit" class="btn btn-primary pull-right">Kirim</button>
          {!! Form::close() !!}
        </div>

        <!-- /.box-footer-->
      </div>
    </div>
  </div>
@endsection