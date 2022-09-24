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
    <img class="animation__shake" src="adminlte3/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="500" width="500">
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
              <li class="breadcrumb-item"><a href="{{ url('/ConstructionTypes') }}">Construction Types</a> </li>
              <li class="breadcrumb-item active">Funds availability</li>
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
              <div class="card-header">
                <h3>Approval of funds availability</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tbl_constructiontypes" class="table table-bordered table-striped data-table" style = "table-layout: absolute; ">
                  <thead style = "background-color: #1C518A; color: white;">
                  <tr>
                    <th>Job Request</th>
                    <th>Date Requested</th>
                    <th style = "text-align: center">Approval</th>
                  </tr>
                  </thead>
                  <tbody>
                
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
  <div class="modal fade openmodal" id="modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style = "background-color: #1C518A; color: white;">
              <h4 class="modal-title" id = "c_modaltitle" >Add Construction (SOW ) </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <ul id = "ajaxresponse">

            </ul>
            <form id = "form" action="" method = "post">
              <div class="modal-body">
                @csrf
                <input type="hidden" value = "" id = "id" name = "id">
               
                <div class="form-group">
                  <label for="constructiontype_id">Construction Type</label>
                  <select class ="form-control" name="constructiontype_id" id="constructiontype_id">
                    <option value="">--Select Item -- </option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="construction">Scope of Work</label>
                  <input type="text" name = "construction_name" id= "construction_name" class = "form-control">
                </div>

              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id = "save">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

  <!-- Main Footer -->
  @include('templates/footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
@include('scripts/footer')
<script>
  $(function () {
    $("#tbl_jobrequests").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tbl_jobrequests_wrapper .col-md-6:eq(0)');
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
