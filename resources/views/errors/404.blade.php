@extends('layout.app')

@section('content')
  <div class="col-xs-12">
    <div class="card z-depth-3 idea">
      <div class="card-panel">
        <div class="card-block">
          <h1 class="card-title text-center text-primary">Page Not Found <small>Error 404</small></h1>
        </div>
        <div class="card-block text-center">
          <p class="card-text text-center">
            The page you requested could not be found, either contact your webmaster or try again. Use your browsers <b>Back</b> button to navigate to the page you have prevously come from
          </p>
          <p class="card-text text-center">
            <b>Or you could just press this neat little button:</b>
          </p>
          <a href="{{ route('home.index') }}" class="btn btn-lg btn-primary"><i class="fa fa-home"></i> Take Me Home</a>
        </div>
      </div>
    </div>
    @foreach (App\Models\Idea::take(8)->orderBy('like_count', 'desc')->orderBy('member_count', 'desc')->get()->chunk(3) as $chunk)
    <div class="row idea-list">
      @foreach($chunk as $idea)
        <div class="col-sm-12 col-md-4">
          @include('idea.card', $idea)
        </div>
      @endforeach
    </div>
    @endforeach
  </div>
@endsection
