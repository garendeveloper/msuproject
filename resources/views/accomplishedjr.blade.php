
<!-- @if($userinfo[0]->departmentname == "PPU HEAD" || $userinfo[0]->departmentname == "PPU PERSONNEL")
  <SCRipt>
    alert("You do not have the authority to visit this page!")
    window.location.href = "/constructiontypes";
  </SCRipt>
  @endif -->

  @if(session()->has('message'))
  <script>
    alert("Accomplishment Report Successfully Saved")
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
    <img class="animation__shake" src="{{url('adminlte3/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="120" width="120">
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
            <a href="{{ url('/dashboard')}}" class = "btn btn-primary btn-sm"><i class = "fa fa-arrow-left"></i></a>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Awaiting For Funds Clearance</li>
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
                    <h6>Accomplished Job Requests ({{$total}})</h6> 
                  </div>
                
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    <div class="col-md-4" style = "text-align: right">
                      <input class="form-control" id = "search" type="search" placeholder="Search Item Here.." aria-label="Search" style = "font-size:12px; ">
                    </div>
                    <div class="col-md-8">
                      <a href="{{url('/accomplishedreport')}}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-right"></i>&nbsp; Generate Report</a>
                    </div>
                </div>
                <br>
                <table id = "tbl_jobrequests" class="table table-bordered table-striped data-table" style = "table-layout: responsive ">
                  <thead style = "background-color: #1C518A; color: white;">
                  <tr>
                    <th>Job Request</th>
                    <th>Date & Time Accomplished</th>
                    <th style = "text-align: center">Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $i =0; 
                    
                        for($i =0; $i<count($jobrequests); $i++)
                        { ?>
                            <tr>
                                <td>{{ucwords($jobrequests[$i]['construction_type'])}}</td>
                                <td>{{$jobrequests[$i]['dateCleared']}}</td>
                                <td align = "center">
                                    <a href="{{url('/createaccomplishmentreport/'.$jobrequests[$i]['id'])}}" class = "btn btn-primary btn-sm"><i class = "fa fa-plus"></i>&nbsp; Add Accomplishment Details</a>
                                </td>
                            </tr>
                        <?php }?>
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
    $("#search").on('keyup', function(){
      var value = $(this).val().toLowerCase();
      $("#tbl_jobrequests tbody tr").filter(function(){
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>

</body>
</html>
