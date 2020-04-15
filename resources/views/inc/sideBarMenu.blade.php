<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{route('admin.home')}}" class="brand-link">
    <img src="{{ asset('dist/img/booze.jpg')}}" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Crystal</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
          <a href="{{route('admin.home')}}" class="nav-link {{ Request::path() == 'admin' ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.transactions')}}" class="nav-link  {{ Request::path() == 'admin/transactions' ? 'active' : '' }}">
            <i class="nav-icon fas fa-truck"></i>
            <p>Manage Orders</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.reports')}}" class="nav-link  {{ Request::path() == 'admin/reports' ? 'active' : '' }}">
            <i class="nav-icon fas fa-file-pdf"></i>
            <p>Reports</p>
          </a>
        </li>

        <li class="nav-header">MAINTENANCE</li>
        <li class="nav-item has-treeview {{ Request::path() == 'admin/products' || Request::path() == 'admin/products/add' || Request::path() == 'admin/products/restock' ? 'menu-open' : '' }}">

          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tags"></i>
            <p>
              Products
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.addProduct')}}" class="nav-link  {{ Request::path() == 'admin/products/add' ? 'active' : '' }}">

              <i class="far fa-circle nav-icon"></i>
                <p>Add Product</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.manageProducts')}}" class="nav-link  {{ Request::path() == 'admin/products' ? 'active' : '' }}">

                <i class="far fa-circle nav-icon"></i>
                <p>Manage Products</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.restockProduct')}}" class="nav-link  {{ Request::path() == 'admin/products/restock' ? 'active' : '' }}">

                <i class="far fa-circle nav-icon"></i>
                <p>Restock</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.users')}}" class="nav-link  {{ Request::path() == 'admin/users' ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>
              User Management
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.categories.index')}}" class="nav-link  {{ Request::path() == 'admin/categories' ? 'active' : '' }}">
            <i class="fas fa-cog nav-icon"></i>
            <p>
              Categories
            </p>
          </a>
        </li>




      </ul>
    </nav>
  </div>
  <!-- /.sidebar -->
</aside>
