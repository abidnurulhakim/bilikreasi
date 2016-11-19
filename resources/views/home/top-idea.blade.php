<!-- Content Row -->
@forelse ($ideas->chunk(3) as $chunk)
<div class="row">
  @foreach($chunk as $idea)
  <div class="col-md-4 col-sm-12">
    @include('idea.card', $idea)
  </div>
  @endforeach
</div>
@empty
<div class="row">
  <div class="col-md-4 col-sm-12">
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
  <div class="col-md-4 col-sm-12">
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
  <div class="col-md-4 col-sm-12">
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
