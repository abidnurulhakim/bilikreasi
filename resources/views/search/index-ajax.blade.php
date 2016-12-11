@forelse($ideas as $idea)
  <div class="grid-item col-sm-3 col-padding">
    @include('idea.card', $idea)
  </div>
@empty
  <h4 class="text-center text-muted">-- Tidak ada ide yang ditemukan --</h4>
@endforelse