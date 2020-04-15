<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" media="screen">



    <title>{{config('app.name')}}</title>
</head>
<body>
<div class="pt-5">

</div>
    @if(isset($nav))
      @if ($nav == 1)
        @include('inc.navbarHome')
      @elseif ($nav == 2)
        @include('inc.navbar')

      @endif
    @endif

<div id="app">
    <main class="container pt-2" style="min-height: 550px; overflow: auto;">
        @yield('content')
    </main>
</div>
    @include('inc.footer')
    <script src="{{asset('js/app.js')}}" defer></script>
    <script src="{{ asset('js/city.js')}}" ></script>
    <script src="{{ asset('js/toastr.min.js')}}" defer></script>
    <script src="{{ asset('js/bootstrap.min.js')}}" defer></script>
    {{-- <script src="{{ asset('js/popper.min.js')}}" defer></script> --}}
    {{-- <script src="https://getbootstrap.com/assets/js/vendor/popper.min.js"></script> --}}
    <script src="{{ asset('js/sweetalert2.all.js')}}"></script>
    <script src="{{ asset('js/sweetalert2.min.js')}}"></script>



    {{-- Success Alert --}}
    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
            {{session('status')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- Error Alert --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{session('error')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(isset($special_js))
    <script src="{{route('script', ['script' => $special_js])}}" defer></script>
    @endif
    @if(isset($custom_js))
    <script src="{{route('script', ['script' => $custom_js])}}" defer></script>
    @endif
</body>
</html>
