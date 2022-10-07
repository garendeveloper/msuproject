
@if($userinfo[0]->departmentname == "JOB REQUESTOR")
  <SCRipt>
    alert("You do not have the authority to visit this page!")
    window.location.href = "/constructiontypes";
  </SCRipt>
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
    <img class="animation__shake" src="{{ url('adminlte3/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="120" width="120">
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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Unapproved Job Requests</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header" style = "background-color: #1C518A; color: white;">
                <div class="row">
                    <div class="col-md-12">
                        <h6>List of Unapproved Job Requests</h6> 
                    </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id = "tbl_approvedjr" class="table table-bordered table-striped data-table" style = "font-size: 12px ">
                  <thead style = "background-color: #1C518A; color: white;">
                    <tr>
                        <th>Job Request</th>
                        <th style = "text-align: right">Requested By:</th>
                        <th>Designation</th>
                        <th>Date & Time Requested</th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach($jobrequests as $jr)
                            <tr>
                                <td>{{ Str::title($jr->construction_type) }}</td>
                                <td style = "text-align: right">{{ Str::title($jr->name) }}</td>
                                <td >{{ Str::title($jr->designation) }}</td>
                                <td>{{ $jr->created_at }}</td>
                            </tr>
                        @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Main Footer -->
  @include('templates/footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
@include('scripts/footer')
<script>
  $(function () {
    $("#tbl_approvedjr").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#tbl_approvedjr_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
