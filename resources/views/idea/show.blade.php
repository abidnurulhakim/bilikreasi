@extends('idea.layout')
@section('idea-content')
  <div class="col-md-12">
    <div class="card">
      <div class="card-block">
        <!-- left -->
        <div class="col-md-12 col-padding">
          <div class="col-md-12 no-padding page-header idea">
            <div class="col-md-4 col-padding">
              <center><img class="img-responsive img-rounded img-idea" src="{{ $idea->getCover(270,160) }}"></center>
            </div>
            <div class="col-md-6 col-padding idea">
              <div class="col-md-12 no-padding title">
                <span class="subject">{{ $idea->title }}</span> &mdash; 
                @if($idea->category == 'business')
                  <i class="fa fa-money text-primary" alt="business"></i> {{ ucfirst($idea::CATEGORY[$idea->category]) }}
                @elseif($idea->category == 'campaign')
                  <i class="fa fa-bullhorn text-primary" alt="campaign"></i> {{ ucfirst($idea::CATEGORY[$idea->category]) }}
                @elseif($idea->category == 'community')
                  <i class="fa fa-users text-primary" alt="community"></i> {{ ucfirst($idea::CATEGORY[$idea->category]) }}
                @elseif($idea->category == 'project')
                  <i class="fa fa-gears text-primary" alt="project"></i> {{ ucfirst($idea::CATEGORY[$idea->category]) }}
                @elseif($idea->category == 'event')
                  <i class="fa fa-calendar text-primary" alt="event"></i> {{ ucfirst($idea::CATEGORY[$idea->category]) }}
                @else
                  <i class="fa fa-bookmark-o text-primary" alt="other"></i> {{ ucfirst($idea::CATEGORY[$idea->category]) }}
                @endif
              </div>
              <div class="col-md-12 no-padding category">
                @foreach($idea->tags as $tag)
                <?php $labels = ['primary', 'danger', 'info', 'warning', 'success']?>
                <span class="label label-{{ $labels[array_rand($labels)] }}">{{ $tag->name }}</span>
                @endforeach
              </div>
              <div class="col-md-12 no-padding location">
                <i class='fa fa-map-marker'></i> At {{ $idea->location }}
              </div>
              <div class="col-md-12 no-padding action">
                <a href="#" class="btn btn-primary">Like</a>
                <a href="#" class="btn btn-primary">Comment</a>
                @include('layout.media-shares')
              </div>
            </div>
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
            <p>
              {{ $idea->description }}
            </p>
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