<aside class="main-sidebar sidebar-light-success  elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link logo-switch">
      <img src="{{ URL::asset('backend/img/logo.png') }}" alt="AdminLTE Docs Logo Small" class="brand-image-xl logo-xs ml-4">
      <img src="{{ URL::asset('backend/img/logo.png') }}" alt="AdminLTE Docs Logo Large" class="brand-image-xs logo-xl ml-5" style="left: 12px">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ URL::asset('backend/img/ava.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/dashboard" class="nav-link <?php  if (request()->routeIs('admin.index') || request()->routeIs('dashboard')) {echo 'active';}?> ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @role('tenant')
          <li class="nav-item">
            <a href="/request" class="nav-link <?php  if (request()->routeIs('request.index') ) {echo 'active';}?>">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Add Request
                <span class="right badge badge-warning">4</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('request.list') }}" class="nav-link <?php  if (request()->routeIs('request.list') ||request()->routeIs('request.timeline' )) {echo 'active';}?> ">
              <i class="nav-icon fas fa-list"></i>
              <p>
                My Request
              </p>
            </a>
          </li>
          @endrole

        @role('user')
        <li class="nav-item">
          <a href="{{ route('department.index') }}" class="nav-link <?php  if (request()->routeIs('department.*') ) {echo 'active';}?>">
            <i class="nav-icon fas fa-layer-group"></i>
            <p>
              Request Tenant 
              @if ($counts > 0)
              <span class="badge badge-danger right">{{ $counts }}</span>
              @endif
            </p>
          </a>
        </li>
        {{-- Report --}}
        <li class="nav-item">
          <a href="{{ route('admin.report.index') }}" class="nav-link <?php  if (request()->routeIs('admin.report.*') ) {echo 'active';}?>">
            <i class="nav-icon fas fa-columns"></i>
            <p>
              Report
            </p>
          </a>
        </li>
        @endrole

          @role('admin')
          <li class="nav-item">
            <a href="{{ route('admin.user.index') }}" class="nav-link <?php  if (request()->routeIs('admin.user.*') ) {echo 'active';}?>">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Manage User
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.report.index') }}" class="nav-link <?php  if (request()->routeIs('admin.report.*') ) {echo 'active';}?>">
              <i class="nav-icon fas fa-columns"></i>
              <p>
                Report
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.feedback') }}" class="nav-link <?php  if (request()->routeIs('admin.feedback') ) {echo 'active';}?>">
              <i class="nav-icon fas fa-star"></i>
              <p>
                Feedback 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.roles.index') }}" class="nav-link <?php  if (request()->routeIs('admin.roles.*') ) {echo 'active';}?>">
              <i class="nav-icon fas fa-layer-group"></i>
              <p>
                Roles
              </p>
            </a>
          </li>
          {{-- <li class="nav-item">
            <a href="{{ route('admin.permissions.index') }}" class="nav-link <?php  if (request()->routeIs('admin.permissions.*') ) {echo 'active';}?>">
              <i class="nav-icon far fa-id-card"></i>
              <p>
                Permissions
              </p>
            </a>
          </li> --}}
          @endrole

          <li class="nav-header">Manage User</li>
          
          <li class="nav-item">
            <a href="/profile" class="nav-link  <?php  if (request()->routeIs('profile.*') ) {echo 'active';}?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                User Profile
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
            <a href="<?php route('logout') ?>" class="nav-link" onclick="event.preventDefault();
              this.closest('form').submit();">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                Sign Out
              </p>
              
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>