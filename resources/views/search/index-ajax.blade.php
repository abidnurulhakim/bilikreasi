@forelse($ideas as $idea)
  <div class="grid-item col-xs-12 col-md-4">
    @include('idea.card', $idea)
  </div>
@empty
  <h4 class="text-center text-muted">-- Tidak ada ide yang ditemukan --</h4>
@endforelse