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

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h6 class="m-0">WELCOME TO!</h6>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12" style = "text-align: center; font-family: Arial Black" >
          <img class="animation__shake" src="adminlte3/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="120" width="120">
            <h6 style = "">MINDANAO STATE UNIVERSITY AT NAAWAN </h6>
            <h6>CAPSTONE PROJECT</h6> 
            <h6>FOR SCHOOL YEAR (2022 - 2023)</h6> 
            <br><br><br><br>
            <h6>JOB REQUEST MONITORING & SCHEDULING SYSTEM </h6>
            <h6><b><i>(MSUNJRSCHED SYSTEM)</i> </b> </h6> <br><br><br><br>

            <address>
              <i>PROPONENTS</i>  <b></b>
            </address>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <!-- Main Footer -->
  @include('templates/footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
@include('scripts/footer')
</body>
</html>
