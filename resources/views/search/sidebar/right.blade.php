<div class="col-md-8">
  @forelse($ideas as $idea)
    @include('search.card', $idea)
  @empty
    <h4 class="text-center text-muted">-- Tidak ada ide yang ditemukan --</h4>
  @endforelse
  <div class="col-md-12 text-center">
    {!! $ideas->links() !!}
  </div>
</div>