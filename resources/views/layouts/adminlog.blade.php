<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin Login</title>

  <link rel="stylesheet" href="{{ asset('css/all.min.css')}}">
  <link rel="stylesheet" href="{{ asset('css/toastr.min.css')}}">
  <link rel="stylesheet" href="{{ asset('../css/icheck-bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('../css/adminlte.min.css')}}">
  </head>
<body class="hold-transition login-page">
<div class="login-box">

  <div class="card">
    <div class="card-body login-card-body">
      <div class="login-logo">
        <a href="{{ route('admin.login')}}"><b>Crystal</b></a>
      </div>
      @yield('content')
    </div>
  </div>
</div>


<script src="{{ asset('../js/jquery.min.js')}}"></script>
<script src="{{ asset('js/toastr.min.js')}}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script>

@if(isset($exJS))
    <script src="{{route('admin.script', ['script' => $special_js])}}" defer></script>
@endif

</body>
</html>
