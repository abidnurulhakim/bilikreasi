<div id="banner" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    @for ($i = 0; $i < $banners->count(); $i++)
      <li data-target="#banner" data-slide-to="{{ $i }}" @if($i == 0) class="active" @endif></li>
    @endfor
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    @for ($i = 0; $i < $banners->count(); $i++)
    <div class="item @if($i == 0) active @endif" id="banner-{{ $banners->get($i)->id }}">
      <img src="{{ $banners->get($i)->getImage(1200, 400) }}" class="img-responsive" alt="{{ $banners->get($i)->title }}">
      <div class="carousel-caption">
        {{ $banners->get($i)->description }}
      </div>
    </div>
    @endfor
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#banner" role="button" data-slide="prev">
    <span class="fa fa-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#banner" role="button" data-slide="next">
    <span class="fa fa-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>