      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if (Auth::user()->image === null)
          <img src="{{url('AdminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
          @else
          <img src="{{url('/profile/'.Auth::user()->image) }}" class="img-circle elevation-2" alt="User Image">
          @endif
          
        </div>
        <div class="info">
          <a href="/user/profile" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/home" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/suppliers" class="nav-link">
              <i class="nav-icon fas fa-truck"></i>
              <p>
                Suppliers
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/customers" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Customers
                <span class="badge badge-info right">6</span>
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Products
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview ">
              <li class="nav-item">
                <a href="/products/categories" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/products/units" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Units</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/products/items" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Items</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Transaction
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/transaction/sales" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/transaction/purchases" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stock In / Purchases</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/transaction/stockout" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stock Out</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/report/sales" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sales</p>
                </a>
              </li>
            </ul>
          </li>
          @if (Auth::user()->role == "admin" or Auth::user()->role == "Admin")
          <li class="nav-header">EXAMPLES</li>
          <li class="nav-item">
            <a href="/employees" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Employees
                <span class="badge badge-info right">2</span>
              </p>
            </a>
          </li>
          @endif
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
      