  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo
    <a href="{{route('home')}}" class="brand-link">
      <img src="{{ asset('img/logo.png')}}" alt="Logo" class="brand-image img-circle elevation-3 bg-white" style="opacity: .8">
      <span class="brand-text font-weight-light">{{env('APP_NAME')}}</span>
    </a>
-->
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if(Auth::user()->thumb!='')
          <a href="{{route('home')}}"><img src="<?php echo URL::asset('img/users/' . Auth::user()->thumb); ?>" width="160" class="img-circle elevation-2" alt="User Image"></a>
          @else
          <a href="{{route('home')}}"><img src="{{ asset('img/users/user.png')}}" width="160" class="img-circle elevation-2" alt="User Image"></a>
          @endif
        </div>
        <div class="info ml-3">
          <a href="{{route('profile')}}" class="d-block"> {{ Auth::user()->name}} {{ Auth::user()->lastname }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
-->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open {{  request()->is('products')||    request()->is('products/*')   ? 'menu-open' : '' }} ">
            <a href="#" class="nav-link {{    request()->is('products') ||   request()->is('products/*') || request()->is('orders') ||   request()->is('orders/*') || request()->is('parcels') ||   request()->is('parcels/*')   ? 'active' : '' }}">
              <i class="nav-icon fas fa-users text-white"></i>
              <p>
                Clients
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('clients.create') }}" class="nav-link {{ request()->is('clients/create')  ? 'active' : '' }}">
                  <i class="fas fa-user-plus nav-icon text-secondary"></i>
                  <p>Nouveau client</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('clients.index') }}" class="nav-link {{ request()->is('clients')  ? 'active' : '' }}">
                  <i class="fas fa-users nav-icon text-secondary"></i>
                  <p>Clients</p>
                </a>
              </li>              
            </ul>
          </li>
          @can('isAdmin')
          <li class="nav-item  {{  request()->is('categories/*') || request()->is('providers/*') || request()->is('categories') ||  request()->is('providers') || request()->is('users') || request()->is('delivery-companies') ||  request()->is('delivery-companies.index')    ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{  request()->is('categories/*') || request()->is('providers/*') || request()->is('categories') || request()->is('providers') || request()->is('users') || request()->is('delivery-companies.index') ||  request()->is('delivery-companies')    ? 'active' : '' }}">
              <i class="nav-icon fas fa-cog text-white"></i>
              <p>
                Paramètres
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{route('users.index')}}" class="nav-link {{ request()->is('users/*') ||  request()->is('users')  ? 'active' : '' }}">
                  <i class="fas fa-users nav-icon text-secondary"></i>
                  <p>Utilisateurs</p>
                </a>
              </li>              
            </ul>
          </li>
          @endcan
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>