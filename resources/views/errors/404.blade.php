@extends('layout.app')

@section('content')
  <div class="row">
    <div class="card col-padding">
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
      <div class="page-header text-center text-primary">
        <h2>Ide Populer</h2>
      </div>
      <div class="card-block">
      @forelse (App\Models\Idea::take(8)->orderBy('like_count', 'desc')->orderBy('member_count', 'desc')->get()->chunk(4) as $chunk)
        <div class="row">
          @foreach ($chunk as $idea)
          <div class="col-md-3 col-padding">
            @include('idea.card', $idea)
          </div>
          @endforeach
        </div>
      @empty
        <h4 class="text-center text-muted">Saat ini belum ada ide yang tersedia</h4>
      @endforelse
      </div>
    </div>
  </div>
@endsection
