@extends('idea.layout')
@section('idea-content')
  <div class="col-md-12">
    <div class="card">
      <div class="card-block">
        <!-- left -->
        <div class="col-md-12 col-padding">
          <div class="col-md-12 no-padding page-header idea">
            <div class="col-md-4 col-padding">
              <center><img class="img-responsive img-rounded img-idea" src="{{ $idea->getCover(340,185) }}"></center>
            </div>
            <!-- idea -->
            <div class="col-md-6 col-padding idea">
              <div class="col-md-12 no-padding">
                <div class="col-md-8 col-padding section-idea info-idea">
                  <div class="col-md-12 no-padding title">
                    <span class="subject">{{ $idea->title }}</span> 
                  </div>
                  <div class="col-md-12 no-padding tags">
                    <i class="fa fa-tags"></i> 
                    @foreach($idea->tags as $tag)
                    <?php $labels = ['primary', 'danger', 'info', 'warning', 'success']?>
                    <span class="label label-{{ $labels[array_rand($labels)] }}">{{ $tag->name }}</span>
                    @endforeach
                  </div>
                </div>

                <div class="col-md-4 col-padding pull-right">
                  @include('layout.media-shares')
                </div>
              </div>

              <div class="col-md-12 no-padding section-idea criteria-idea">
                <div class="col-md-4 col-padding text-center">
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
                   fa-2x text-primary" alt="{{ $idea->category }}"></i><br><br>
                  <b>{{ ucfirst($idea::CATEGORY[$idea->category]) }}</b>
                </div>
                <div class="col-md-4 col-padding text-center">
                  <i class="fa fa-map-marker fa-2x text-primary"></i><br><br>
                  <b>{{ ucfirst($idea->location) }}</b>
                </div>
                <div class="col-md-4 col-padding">
                </div>
              </div>

              <div class="col-md-12 no-padding section-idea action-idea">
                @if($idea->likes()->find(auth()->user()->id))
                <a href="#" class="btn btn-primary btn-lg">Tidak Menyukai</a>
                @else
                <a href="#" class="btn btn-primary btn-lg">Menyukai</a>
                @endif
                @unless($idea->members()->find(auth()->user()->id))
                <a href="{{ route('idea.join', $idea) }}" class="btn btn-primary btn-lg">Bergabung</a>
                @endif
                @if($idea->isAdmin(auth()->user()))
                <a href="{{ route('idea.edit', $idea) }}" class="btn btn-primary btn-lg pull-right">Perbaharui Ide</a>
                @endif
              </div>
            </div>
            <!-- user -->
            <div class="col-md-2 col-padding text-center">
              <a href="{{ route('user.show', $idea->user) }}">
                <img class="img-circle img-creator" src="{{ $idea->user->getPhoto(100) }}">
              </a>
              <br><br>
              <b>
                <a href="{{ route('user.show', $idea->user) }}" class="creator">{{ $idea->user->name }}</a>
              </b>
            </div>
          </div>
          <div class="col-md-12 col-padding idea">
            {!! $idea->description !!}
          </div>
          <div class="col-md-12 page-header">
            <h3><b>Anggota<b></h3>
          </div>
          <div class="col-md-12 text-center">
            @foreach($idea->members()->paginate(11) as $user)
            <div class="col-md-1 col-padding">
              <img src="{{ $user->getPhoto(100) }}" class="img-responsive img-circle"><br>
              <a href="{{ route('user.show', $user) }}" class="">{{ $user->name }}</a>
            </div>
            @endforeach
          </div>
          <div class="col-md-12 page-header">
            <h3><b>Galeri Foto dan Video<b></h3>
          </div>
          <div class="col-md-12">
            @foreach($idea->photos as $photo)
            <div class="col-md-2">
              <img src="{{ $photo->getUrl() }}" class="img-responsive">
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection