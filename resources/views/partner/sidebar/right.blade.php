<div class="col-md-8">
  <div class="card">
    <div class="card-block">
      @forelse ($users->chunk(3) as $chunk)
      <div class="row col-padding">
        @foreach ($chunk as $user)
        <div class="col-md-4 col-padding">
          <div class="card">
            <div class="card-block">
              <h4 class="card-title">
                <a href="{{ route('user.show', $user) }}">
                  <img src="{{ $user->getPhoto(50, 50) }}" class='img-circle' alt="{{ $user->name }}">
                </a>
                <a href="{{ route('user.show', $user) }}">{{ str_limit($user->name, 15)}} </a>
              </h4>
            </div>
            <ul class="list-group">
              <li class="list-group-item"><i class="fa fa-heart fa-lg"></i>
              @foreach($user->interests as $interest)
                <span class="label label-primary">{{ $interest }}</span>
              @endforeach
              </li>
              <li class="list-group-item"><i class="fa fa-gears fa-lg"></i>
              @foreach($user->skills as $skill)
                <span class="label label-primary">{{ $skill }}</span>
              @endforeach
              </li>
              <li class="list-group-item"><i class="fa fa-suitcase fa-lg"></i> {{ $user->profession }}</li>
              <li class="list-group-item"><i class="fa fa-map-marker fa-lg"></i> {{ $user->live_at }}</li>
            </ul>
            <div class="card-block text-center">
              @if($idea->hasInvite($user))
                <a href="{{ route('idea.invitation.remove', [$idea, $user]) }}" class="btn btn-primary">Hapus Undangan</a>
              @else
                <a href="{{ route('idea.invitation', [$idea, $user]) }}" class="btn btn-primary">Undang</a>
              @endif
            </div>
          </div>
        </div>
        @endforeach
      </div>
      @empty
        <h4 class="text-center text-muted">-- Tidak menemukan partner yang tepat. --</h4>
      @endforelse
      <div class="col-md-12 text-center">
        {!! $users->links() !!}
      </div>
    </div>
  </div>
</div>