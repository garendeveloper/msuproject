<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- <div class="image" style = "text-align: center">
          <img src="adminlte3/dist/img/AdminLTELogo.png" style = "width: 200px; height: 200px;" class="brand-image img-circle elevation-2" alt="User Image">
        </div> -->

    <div class="brand-link" style="float: middle">
      <img src="{{url('adminlte3/dist/img/AdminLTELogo.png')}}" class="brand-image img-circle elevation-3" style="opacity: .8">
      <img class="brand-text"src="{{url('adminlte3/dist/img/sidebarManajr.png')}}" style="height: 30px"> 
    </div>
    <!-- Sidebar -->
    <div class="sidebar ">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
  
          <div class="image">
            <img src="{{ url('adminlte3/dist/img/avatar.png')}}" class=" img-circle elevation-2" alt="User Image" style="opacity: .8">
          </div>
     
        <div class="info">
          <a href="#" class="d-block">{{ $userinfo[0]->name }}</a>
        </div>
      </div>
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @if($userinfo[0]->departmentname == "PPU HEAD")
          
            <li class="nav-item" id = "dashboard" id = "dashboard">
              <a href="{{ url('/dashboard') }}" class="nav-link" >
                <i class="nav-icon fas fa-list-alt"></i>
                <!-- <ion-icon name="icons/aperture-outline"></ion-icon> -->
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/constructiontypes') }}" class="nav-link">
                <i class="nav-icon fas fa-building"></i>
                <p>Projects</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/constructions') }}" class="nav-link">
                <i class="nav-icon fas fa-building"></i>
                <p>Scope Of Works</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/users') }}" class="nav-link">
                <i class="nav-icon fa fa-street-view"></i>
                <p>Users</p>
              </a>
            </li>
            <li class="nav-item">
            <a href="{{ url('/scheduling') }}" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>Scheduling</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
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
          @endif
          @if($userinfo[0]->departmentname == "FINANCIAL DIVISION")
            <li class="nav-item">
              <a href="{{ url('/checking_fundsAvailability') }}" class="nav-link">
                <i class="nav-icon fa fa-square"></i>
                <p>Funds Availability</p>
              </a>
            </li>
          @endif
          @if($userinfo[0]->departmentname == "JOB REQUESTOR")
          <li class="nav-item">
              <a href="{{ url('/alljobrequests') }}" class="nav-link">
                <i class="nav-icon fa fa-square"></i>
                <p>My Job Requests</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/jobrequest_form') }}" class="nav-link">
                <i class="nav-icon fa fa-square"></i>
                <p>Request Job</p>
              </a>
            </li>
          @endif
         
          <li class="nav-item">
            <a href="{{ url('/logout') }}" class="nav-link">
              <i class="nav-icon fas fa-arrow-right"></i>
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

