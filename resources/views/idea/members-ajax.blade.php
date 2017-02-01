@forelse($users as $user)
  <div class="grid-item col-xs-12 col-md-4">
    @include('user.card', $user)
  </div>
@empty
  <h4 class="text-center text-muted">-- Tidak ada user yang ditemukan --</h4>
@endforelse