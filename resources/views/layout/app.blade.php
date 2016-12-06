<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1260, initial-scale=1.0">
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
      @include('layout.page-header')
      @yield('content')
    </div>
    <!-- /.container -->
    @include('layout.footer')
    <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
    <script type="text/javascript"> var myPrefix = '{{ asset('') }}';</script>
    <script type="text/javascript"> var pusherKey = '{{ config('broadcasting.connections.pusher.key') }}';</script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
</body>

</html>
