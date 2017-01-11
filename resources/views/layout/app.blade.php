<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <meta name="description" content="Idea-sharing platform pertama di Indonesia yang juga menjadi wadah kolaborasi bagi para user untuk menciptakan perubahan melalui ide yang tersalurkan baik dalam bentuk usaha profitable, komunitas, aksi/gerakan, riset/proyek, ataupun bentuk kegiatan lainnya">
    <meta name="author" content="Bilikreasi">
    <meta name="title" content="Bilikreasi - Connecting People Through Ideas">
    <meta name="keywords" content="idea, connection, ide, partisipasi, plan, bilikreasi, connecting people through ideas">
    @if(isset($idea))
    <!-- twitter meta -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@bilikreasi">
    <meta name="twitter:creator" content="@bilikreasi">
    <meta name="twitter:title" content="{{ $idea->title }}">
    <meta name="twitter:description" content="{{ str_limit(strip_tags($idea->description), 300) }}">
    <meta name="twitter:image" content="{{ $idea->getCover() }}">
    <meta name="twitter:image:alt" content="{{ $idea->title }}">
    <!-- facebook meta -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('idea.show', $idea) }}" />
    <meta property="og:title" content="{{ $idea->title }}"/>
    <meta property="og:image" content="{{ $idea->getCover() }}"/>
    <meta property="og:site_name" content="Bilikreasi"/>
    <meta property="og:description" content="{{ str_limit(strip_tags($idea->description), 300) }}"/>
    @endif
    <title>Bilikreasi - Connecting People Through Ideas</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}" />
    <link rel="stylesheet" href="{{ elixir('css/application.css') }}">
</head>

<body>
    @if(Session::get('success'))
      <div id="notification-success" data-text="{{ Session::get('success') }}" class="hidden"></div> 
    @endif
    @if(Session::get('info'))
      <div id="notification-info" data-text="{{ Session::get('info') }}" class="hidden"></div> 
    @endif
    @if(Session::get('alert'))
      <div id="notification-alert" data-text="{{ Session::get('alert') }}" class="hidden"></div> 
    @endif
    @if(Session::get('error'))
      <div id="notification-error" data-text="{{ Session::get('error') }}" class="hidden"></div> 
    @endif

    @include('navigation.layout')
    <!-- Page Content -->
    <div class="container">
      @yield('content')
      @if(true)
      <div class="fixed-action-btn">
        <a class="btn-floating btn-large primary tooltipster" data-toggle="modal" data-target="#modalFeedback" data-placement="top" title="Feedback">
          <i class="fa fa-envelope fa-lg"></i>
        </a>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="modalFeedback" tabindex="-1" role="dialog" aria-labelledby="modalFeedbackLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Kritik, Saran dan Keluhan</h4>
            </div>
            {!! Form::open(['route' => 'feedback.store', 'method' => 'post', 'files' => true]) !!}
            <div class="modal-body">
              @if (isset($errors) && count($errors) > 0)
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
              <div class="form-group">
                {!! Form::label('name', 'Nama') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Nama Anda', 'required' => true]) !!}
              </div>
              <div class="form-group">
                {!! Form::label('email', 'Email') !!}
                {!! Form::email('email', (auth()->user() ? auth()->user()->email : null), ['class' => 'form-control', 'placeholder' => 'Masukkan Email Anda', 'required' => true]) !!}
              </div>
              <div class="form-group">
                {!! Form::label('subject', 'Judul') !!}
                {!! Form::text('subject', null, ['class' => 'form-control', 'placeholder' => 'Judul', 'required' => true]) !!}
              </div>
              <div class="form-group">
                {!! Form::label('content', 'Isi') !!}
                {!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Isi', 'required' => true]) !!}
              </div>
              {!! Form::formFile('attachments', null, ['label' => 'Attachment (Gambar)', 'placeholder' => 'Attachment', 'data-max-file-count' => '5', 'data-max-file-size' => '20480', 'data-allowed-file-types' => '["image"]', 'multiple' => 'true'] ) !!}
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              {!! Form::submit('Kirim', ['class' => 'btn btn-primary']); !!}
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
      @endif
    </div>
    <!-- /.container -->
    @include('layout.footer.layout')
    
</body>
  <script type="text/javascript"> var myPrefix = '{{ asset('') }}';</script>
  <script type="text/javascript"> var pusherKey = '{{ config('broadcasting.connections.pusher.key') }}';</script>
  <script src="{{ elixir('js/application.js') }}"></script>
</html>
