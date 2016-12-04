@extends('idea.layout')
@section('idea-content')
  <div class="col-sm-12">
    <div class="card">
      <div class="card-block">
        <!-- left -->
        <div class="col-sm-12 col-padding">
          <div class="col-sm-12 no-padding page-header idea">
            <div class="col-sm-3 col-padding">
              <center><img class="img-responsive img-rounded img-idea" src="{{ $idea->getCover(200) }}"></center>
            </div>
            <!-- idea -->
            <div class="col-sm-7 col-padding idea">
              <div class="col-sm-12 no-padding">
                <div class="col-sm-8 col-padding section-idea info-idea">
                  <div class="col-sm-12 no-padding title">
                    <span class="subject">{{ $idea->title }}</span> 
                  </div>
                  <div class="col-sm-12 no-padding tags">
                    <i class="fa fa-tags"></i> 
                    @foreach($idea->tags as $tag)
                    <span class="label label-info">{{ $tag }}</span>
                    @endforeach
                  </div>
                </div>

                <div class="col-sm-4 col-padding pull-right">
                  @include('layout.media-shares')
                </div>
              </div>

              <div class="col-sm-12 no-padding section-idea criteria-idea">
                <div class="col-md-6 col-padding text-center">
                  <i class="fa 
                  @if($idea->category == 'business')
                    fa-money
                  @elseif($idea->category == 'campaign')
                    fa-bullhorn
                  @elseif($idea->category == 'community')
                    fa-users
                  @elseif($idea->category == 'project')
                    fa-gears
                  @elseif($idea->category == 'event')
                    fa-calendar
                  @else
                    fa-bookmark-o
                  @endif
                   fa-2x text-primary" alt="{{ $idea->category }}"></i><br>
                  <b>{{ ucfirst($idea::CATEGORY[$idea->category]) }}</b><br>
                  @if($idea->category == 'event' && $idea->start_at && $idea->finish_at)
                    <small>{{ $idea->start_at->format('Y/m/d H:m') }} &mdash; {{ $idea->finish_at->format('Y/m/d H:m') }}</small>
                  @endif
                </div>
                <div class="col-sm-3 col-padding text-center">
                  <i class="fa fa-map-marker fa-2x text-primary"></i><br>
                  <b>{{ ucfirst($idea->location) }}</b>
                </div>
                <div class="col-sm-3 col-padding text-center">
                  <i class="fa fa-flag fa-2x text-primary"></i><br>
                  <b>{{ ucfirst($idea->status) }}</b>
                </div>
              </div>

              @if(auth()->user())
              <div class="col-sm-12 no-padding section-idea action-idea">
                @if($idea->hasLike(auth()->user()))
                <a href="{{ route('idea.unlike', ['idea' => $idea, 'user' => auth()->user()]) }}" class="btn btn-primary btn">Tidak Menyukai</a>
                @else
                <a href="{{ route('idea.like', ['idea' => $idea, 'user' => auth()->user()]) }}" class="btn btn-primary btn"><i class='fa fa-heart-o'></i> Menyukai </a>
                @endif
                @unless($idea->isMember(auth()->user()))
                <a href="{{ route('idea.join', $idea) }}" class="btn btn-primary btn">Bergabung</a>
                @endif
                @if($idea->isAdmin(auth()->user()))
                <a href="{{ route('idea.edit', $idea) }}" class="btn btn-primary btn pull-right">Perbaharui Ide</a>
                @endif
                @if($idea->isAdmin(auth()->user()))
                <a href="{{ route('idea.search.partner', $idea) }}" class="btn btn-primary btn pull-right">Cari Partner</a>
                @endif
              </div>
              @endif
            </div>
            <!-- user -->
            <div class="col-sm-2 col-padding text-center">
              <a href="{{ route('user.show', $idea->user) }}">
                <img class="img-circle img-creator" src="{{ $idea->user->getPhoto(100) }}">
              </a>
              <br><br>
              <b>
                <a href="{{ route('user.show', $idea->user) }}" class="creator">{{ $idea->user->name }}</a>
              </b>
            </div>
          </div>
          <div class="col-sm-12 col-padding idea">
            {!! $idea->description !!}
          </div>
          <div class="col-sm-12 page-header">
            <h3><b>Anggota<b></h3>
          </div>
          <div class="col-sm-12 text-center">
            @foreach($idea->members()->paginate(10) as $user)
            <div class="col-sm-1 col-padding">
              <img src="{{ $user->getPhoto(100) }}" class="img-responsive img-circle"><br>
              <a href="{{ route('user.show', $user) }}" class="">{{ $user->name }}</a>
            </div>
            @endforeach
            <a href="{{ route('idea.members', $idea) }}" class="btn btn-primary" style="bottom: 50%;position: absolute;">Semua anggota</a>
          </div>
          @if($idea->media()->count() > 0)
          <div class="col-sm-12 page-header">
            <h3><b>Galeri Foto dan Video<b></h3>
          </div>
          <div class="col-sm-12">
            @forelse($idea->media as $media)
              @if($media->type == 'image')
              <div class="col-sm-2">
                <img src="{{ $media->getUrl() }}" class="img-responsive">
              @elseif($media->type == 'video')
              <div class="col-sm-4">
                <video width="320" height="240" controls>
                  <source src="{{ $media->getUrl() }}" type="video/mp4">
                  Your browser does not support the video tag.
                </video>
              @else
              <div class="col-sm-2">
                <i class="fa fa-file fa-4x">
                  <a href="{{ $media->getUrl() }}"></a>
                </i>
              @endif
              </div>            
            @endforeach
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection