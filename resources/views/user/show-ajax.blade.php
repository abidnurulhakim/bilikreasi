@foreach($ideas as $idea)
  <div class="grid-item col-xs-12 col-md-4">
    @include('idea.card', $idea)
  </div>
@endforeach