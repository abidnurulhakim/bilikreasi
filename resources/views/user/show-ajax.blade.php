@foreach($ideas as $idea)
  <div class="grid-item col m3 s12">
    @include('idea.card', $idea)
  </div>
@endforeach