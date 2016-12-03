<!-- Content Row -->
@forelse($populars as $popular)
  <h2 class="text-center text-primary header-index">
    {{ $popular->title }}
  </h2>
  @foreach ($popular->ideas->chunk(4) as $chunk)
  <div class="row">
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
<div class="row">
  <div class="col-sm-3">
    <div class="card">
      <div class="card-block">
        <h4 class="card-title">Card title 1</h4>
        <h6 class="card-subtitle text-muted">Support card subtitle</h6>
      </div>
      <img src="http://lorempixel.com/360/250" class='img-responsive' alt="Card image">
      <div class="card-block">
        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean quis diam quis lectus blandit mattis. In faucibus ligula neque, ac viverra risus fermentum vitae. Pellentesque sem leo, consectetur in ex eu, hendrerit ultrices lacus. Proin dapibus accumsan mattis. Pellentesque vitae sagittis quam. Curabitur consectetur efficitur nisl, non tempor turpis vestibulum.</p>
        <a href="#" class="pull-right btn btn-primary">Join me</a>
      </div>
      <div class="card-footer text-muted">
        <i class="fa fa-clock-o" aria-hidden="true"></i> <span>2 days ago</span>
      </div>
    </div>
  </div>
  <!-- /.col-md-4 -->
  <div class="col-sm-3">
    <div class="card">
      <div class="card-block">
        <h4 class="card-title">Card title 2</h4>
        <h6 class="card-subtitle text-muted">Support card subtitle</h6>
      </div>
      <img src="http://lorempixel.com/360/250" class='img-responsive' alt="Card image">
      <div class="card-block">
        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean quis diam quis lectus blandit mattis. In faucibus ligula neque, ac viverra risus fermentum vitae. Pellentesque sem leo, consectetur in ex eu, hendrerit ultrices lacus. Proin dapibus accumsan mattis. Pellentesque vitae sagittis quam. Curabitur consectetur efficitur nisl, non tempor turpis vestibulum.</p>
        <a href="#" class="pull-right btn btn-primary">Join me</a>
      </div>
      <div class="card-footer text-muted text-center">
        <i class="fa fa-clock-o" aria-hidden="true"></i> <span>2 days ago</span>
      </div>
    </div>
  </div>
  <!-- /.col-md-4 -->
  <div class="col-sm-3">
    <div class="card">
      <div class="card-block">
        <h4 class="card-title">Card title 3</h4>
        <h6 class="card-subtitle text-muted">Support card subtitle</h6>
      </div>
      <img src="http://lorempixel.com/360/250" class='img-responsive' alt="Card image">
      <div class="card-block">
        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean quis diam quis lectus blandit mattis. In faucibus ligula neque, ac viverra risus fermentum vitae. Pellentesque sem leo, consectetur in ex eu, hendrerit ultrices lacus. Proin dapibus accumsan mattis. Pellentesque vitae sagittis quam. Curabitur consectetur efficitur nisl, non tempor turpis vestibulum.</p>
        <a href="#" class="pull-right btn btn-primary">Join me</a>
      </div>
      <div class="card-footer text-muted text-center">
        <i class="fa fa-clock-o" aria-hidden="true"></i> <span>2 days ago</span>
      </div>
    </div>
  </div>
  <!-- /.col-md-4 -->
</div>
<!-- /.row -->
@endforelse
