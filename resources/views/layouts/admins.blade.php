<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Crystal') }}</title>


  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{ asset('css/toastr.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{ asset('css/custom_admin.css')}}">
  <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/charts/chart.css')}}">



</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div id="app">
  <div class="wrapper">
  <!-- Navbar -->
    @include('inc.navbarAdmin')
        @include('inc.sideBarMenu')
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <br>
          @yield('content')
      </div><!--/. container-fluid -->
    </section>
    {{-- @include('inc.footerAdmin') --}}

  </div>
  <!-- /.content-wrapper -->
</div>
</div>
<!-- ./wrapper -->
{{-- <script src="{{ asset('plugins/jquery/jquery.min.js')}} "></script> --}}
<script src="{{ asset('js/app.js')}}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script src="{{ asset('js/toastr.min.js')}}"></script>
<script src="{{ asset('js/adminlte.js')}}"></script>
<script src="{{ asset('js/sweetalert2.all.js')}}"></script>
<script src="{{ asset('js/sweetalert2.min.js')}}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('plugins/charts/chart.js')}}"></script>


@if(isset($exJS))
    <script src="{{route('admin.script', ['script' => $special_js])}}" defer></script>
    <script src="{{route('admin.script', ['script' => $custom_js])}}" defer></script>
@endif



</body>
</html>
