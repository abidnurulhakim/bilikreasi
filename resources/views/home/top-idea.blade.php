<!-- Content Row -->
@forelse($populars as $popular)
  <h2 class="text-center text-primary header-index">
    {{ $popular->title }}
  </h2>
  @foreach ($popular->ideas->chunk(4) as $chunk)
  <div class="row col-padding">
    @foreach($chunk as $popularIdea)
    <div class="col-sm-3 col-padding">
      @php
        $idea = $popularIdea->idea
      @endphp
      @include('idea.card', $idea)
    </div>
    @endforeach
  </div>
  @endforeach
@empty
<h2 class="text-center text-primary header-index">
  Trending Ide
</h2>
<div class="row col-padding">
  @for ($i = 0; $i < 4; $i++)
  <div class="col-sm-3 col-padding">
    <div class="card__idea">
      <div class="card__image border-tlr-radius">
          <img src="http://lorempixel.com/400/200/sports/" alt="image" class="border-tlr-radius">
      </div>

      <div class="card__content card__padding">
        <div class="card__share">
          <div class="card__social">  
              <a class="share-icon facebook" href="#"><span class="fa fa-facebook"></span></a>
              <a class="share-icon twitter" href="#"><span class="fa fa-twitter"></span></a>
              <a class="share-icon googleplus" href="#"><span class="fa fa-google-plus"></span></a>
          </div>
          <a id="share" class="share-toggle share-icon" href="#"></a>
        </div>

        <div class="card__meta">
          <a href="#">Web Design</a>
          <time>17th March</time>
        </div>

        <article class="card__article">
          <h4><a href="#">Material Design Card - For Blog Post Article</a></h4>

          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus harum...</p>
        </article>
      </div>

      <div class="card__action">
        <div class="card__author">
            <img src="http://lorempixel.com/40/40/sports/" alt="user">
            <div class="card__author-content">
                By <a href="#">John Doe</a>
            </div>
        </div>
      </div>
    </div>
  </div>
  @endfor
  <!-- /.col-md-4 -->
</div>
<!-- /.row -->
@endforelse
