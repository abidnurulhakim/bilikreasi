<div class="col-md-4">
  <div class="card">
    <div class="card-header profile text-center">Profil Saya</div>
    <div class="card-block">
      <ul class="list-group">
        <li class="list-group-item"><i class="fa fa-user fa-lg"></i> {{ $user->name }}</li>
        <li class="list-group-item"><i class="fa fa-heart fa-lg"></i>
        @foreach($user->interests as $interest)
          <span class="label label-primary">{{ $interest->name }}</span>
        @endforeach
        </li>
        <li class="list-group-item"><i class="fa fa-gears fa-lg"></i>
        @foreach($user->skills as $skill)
          <span class="label label-primary">{{ $skill->name }}</span>
        @endforeach
        </li>
        <li class="list-group-item"><i class="fa fa-suitcase fa-lg"></i> {{ $user->profession }}</li>
        <li class="list-group-item"><i class="fa fa-map-marker fa-lg"></i> {{ $user->live_at }}</li>
      </ul>
    </div>
  </div>
</div>