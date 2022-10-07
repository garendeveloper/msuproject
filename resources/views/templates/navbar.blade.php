<nav class="main-header navbar navbar-expand navbar-white navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li> 
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('/dashboard')}}" class="nav-link">Home</a>
      </li>
      @if($userinfo[0]->departmentname == "PPU HEAD" || $userinfo[0]->departmentname == "FINANCIAL DIVISION")
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/approvedjobrequests')}}" class="nav-link">Approved Job Requests
            <span class="float-right text-muted text-sm" style = "color: green">
            <span class = "badge badge-success"> {{ $no_ofapproved[0]->total_approved}}</span></span>
        </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/unapprovedjobrequests')}}" class="nav-link">Job Requests Under Funds Availability
        <span class="float-right text-muted text-sm" style = "color: yellow">
            <span class = "badge badge-warning"> {{ $no_ofunapproved[0]->total_unapproved}}</span></span>
        </a>
      </li>
      @endif
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      

     
      
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
     
    </ul>
  </nav>