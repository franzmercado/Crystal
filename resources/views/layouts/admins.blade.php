<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Crystal') }}</title>

  <link rel="icon" type="image/png" href="{{ asset('dist/img/crystalLogo.png') }}">

  <link rel="stylesheet" href="{{ asset('css/app.css')}}">
  <link rel="stylesheet" href="{{ asset('css/toastr.min.css')}}">
  <link rel="stylesheet" href="{{ asset('css/OverlayScrollbars.min.css')}}">
  <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('css/custom_admin.css')}}">
  <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('css/chart.css')}}">



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


<script src="{{ asset('js/app.js')}}"></script>
<script src="{{ asset('js/jquery.overlayScrollbars.min.js')}}"></script>
<script src="{{ asset('js/toastr.min.js')}}"></script>
<script src="{{ asset('js/sweetalert2.all.js')}}"></script>
<script src="{{ asset('js/sweetalert2.min.js')}}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('js/chart.js')}}"></script>


@if(isset($exJS))
    <script src="{{route('admin.script', ['script' => $special_js])}}" defer></script>
    <script src="{{route('admin.script', ['script' => $custom_js])}}" defer></script>
@endif



</body>
</html>
