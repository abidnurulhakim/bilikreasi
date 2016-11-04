@extends('discuss.layout')
@section('discuss-content')
  <div class="col-md-12">
        <!-- left -->
    <div class="col-md-4 col-padding">
      <div class="card">
        <div class="card-block">
          <div class="col-md-12 no-padding">
            <form>
              <div class="form-group">
                <input type="search" class="form-control" id="search-discuss" aria-describedby="search-discuss" placeholder="Cari">
              </div>
            </form>
          </div>
          <ul class="list-group">
            <a class="list-group-item discuss" href="#">Gerak Jalan Bandung</a>
            <a class="list-group-item discuss" href="#">Movie Club Bandung</a>
            <a class="list-group-item discuss" href="#">Festival Jepang Bandung</a>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-8 col-padding">
      <div class="card">
        <div class="card-block discusses">
          <div class="alert alert-info message other" role="alert">
            <div class="col-md-1 no-padding leftbar">
              <center>
                <img class="img-responsive img-circle img-user-xs" src="http://lorempixel.com/50/50">
              </center>
            </div>
            <div class="col-md-11 col-padding rightbar">
              <div class="col-md-12 no-padding user">
                <a href="#">Abid Nurul Hakim</a>
              </div>
              <div class="col-md-12 no-padding content">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean quis diam quis lectus blandit mattis.
                </p>
              </div>
            </div>
          </div>
          <div class="alert alert-success message owner" role="alert">
            <div class="col-md-12 no-padding content text-right">
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean quis diam quis lectus blandit mattis.
              </p>
            </div>
          </div>
          <div class="alert alert-success message owner" role="alert">
            <div class="col-md-12 no-padding content text-right">
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean quis diam quis lectus blandit mattis.
              </p>
            </div>
          </div>
          <div class="alert alert-info message other" role="alert">
            <div class="col-md-1 no-padding leftbar">
              <center>
                <img class="img-responsive img-circle img-user-xs" src="http://lorempixel.com/50/50">
              </center>
            </div>
            <div class="col-md-11 col-padding rightbar">
              <div class="col-md-12 no-padding user">
                <a href="#">Joshua</a>
              </div>
              <div class="col-md-12 no-padding content">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean quis diam quis lectus blandit mattis.
                </p>
              </div>
            </div>
          </div>
          <!-- hr -->
        </div>
        <hr class="discuss">
        <!-- input discuss -->
        <div class="card-block">
          <form>
            <div class="form-group">
              <textarea class="form-control" rows="6"></textarea>
            </div>
            <button type="submit" class="btn btn-primary pull-right">Send</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection