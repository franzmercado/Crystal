<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-primary navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <!-- SEARCH FORM -->
          <form action="{{route('searchProduct')}}"class="form-inline ml-3">
               <div class="input-group input-group-md">
                 <input class="form-control form-control-navbar" id="query" value="{{ request()->input('query')}} " type="search" placeholder="Search" aria-label="Search" size="60">
                 <div class="input-group-append">
                   <button class="btn btn-info" type="submit">
                     <i class="fas fa-search fa-lg"></i>
                   </button>
                 </div>
               </div>
             </form>


        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Authentication Links -->
                @if(Auth::guard('web')->check())
                  <li class="nav-item">
                      <a class="nav-link" href="{{route('carts')}}"><i class="fa fa-shopping-cart fa-lg"></i></a>
                  </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::guard('web')->user()->firstName }} {{ Auth::guard('web')->user()->lastName }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a href="{{route('profile')}}" class="dropdown-item">Profile</a>

                            <a class="dropdown-item" href="#"
                                onclick="event.preventDefault();
                                                document.querySelector('#logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</nav>
