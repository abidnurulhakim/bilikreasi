<div class="col-md-12">
  <div class="page-header">
    <div class="title">
      {{ $pageTitle }}
    </div>
    @if(empty($emptyShares))
      @include('layout.media-shares')
    @endif
  </div>
</div>