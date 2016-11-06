<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Bilikreasi</title>
</head>

<body>

    @include('layout.header')

    <!-- Page Content -->
    <div class="container">
      @include('layout.page-header')
      @yield('content')
      @include('layout.footer')
    </div>
    <!-- /.container -->

    <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
    <script type="text/javascript"> var myPrefix = '{{ asset('') }}';</script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
</body>

</html>
