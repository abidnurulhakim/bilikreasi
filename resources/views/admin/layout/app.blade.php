<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Bilikreasi | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include('admin.layout.header')
  <!-- Left side column. contains the logo and sidebar -->
  @include('admin.layout.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      @yield('dashboard-header')
    </section>

    <!-- Main content -->
    <section class="content">
      @yield('admin-content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @include('admin.layout.footer')

  <!-- Control Sidebar -->
  @include('admin.layout.control-sidebar')

</div>
<!-- ./wrapper -->
<script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
<script type="text/javascript"> var myPrefix = '{{ asset('') }}';</script>
<script src="{{ asset('assets/admin/js/app.js') }}"></script>
<link href="{{ asset('assets/admin/css/app.css') }}" rel="stylesheet">
</body>
</html>
