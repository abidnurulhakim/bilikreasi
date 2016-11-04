@if($pageHeader)
  <div class="col-md-12">
    <div class="page-header">
      <div class="title">
        {{ $pageTitle }}
      </div>
      @if($useMediaShare)
        @include('layout.media-shares')
      @endif
    </div>
  </div>
@endif