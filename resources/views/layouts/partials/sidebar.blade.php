
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block">{{ (Auth::user()->name) ?? '' }}</a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Starter Pages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('categories.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categories</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{ route('brands.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Brands</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('sizes.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sizes</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('products.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Products</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('stocks') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stocks</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('stocks.history') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>History</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('return.products') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Return product</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('return.products.history') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Return history</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inactive Page</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ route('users.logout') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>