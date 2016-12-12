@foreach($invitations as $invitation)
  @php
    $idea = $invitation->idea;
    $user = null
  @endphp
  <div class="grid-item col-sm-3 col-padding">
    @include('idea.card', compact('idea', 'invitation', 'user'))
  </div>
@endforeach