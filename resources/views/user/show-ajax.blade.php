@foreach($ideas as $idea)
  <div class="grid-item col-sm-3 col-padding">
    @include('idea.card', $idea)
  </div>
@endforeach