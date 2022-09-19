<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="image" style = "text-align: center">
          <img src="adminlte3/dist/img/AdminLTELogo.png" style = "width: 200px; height: 200px;" class="brand-image img-circle elevation-2" alt="User Image">
        </div>

    <!-- <a href="index3.html" class="brand-link">
      <img src="adminlte3/dist/img/AdminLTELogo.png" style = "height: 120px; width: 50px; "  alt="AdminLTE Logo" class="brand-image img-circle" style="opacity: .8">
    -->
    <!-- </a> -->

    <!-- Sidebar -->
    <div class="sidebar ">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
  
          <div class="image">
            <img src="adminlte3/dist/img/avatar.png" class=" img-circle elevation-2" alt="User Image" style="opacity: .8">
          </div>
     
        <div class="info">
          <a href="#" class="d-block">{{ $userinfo['name'] }}</a>
        </div>
      </div>

     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open" id = "dashboard">
            <a href="{{ url('/dashboard') }}" class="nav-link" >
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/users') }}" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>Users</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-circle"></i>
              <p>
                Constructions
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/constructiontypes')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Construction Types</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ url('/checking_fundsAvailability') }}" class="nav-link">
              <i class="nav-icon fa fa-square"></i>
              <p>Funds Availability</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/scheduling') }}" class="nav-link">
              <i class="nav-icon fa fa-square"></i>
              <p>Schedules</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Reports
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/jobrequests')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Job Requests</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/manpowers')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manpowers</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ url('/logout') }}" class="nav-link">
              <i class="nav-icon fa fa-arrow-right"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>

  