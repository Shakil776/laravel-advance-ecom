  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/admin/dashboard') }}" class="brand-link">
      <img src="{{ asset('images/admin_images/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <a href="{{ route('admin.profile') }}">
        <div class="image">
            @if(!empty(Auth::guard('admin')->user()->image))
            <img class="img-circle elevation-2" alt="User Image" src="{{ asset('images/admin_images/admin_photos/'.Auth::guard('admin')->user()->image) }}">
            @else
            <img class="img-circle elevation-2" alt="User Image" src="{{ asset('images/admin_images/default_admin_photo.jpg') }}">
            @endif
        </div>
        <div class="info">
          <a href="{{ route('admin.profile') }}" class="d-block">{{ ucwords(Auth::guard('admin')->user()->name) }}</a>
        </div>
      </a>
        
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ url('/admin/dashboard') }}" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <!-- Settings -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.settings') }}" class="nav-link">
                <i class="nav-icon far fa-circle text-info"></i>
                  <p>Change Password</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Catalogues -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Catalogues
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.sections') }}" class="nav-link">
                <i class="nav-icon far fa-circle text-info"></i>
                  <p>Sections</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.brands') }}" class="nav-link">
                <i class="nav-icon far fa-circle text-info"></i>
                  <p>Brands</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.categories') }}" class="nav-link">
                <i class="nav-icon far fa-circle text-info"></i>
                  <p>Categories</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('admin/products') }}" class="nav-link">
                <i class="nav-icon far fa-circle text-info"></i>
                  <p>Products</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('admin/sliders') }}" class="nav-link">
                <i class="nav-icon far fa-circle text-info"></i>
                  <p>Sliders</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>