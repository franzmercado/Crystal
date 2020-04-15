<nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>

  </ul>



  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">

    @if(Auth::guard('admin')->check())
        <li class="nav-item dropdown">
            <a id="adminDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::guard('admin')->user()->fname }}   {{ Auth::guard('admin')->user()->lname }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="adminDropdown">
                <a href="{!! route('admin.profile') !!}" class="dropdown-item">Profile</a>
                <a class="dropdown-item" href="#"
                    onclick="event.preventDefault();
                                    document.querySelector('#admin-logout-form').submit();">
                    Logout
                </a>

                <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    @endif

  </ul>
</nav>
