<section id="banners">
  <div class="banners">
    @forelse($banners as $banner)
      <div class="banner-item"><img class="img-responsive" src="{{ $banner->getImage(1150, 575) }}"></div>
    @empty
      <div class="banner-item"><img class="img-responsive" src="http://lorempixel.com/1200/600/food/1"></div>
      <div class="banner-item"><img class="img-responsive" src="http://lorempixel.com/1200/600/food/2"></div>
      <div class="banner-item"><img class="img-responsive" src="http://lorempixel.com/1200/600/food/3"></div>
      <div class="banner-item"><img class="img-responsive" src="http://lorempixel.com/1200/600/food/4"></div>
    @endforelse
  </div>
</section>