@if($userinfo[0]->departmentname == "FINANCIAL DIVISION")
  <script>
    alert("You do not have the authority to visit this page!")
    window.location.href = "/checking_fundsAvailability";
  </script>
@endif
<!DOCTYPE html>
<html lang="en">
<head>
  @include('scripts/header')
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="adminlte3/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="100" width="100">
  </div>
  <!-- Navbar -->
  @include('templates/navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('templates/sidebar')
  <!-- /.control-sidebar -->

  <div class="content-wrapper" style="min-height: 387.5px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
            <div class="Schemosys" >
             <h1>Dashboard</h> 
              <!--<img src="adminlte3/dist/img/schemanajr.png" style="height: 50px"> -->
            </div>
          </div><!-- /.col -->
          <hr />
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li> 
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container-fluid">
    <div class="row">

        <!-- BOX 1-->
         <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="card card-primary card-outline">
              <div class="card-body">
                
                  @if($userinfo[0]->departmentname == "PPU HEAD" || $userinfo[0]->departmentname == "FINANCIAL DIVISION")
                  <h1>{{ $no_ofapproved[0]->total_approved}}</h1>
                  @endif

                <p>Awaiting for Scheduling.</p>

                <a href="{{ url('/scheduling') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
          
        <!-- BOX 2-->
         <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="card card-primary card-outline">
              <div class="card-body">
                
                  @if($userinfo[0]->departmentname == "PPU HEAD" || $userinfo[0]->departmentname == "FINANCIAL DIVISION")
                  <h1>{{ $no_ofapproved[0]->total_approved}}</h1>
                  @endif

                <p>With available funds.</p>

                <a href="{{ url('/approvedjobrequests')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>

        <!-- BOX 3-->
         <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="card card-primary card-outline">
              <div class="card-body">
                
                  @if($userinfo[0]->departmentname == "PPU HEAD" || $userinfo[0]->departmentname == "FINANCIAL DIVISION")
                  <h1>{{ $no_ofunapproved[0]->total_unapproved}}</h1>
                  @endif

                <p>Pending for Fund Validation.</p>

                <a href="{{ url('/unapprovedjobrequests')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>

        <!-- BOX 4-->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="card card-primary card-outline">
              <div class="card-body">
                
                  @if($userinfo[0]->departmentname == "PPU HEAD" || $userinfo[0]->departmentname == "FINANCIAL DIVISION")
                  <h1>0</h1>
                  @endif

                <p>Accomplished Job Requests</p>

                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
        </div>
    </div>
    
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
          <div class="card">
            <div class="card-body">
            <img src="adminlte3/dist/img/image.jpg" style="float: left; margin: 15px; border-right: 2px solid #ddd" height="350" width="350"> 
            <h5 style="margin-top: 10px">ScheManajr: A Job Request Management and Scheduling System</h5>
            <i style="color: #767676">A Captsone Project (2022-2023)</i>
            <p style="color: #767676">Proponents: Asok, Cañete, Bagaslao</p>
            </div>
          </div>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>

  
  <!-- Main Footer -->
  @include('templates/footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
@include('scripts/footer')

</body>
</html>

