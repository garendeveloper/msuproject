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
              <li class="breadcrumb-item"><a href="#">Reports</a> </li>
              <li class="breadcrumb-item active">Job Requests</li>
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
                        <h3>Generate reports for scope of works by job requests</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form actions="{{ route('/search_constructiontypes') }}" method = "POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="form-group">
                                        <label>Construction Type</label>
                                        <select id = "construction_types" name = "construction_type" class="form-control select2" style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <button class = "btn btn-primary btn-flat" type = "submit"><i class = "fa fa-search"></i> Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3>MSUN - Job Requests</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tbl_jobrequests" class="table table-bordered table-striped data-table" style = "table-layout: absolute; ">
                  <thead style = "background-color: #1C518A; color: white;">
                  <tr>
                    <th>Job Request</th>
                    <th>Date Requested</th>
                    <th style = "text-align: center">Approval</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if(!empty(session('constructions')))
                        @foreach(session(constructions) as $con)
                            <tr>
                                <td>$con->construction_name</td>
                            </tr>
                        @endforeach
                    @endif
                    @if(empty(session('constructions')))
                        <tr>
                            <td>No data</td>
                        </tr>
                    @endif
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

</body>
<script>
  $(function () {
    show_allJobRequests();

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
    $('.select2').select2();
    function show_allJobRequests()
    {
        $.ajax({
            type: 'get',
            url: '/get_allconstructiontypes',
            dataType: 'json',
            success: function(data)
            {
                var option = "";
                option += '<option> -- Select Here --</option>'
                for(var i = 0; i<data.length; i++)
                {
                option += '<option value = '+data[i].id+'>'+data[i].construction_type+'</option>';
                }
                $("#construction_types").html(option);
            }
        })
    }
  });
</script>
</html>
