@foreach($invitations as $invitation)
  @php
    $idea = $invitation->idea;
  @endphp
  <div class="grid-item col-xs-12 col-md-4">
    @include('idea.card', compact('idea', 'invitation'))
  </div>
@endforeach