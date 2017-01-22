@extends('idea.layout')
@section('idea-content')
  <div class="col-xs-12">
    <div class="card z-depth-3 idea">
      <div class="card-panel row flex-items-xs-top">
        <div class="col-xs-12 text-xs-center hidden-md-up">
          <span class="card-title grey-text text-darken-3">{{ str_limit($idea->title, 100) }}</span>
          <hr>
        </div>
        <div class="col-xs-12 col-md-3 idea--cover">
          <img src="{{ $idea->getCover(200) }}">
        </div>
        <div class="col-xs-12 col-md-9">
          <div class="col-xs-12 text-xs-center hidden-sm-down">
            <span class="card-title grey-text text-darken-3">{{ str_limit($idea->title, 100) }}</span>
            <hr>
          </div>
          <div class="card-block row flex-items-xs-middle">
            <div class="col-xs-1 text-xs-center">
              <i class="fa fa-pencil fa-lg"></i>
            </div>
            <div class="col-xs-10">
              <a href="{{ route('user.show', $idea->user) }}">
                <div class="chip">
                  <img src="{{ $idea->user->getPhoto() }}" alt="Creator">
                  <b>{{ user_name_limit($idea->user->name, 50) }}</b>
                </div>
              </a>
            </div>
          </div>
          <div class="card-block row flex-items-xs-top">
            <div class="col-xs-1 text-xs-center">
              <i class="fa fa-tags fa-lg"></i>
            </div>
            <div class="col-xs-11">
              @foreach(collect($idea->tags) as $tag)
                <div class="chip">
                  <b>{{ $tag }}</b>
                </div>
              @endforeach  
            </div>
          </div>
          <div class="card-block row flex-items-xs-top">
            <div class="col-xs-1 text-xs-center">
              <i class="fa fa-users fa-lg"></i>
            </div>
            <div class="col-xs-11">
              @foreach($idea->members()->take(8)->get() as $user)
                <a href="{{ route('user.show', $user) }}">
                  <div class="chip chip-member">
                    <img src="{{ $user->getPhoto(40) }}" alt="member">
                    {{ user_name_limit($user->name, 15) }}
                  </div>
                </a>
              @endforeach  
              @if($idea->members()->count() > 8)
                <div class="col-xs-12 text-xs-center">
                  <a href="{{ route('idea.members', $idea) }}">
                    <div class="chip chip-member">
                      Semua Anggota
                    </div>
                  </a>
                </div>
              @endif
            </div>
          </div>
          <div class="card-block row flex-items-xs-top">
            <div class="col-xs-1 text-xs-center">
              <i class="fa fa-thumbs-up fa-lg"></i>
            </div>
            <div class="col-xs-11">
              <span class="abbr-number">{{ $idea->like_count }}</span>
            </div>
          </div>
        </div>
        <div class="col-xs-12">
          <hr>
        </div>
        <div class="col-xs-12 row flex-items-xs-middle idea--criteria">
          <div class="col-xs-12 col-md item">
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
          <div class="col-xs-6 col-md item">
            <i class="fa fa-map-marker fa-2x text-primary"></i><br>
            <b>{{ ucfirst($idea->location) }}</b>
          </div>
          <div class="col-xs-6 col-md item">
            <i class="fa fa-flag fa-2x text-primary"></i><br>
            <b>{{ ucfirst($idea->status) }}</b>
          </div>
        </div>
        <div class="col-xs-12">
          <hr>
        </div>
        <div class="col-xs-12 row flex-items-xs-middle idea--share">
          <div class="col-xs-12 text-xs-center"><b>Bagikan ke teman kamu!</b></div>
          <div class="col-xs-2 offset-xs-1 text-xs-center">
            <a class="btn btn-flat btn-block btn-social btn-facebook" href="https://www.facebook.com/dialog/feed?app_id={{ ENV('FACEBOOK_APP_ID') }}&display=popup&caption={{ urlencode($idea->title) }}&link={{ route('idea.show', $idea) }}&redirect_uri={{ route('idea.show', $idea) }}" target="_blank" title="Share to Facebook">
              <span class="fa fa-facebook"></span>
            </a>  
          </div>
          <div class="col-xs-2 text-xs-center">
            <a class="btn btn-flat btn-block btn-social btn-twitter" href="https://twitter.com/intent/tweet?text={{ urlencode(str_limit($idea->title, 100)) }}&url={{ urlencode(route('idea.show', $idea)) }}" target="_blank" title="Tweet to Twitter">
              <span class="fa fa-twitter"></span>
            </a>
          </div>
          <div class="col-xs-2 text-xs-center">
            <a class="btn btn-flat btn-block btn-social btn-google-plus" href="https://plus.google.com/share?url={{ route('idea.show', $idea) }}" title="Share to Google Plus">
              <span class="fa fa-google"></span>
            </a>
          </div>
          <div class="col-xs-2 text-xs-center">
            <a class="btn btn-flat btn-block btn-social btn-whatsapp" href="whatsapp://send?text={{ $idea->title }} {{ route('idea.show', $idea) }}" target="_blank" title="Share to WhatsApp">
              <span class="fa fa-whatsapp"></span>
            </a>
          </div>
          <div class="col-xs-2 text-xs-center">
            <a class="btn btn-flat btn-block btn-social btn-line-messenger" href="http://line.me/R/msg/text/?{{ $idea->title }} {{ route('idea.show', $idea) }}" target="_blank" title="Share to LINE Messenger">
              <img src="{{ asset('assets/images/line-messenger-30x30.png') }}" width="20px" height="20px">
            </a>
          </div>
        </div>
        @if(auth()->user())
          <div class="col-xs-12">
            <hr>
          </div>
          <div class="col-xs-12 row idea--action">
            @if($idea->hasLike(auth()->user()))
            <div class="col-xs text-xs-center">
              <a class="btn btn-flat btn-block btn-primary" href="{{ route('idea.unlike', ['idea' => $idea, 'user' => auth()->user()]) }}" title="unlike">
              <i class='fa fa-thumb-down'></i> Tidak Menyukai</a>
            </div>
            @else
            <div class="col-xs text-xs-center">
              <a class="btn btn-flat btn-block btn-primary" href="{{ route('idea.like', ['idea' => $idea, 'user' => auth()->user()]) }}" title="like">
              <i class="fa fa-thumbs-up"></i> Menyukai
              </a>
            </div>
            @endif
            @unless($idea->isMember(auth()->user()))
            <div class="col-xs text-xs-center">
              <a class="btn btn-flat btn-block btn-primary" href="{{ route('idea.join', $idea) }}" title="like">
              <i class="fa fa-sign-in"></i> Bergabung
              </a>
            </div>
            @endif
            @if($idea->isAdmin(auth()->user()))
            <div class="col-xs text-xs-center">
              <a class="btn btn-flat btn-block btn-primary" href="{{ route('idea.edit', $idea) }}" title="edit">
              <i class="fa fa-edit"></i> Perbaharui Ide
              </a>
            </div>
            @endif
            @if($idea->isAdmin(auth()->user()))
            <div class="col-xs text-xs-center">
              <a class="btn btn-flat btn-block btn-primary" href="{{ route('idea.search.partner', $idea) }}" title="search partner">
              <i class="fa fa-search"></i> Cari Partner
              </a>
            </div>
            @endif
          </div>
        @endif
      </div>
    </div>
    <div class="card z-depth-3 idea">
      <div class="card-panel row flex-items-xs-top">
        <div class="col-xs-12 idea--description">
          <h3 class="grey-text text-darken-3">Deskripsi</h3>
          <hr>
        </div>
        <div class="col-xs-12 idea--description">
          {!! $idea->description !!}
        </div>
      </div>
    </div>
    <div class="row idea">
      <div class="col-xs-12 slick-mobile">
        <div class="gallery">
          @foreach($idea->media()->where('type', 'image')->get() as $image)
            <div class="gallery-item">
              <img src="{{ $image->getUrl(1160, 870) }}">
            </div>
          @endforeach
        </div>
      </div>  
    </div>
    @if($idea->media()->where('type', 'video')->count())
    <div class="card z-depth-3 idea">
      <div class="card-panel row flex-items-xs-middle">
        <div class="col-xs-12">
          <h3 class="grey-text text-darken-3">Video</h3>
          <hr>
        </div>
      @foreach($idea->media()->where('type', 'video')->get() as $video)
        <div class="col-xs-6 col-md-4">
          <video controls>
            <source src="{{ $video->getUrl() }}" type="video/mp4">
            Your browser does not support the video tag.
          </video>
        </div>
      @endforeach
      </div>
    </div>
    @endif
    @if(auth()->check() && $idea->isMember(auth()->user()) && $idea->media()->where('type', 'file')->count())
    <div class="card z-depth-3 idea">
      <div class="card-panel row flex-items-xs-middle">
        <div class="col-xs-12">
          <h3 class="grey-text text-darken-3">Berkas</h3>
          <hr>
        </div>
        <div class="col-xs-12 row idea--files">
          @foreach($idea->media()->where('type', 'file')->get() as $file)
            <a href="{{ $file->getUrl() }}" class="col-xs-3 col-md-2 idea--file text-xs-center" target="_blank">
              <i class="fa fa-file fa-3x"></i><br>
              <b>{{ $file->filename }}</b>
            </a>
          @endforeach
        </div>
      </div>
    </div>
    @endif
  </div>
@endsection