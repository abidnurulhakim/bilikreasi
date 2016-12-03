<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width:1260">
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
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
</body>

</html>
