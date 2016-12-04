<div class="col-sm-3">
  <div class="box box-primary">
    <div class="box-body box-profile">
      <img class="profile-user-img img-responsive img-circle" src="{{ $user->getPhoto(128) }}" alt="User profile picture">

      <h3 class="profile-username text-center">{{ $user->name }}</h3>

      <p class="text-muted text-center">{{ $user->profession }}</p>

      <ul class="list-group list-group-unbordered">
        <li class="list-group-item">
          <b>Jumlah ide</b> <a class="pull-right">{{ $user->ideas()->count() }}</a>
        </li>
        <li class="list-group-item">
          <b>Jumlah Partisipasi</b> <a class="pull-right">{{ $user->memberOf()->count() }}</a>
        </li>
      </ul>
    </div>
    <!-- /.box-body -->
  </div>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Riwayat</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <strong><i class="fa fa-suitcase margin-r-5"></i> Perkerjaan</strong>
      <p class="text-muted">
        {{ $user->profession }}
      </p>
      <hr>
      <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
      <p class="text-muted">{{ $user->live_at }}</p>
      <hr>
      <strong><i class="fa fa-heart margin-r-5"></i> Minat</strong>
      <p>
        @foreach($user->interests as $interest)
          <span class="label label-primary">{{ $interest }}</span>
        @endforeach
      </p>
      <hr>
      <strong><i class="fa fa-gears margin-r-5"></i> Kemampuan</strong>
      <p>
        @foreach($user->skills as $skill)
          <span class="label label-primary">{{ $skill }}</span>
        @endforeach
      </p>
    </div>
    <!-- /.box-body -->
  </div>
</div>