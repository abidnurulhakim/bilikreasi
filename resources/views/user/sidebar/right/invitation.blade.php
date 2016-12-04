@extends('user.sidebar.right.layout')
@section('user.sidebar.right.content')
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs pull-right">
      <li class="active"><a href="{{ route('user.invitation', $user) }}"><i class="fa fa-envelope"></i> Permintaan Bergabung</a></li>
      <li><a href="{{ route('user.show', $user) }}"><i class="fa fa-share-alt"></i> Ide Terhubung</a></li>
      <li><a href="{{ route('idea.create') }}"><i class="fa fa-plus"></i> Buat Ide Baru</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active col-padding">
        {{ Carbon::setLocale('id') }}
        @forelse ($invitations->chunk(3) as $chunk)
        <div class="row">
          @foreach ($chunk as $invitation)
          @php
            $idea = $invitation->idea 
          @endphp
          <div class="col-sm-4 col-padding">
            <div class="card">
              <div class="card-block">
                <h5 class="card-title">
                  <a href="{{ route('idea.show', $idea) }}">{{ str_limit($idea->title, 25)}} </a> &mdash;
                  @if($idea->category == 'business')
                    <i class="fa fa-money text-primary" alt="business"></i>
                  @elseif($idea->category == 'campaign')
                    <i class="fa fa-bullhorn text-primary" alt="campaign"></i>
                  @elseif($idea->category == 'community')
                    <i class="fa fa-users text-primary" alt="community"></i>
                  @elseif($idea->category == 'project')
                    <i class="fa fa-gears text-primary" alt="project"></i>
                  @elseif($idea->category == 'event')
                    <i class="fa fa-calendar text-primary" alt="event"></i>
                  @else
                    <i class="fa fa-bookmark-o text-primary" alt="other"></i>
                  @endif
                </h5>
                <h6 class="card-subtitle">
                  <div class="col-sm-1 col-sm-1 no-padding">
                    <i class="fa fa-tags text-primary"></i>   
                  </div>
                  <div class="col-sm-11 col-sm-11 col-padding">
                    @foreach($idea->tags as $tag)
                      <span class="label label-info">{{ $tag }}</span>
                    @endforeach
                  </div>
                </h6>
              </div>
              <a href="{{ route('idea.show', $idea) }}">
                <img src="{{ $idea->getCover(400, 200) }}" class='img-responsive' alt="{{ $idea->title }}">
              </a>
              <div class="card-block">
                <p class="card-text">{{ str_limit(strip_tags($idea->description), 150) }}</p>
                <a href="{{ route('idea.join', $idea) }}" class="pull-left btn btn-primary">Gabung</a>
                <a href="{{ route('idea.show', $idea) }}" class="pull-right btn btn-primary">Baca</a>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        @empty
          <h4 class="text-center text-muted">-- Belum ada undangan bergabung dari ide manapun. --</h4>
        @endforelse
        <div class="col-sm-12 text-center">
          {!! $invitations->links() !!}
        </div>
      </div>
    </div>
  </div>
@endsection
