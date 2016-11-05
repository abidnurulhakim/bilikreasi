@extends('idea.layout')
@section('idea-content')
  <div class="col-md-12">
    <div class="card">
      <div class="card-block">
        <!-- left -->
        <div class="col-md-12 col-padding">
          <div class="col-md-12 no-padding page-header idea">
            <div class="col-md-4 col-padding">
              <center><img class="img-responsive img-rounded img-idea" src="http://lorempixel.com/270/160"></center>
            </div>
            <div class="col-md-6 col-padding idea">
              <div class="col-md-12 no-padding title">
                <span class="subject">Bandung Movie Club</span> &mdash; <a href="#" class="creator">Joshua</a>
              </div>
              <div class="col-md-12 no-padding category">
                <span class="tag tag-pill tag-primary">Movie</span>
                <span class="tag tag-pill tag-danger">Community</span>
                <span class="tag tag-pill tag-default">Horror</span>
              </div>
              <div class="col-md-12 no-padding location">
                <i class='fa fa-map-marker'></i> At Bandung
              </div>
              <div class="col-md-12 no-padding action">
                <a href="#" class="btn btn-primary">Like</a>
                <a href="#" class="btn btn-primary">Comment</a>
                @include('layout.media-shares')
              </div>
            </div>
            <div class="col-md-1 col-padding">
              <a href="#"><img class="img-responsive img-circle img-creator" src="http://lorempixel.com/150/150"></a>
            </div>
          </div>
          <div class="col-md-12 no-padding idea">
            <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a odio nec velit vestibulum auctor sed sed quam. Suspendisse vel dignissim tellus. Praesent laoreet felis eu quam pharetra, in faucibus tellus tempus. Suspendisse lectus dolor, blandit vitae est ut, tempus gravida augue. Aenean tristique massa arcu. Nam pretium tortor ac ornare posuere. Proin rutrum leo non ex sagittis, sit amet ullamcorper risus ullamcorper. Nunc in tincidunt mi, id placerat purus. Fusce enim leo, lobortis non ipsum ut, rutrum eleifend mauris. Nam a lacus auctor massa viverra gravida nec vel diam. Nam pellentesque purus eu est viverra hendrerit. Donec consequat ligula vel ex consectetur, in venenatis massa semper. Ut elementum lectus et metus volutpat laoreet. Curabitur quis lorem nec risus imperdiet gravida. Phasellus malesuada mauris quis mi blandit mollis.

              Sed malesuada ornare sapien, et lobortis neque ultricies vitae. Vivamus quis hendrerit elit. Nunc euismod urna sit amet eros sagittis, tristique congue justo molestie. Aenean posuere leo et purus feugiat, sed interdum arcu consequat. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla posuere ullamcorper mauris, eget elementum orci accumsan ut. Aliquam vel dapibus dui, ac sodales est. Cras vel nunc a lorem suscipit accumsan in faucibus ligula. Nullam lacinia placerat dui, nec ultrices lacus faucibus nec. Duis lacinia pharetra felis, vel faucibus felis pulvinar non.

              Nullam at justo sit amet nisl faucibus commodo id vel diam. Maecenas cursus est nec lobortis varius. Morbi sodales id arcu vel commodo. Cras sapien metus, sollicitudin fringilla turpis at, consectetur mollis augue. Sed rutrum augue sit amet tortor aliquam gravida. Morbi hendrerit orci ut nisi posuere vehicula. Nulla in ante in mi euismod venenatis nec in augue.

              Nam ornare in augue nec molestie. Donec accumsan, urna at porttitor ullamcorper, mauris sem commodo eros, at facilisis lacus dolor id nibh. Nunc scelerisque porttitor diam, eu aliquet erat. Maecenas in lectus sed sapien posuere elementum. Duis feugiat condimentum maximus. Donec efficitur sapien sit amet sapien interdum eleifend. Nulla facilisi. Etiam dapibus vehicula est, vitae vulputate magna ornare vel. Integer lacinia erat sit amet tellus congue blandit. Praesent non interdum turpis, id condimentum leo. Cras at vehicula odio. Maecenas augue magna, efficitur sit amet malesuada ut, semper eu magna. Donec commodo metus eros, et ultricies sapien facilisis vitae.

              Morbi interdum lacus laoreet interdum lobortis. Nullam sollicitudin, ligula nec lacinia rhoncus, urna ante dignissim justo, ac venenatis turpis nibh quis massa. Mauris condimentum feugiat egestas. Aliquam venenatis ante eget interdum dignissim. Suspendisse nec lobortis elit. Donec dignissim cursus lectus at sodales. Etiam dui magna, ultricies eget cursus sit amet, finibus quis diam. Aliquam erat volutpat. Pellentesque molestie elit mollis, tristique urna ut, fringilla lectus. Nulla et facilisis magna, sit amet ullamcorper elit. Aliquam fringilla libero eu libero posuere, sit amet consequat lorem commodo. Praesent interdum et tellus eget imperdiet. Cras auctor, ante ac elementum iaculis, tortor dolor feugiat dui, id consequat metus mauris a metus. Curabitur mattis vel dolor a vulputate.
            </p>
          </div>
        </div>
        <!-- right -->
        <!-- <div class="col-md-3 col-padding">
          <div class="panel panel-danger reason-join">
            <div class="panel-heading">Kenapa Kamu Ingin Bergabung?</div>
            <div class="panel-body">
              <form>
                <div class="form-group">
                  <textarea class="form-control" rows="6"></textarea>
                </div>
                <center>
                  <button type="submit" class="btn btn-primary btn-lg">Let Me Join</button>
                </center>
              </form>
            </div>
          </div>
        </div> -->
      </div>
    </div>
  </div>
@endsection