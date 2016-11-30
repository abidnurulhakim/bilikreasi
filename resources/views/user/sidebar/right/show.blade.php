@extends('user.sidebar.right.layout')
@section('user.sidebar.right.content')
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs pull-right">
      <li><a href="{{ route('user.invitation', $user) }}"><i class="fa fa-envelope"></i> Permintaan Bergabung</a></li>
      <li class="active"><a href="{{ route('user.show', $user) }}"><i class="fa fa-share-alt"></i> Ide Terhubung</a></li>
      <li><a href="{{ route('idea.create') }}"><i class="fa fa-plus"></i> Buat Ide Baru</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active col-padding">
        {{ Carbon::setLocale('id') }}
        @forelse ($ideas->chunk(3) as $chunk)
        <div class="row">
          @foreach ($chunk as $idea)
          <div class="col-sm-4 col-padding">
            @include('idea.card', compact('idea'))
          </div>
          @endforeach
        </div>
        @empty
          <h4 class="text-center text-muted">-- Belum bergabung dengan ide manapun. --</h4>
        @endforelse
        <div class="col-sm-12 text-center">
          {!! $ideas->links() !!}
        </div>
      </div>
    </div>
  </div>
@endsection
