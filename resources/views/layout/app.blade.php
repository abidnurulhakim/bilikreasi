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
    <link rel="stylesheet" href="{{ elixir('css/base.css') }}">
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

    @include('layout.header')
    <!-- Page Content -->
    <div class="container">
      @yield('content')
      @if(false)
      <div class="fixed-action-btn">
        <a class="btn-floating btn-large red">
          <i class="fa fa-bars fa-lg"></i>
        </a>
        <ul>
          <li><a class="btn-floating tooltipster" href="{{ route('user.show', auth()->user()->username) }}" data-placement="left" title="Beranda"><i class="fa fa-home"></i></a></li>  
          <li><a class="btn-floating tooltipster" href="{{ route('idea.create') }}" data-placement="left" title="Buat Ide"><i class="fa fa-lightbulb-o"></i></a></li>
          <li><a class="btn-floating tooltipster" href="{{ route('discussion.index') }}" data-placement="left" title="Ruang diskusi"><i class="fa fa-comments"></i></a></li>
          <li><a class="btn-floating tooltipster" href="{{ route('user.edit', auth()->user()->username) }}" data-placement="left" title="Perbarui profil"><i class="fa fa-user"></i></a></li>
          <li><a class="btn-floating tooltipster" href="{{ route('user.edit-password', auth()->user()->username) }}" data-placement="left" title="Ganti password"><i class="fa fa-lock"></i></a></li>
          <li><a class="btn-floating tooltipster" href="{{ route('session.logout') }}" data-placement="left" title="Keluar"><i class="fa fa-sign-out"></i></a></li>
        </ul>
      </div>
      @endif
    </div>
    <!-- /.container -->
    @include('layout.footer')
    <!--  Scripts-->
    <script src="{{ elixir('js/modernizr.min.js') }}"></script>
    <link rel="stylesheet" href="{{ elixir('css/application.css') }}">
    <script type="text/javascript"> var myPrefix = '{{ asset('') }}';</script>
    <script type="text/javascript"> var pusherKey = '{{ config('broadcasting.connections.pusher.key') }}';</script>
    <script src="{{ elixir('js/application.js') }}"></script>
  </body>
</html>
