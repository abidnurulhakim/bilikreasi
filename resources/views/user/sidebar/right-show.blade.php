<div class="col-md-9">
  <div class="card">
    <div class="card-header profile text-center">Beranda</div>
    <div class="card-block">
      <!-- Nav tabs -->
      <div class='tabs-x tabs-above tab-bordered tab-align-right tab-height-lg tabs-krajee'>
        <ul id="myTab-5" class="nav nav-tabs" role="tablist">
          <li><a href="{{ route('idea.create') }}" role="tab"><i class="fa fa-plus"></i> Buat Ide Baru</a></li>
          <li class="active"><a href="{{ route('user.show', $user) }}" role="tab"><i class="fa fa-share-alt"></i> Ide Terhubung</a></li>
          <li><a href="{{ route('user.invitation', $user) }}" role="tab"><i class="fa fa-envelope"></i> Permintaan Bergabung</a></li>
        </ul>
        <div id="myTabContent-5" class="tab-content">
          <div class="tab-pane fade in active col-padding" id="home-5">
            {{ Carbon::setLocale('id') }}
            @forelse ($ideas->chunk(3) as $chunk)
            <div class="row">
              @foreach ($chunk as $idea)
              <div class="col-md-4 col-padding">
                @include('idea.card', compact('idea'))
              </div>
              @endforeach
            </div>
            @empty
              <h4 class="text-center text-muted">-- Belum bergabung dengan ide manapun. --</h4>
            @endforelse
            <div class="col-md-12 text-center">
              {!! $ideas->links() !!}
            </div>
          </div>
        </div>
    </div>
    </div>
  </div>
</div>