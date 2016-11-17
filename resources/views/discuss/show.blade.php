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
      <div class="card">
        <div class="card-block discuss">
          @forelse($messages as $message)
            <div class="col-md-12 col-padding">
              @if($message->isOwner(auth()->user()))
              <div class="alert alert-success message owner" role="alert">
                <div class="col-md-12 no-padding content text-right">
                  <p>
                    {!! $message->content !!}
                  </p>
                  <hr>
                  <span class="time-humanize " title="{{ $message->created_at->toIso8601String() }}"></span>
                </div>
              </div>
              @else
              <div class="alert alert-info message other" role="alert">
                <div class="col-md-2 col-padding">
                  <center>
                    <img class="img-responsive img-circle img-user-xs" src="{{ $message->user->getPhoto(100) }}">
                  </center>
                </div>
                <div class="col-md-10 col-padding">
                  <div class="col-md-12 no-padding user">
                    <a href="{{ route('user.show', $message->user) }}">{{ $message->user->name }}</a>
                  </div>
                  <div class="col-md-12 no-padding content">
                    <p>
                      {!! $message->content !!}
                    </p>
                    <hr>
                    <span class="time-humanize " title="{{ $message->created_at->toIso8601String() }}"></span>
                  </div>
                </div>
              </div>
              @endif
            </div>
          @empty
            <div class="alert alert-warning message other col-md-12 text-center" role="alert">
              <p>Diskusi ini belum memiliki di mulai</p>
            </div>
          @endforelse
          <!-- hr -->
        </div>
        <hr class="discuss">
        <!-- input discuss -->
        <div class="card-block">
          {!! Form::open(['route' => ['discuss.send.message', $discuss], 'method' => 'POST']) !!}
            <div class="form-group">
              {!! Form::textArea('content', null, ['class' => 'form-control', 'rows' => 5]) !!}
            </div>
            <button type="submit" class="btn btn-primary pull-right">Kirim</button>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection