<div class="col-sm-8 col-padding">
  @forelse ($users->chunk(2) as $chunk)
  <div class="row">
    @foreach ($chunk as $user)
    <div class="col-sm-6 col-padding">
      @include('user.card', ['idea' => $idea, 'user' => $user])
    </div>
    @endforeach
  </div>
  @empty
    <h4 class="text-center text-muted">-- Tidak menemukan partner yang tepat. --</h4>
  @endforelse
  <div class="col-sm-12 text-center">
    {!! $users->links() !!}
  </div>
</div>
