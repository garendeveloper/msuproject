<!DOCTYPE html>
<html lang="en">
<head>
  @include('scripts/header')
  <style>
    table, th, td{
      border: 1px solid black;
      border-collapse: collapse;
      
    }
    table{
      width: 100%;
    }
    th, td {
      padding-top: 5px;
      padding-bottom: 5px;
      padding-right: 10px;
      padding-left: 10px;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
   <!-- Preloader -->
   <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="adminlte3/dist/img/AdminLTELogo.png" alt="MSUNLogo" height="500" width="500">
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
            <h1>Job Request Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info row no-print">
              <h5><i class="fas fa-info"></i> Note:</h5>
              This page has been enhanced for printing. Press Control + P to print the job request report.
            </div>


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  <address>
                  <img src="adminlte3/dist/img/AdminLTELogo.png" style = "width: 120px; height: 120px;" class="brand-image img-circle elevation-2" alt="User Image">
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <center>
                    Republic of the Philippines <br>
                    <strong>Mindanao Sate University at Naawan</strong><br>
                    9023 Naawan, Misamis Oriental<br><br>

                    <p>JOB REQUEST</p>

                  </center>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">

                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <div class="row invoice-info">
                <div class="col-sm-10 invoice-col">
                    <address>
                        Note: Every request for construction, repair, or improvement of building to be undertaken 
                        must be accomplished by this JOB REQUEST to be accomplished in triplicate <br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-2 invoice-col">
                </div>
                <!-- /.col -->
                <div class="col-sm-2 invoice-col">
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <div class="row invoice-info" style = "border-top: 2px solid black">
                <div class="col-sm-12 invoice-col">
                    <address>
                        Description of Construction/Repair/Improvement to be undertaken:
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-1 invoice-col">
                </div>
                <!-- /.col -->
                <div class="col-sm-11 invoice-col">
                <b>Repair & Improvement of Campus Infirmary Phase -2 </b> 
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row invoice-info">
                <div class="col-sm-1 invoice-col">
                    <address>
                        I. <br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-8 invoice-col">
                    Requested by: <br>
                </div>
                <!-- /.col -->
                <div class="col-sm-3 invoice-col" >
                    <center>
                        <b>ENGR. WENNIE P. ASEQUIA</b><br>
                        Chief, Physical Plant
                    </center>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <div class="row invoice-info" style = "border-top: 2px solid black">
                <div class="col-sm-1 invoice-col">
                    <address>
                        II. <br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col" >
                    Noted and referred by: <br>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col" >
                    <address>
                        Referred to:  <br>
                        <input type="checkbox"><br>
                        <input type="checkbox"> <br>
                        <input type="checkbox"><br>

                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-3 invoice-col" >
                    <center>
                        The University Engineer <br>
                        Project Engineer <br>
                        Project Consultant <br>
                    </center>
                </div>
                <!-- /.col -->
             
              </div>
              <!-- /.row -->

              <div class="row invoice-info" style = "border-top: 2px solid black"> 
                <div class="col-sm-4 invoice-col">
                    <address>
                        FOR. <br>
                        <input type="checkbox"> Comments <br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <address>
                        <br>
                        <input type="checkbox"> Recommendations<br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <address>
                        <br>
                        <input type="checkbox"> Preparation of Cost Estimates<br>
                    </address>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row invoice-info" style = "border-top: 2px solid black">
                <div class="col-sm-12 invoice-col">
                    <center>
                        COST ESTIMATES OF REQUEST <br>
                    </center>
                </div>
              </div>
              <!-- /.row -->
              <div class="row">
                <div class="col-12 table-responsive">
                    <table class="">
                        <thead>
                            <tr style = "text-align: center">
                                <th>ITEM</th>
                                <th>SCOPE OF WORK</th>
                                <th>%</th>
                                <th>LABOR</th>
                                <th>EQUIPMENT</th>
                                <th>MATERIAL</th>
                                <th>TOTAL</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="col-sm-12 invoice-col">
                   <address>Remarks:</address>
                </div>
                <!-- /.col -->
                <div class="col-sm-1 invoice-col" style = "border-top: 2px solid black">
                   <address>III. </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-11 invoice-col" style = "border-top: 2px solid black">
                   <address>ESTIMATES JOINTLY CHECKS AND SUBMITTED BY: </address>
                </div>
                <!-- /.col -->
               </div>

              <div class="row invoice-info"> 
                <div class="col-sm-1 invoice-col">
                    <address>
                        
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <address>
                        <br>
                        <B>MC KENNETH P. TANECA</B><BR>
                        Const. & Maintainance Foreman <br>
                        Date: October 21, 2021 <br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <address>
                        <br>
                        <B>ENGR. JOSE VINCENT T. PADIN</B><BR>
                        Engineer I <br>
                        Date: October 21, 2021 <br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-3 invoice-col" >
                    <address>
                        <br>
                        <B>ENGR. WENNIE P. ASEQUIA</B><BR>
                        Chief, Physical Plant <br>
                        Date: October 21, 2021 <br>
                    </address>
                </div>
                <div class="col-sm-1 invoice-col" style = "border-top: 2px solid black">
                    <address>
                        IV. 
                    </address>
                </div>
                <div class="col-sm-11 invoice-col" style = "border-top: 2px solid black">
                    <address>
                        Cost Chargeable Against Item No. <br>
                    </address>
                </div>
                <div class="col-sm-12 invoice-col">
                   <address>
                    Remarks:
                </address>
                </div>
                
                <div class="col-sm-1 invoice-col" style = "border-top: 2px solid black">
                    <address>
                        V. 
                    </address>
                </div>
                <div class="col-sm-11 invoice-col" style = "border-top: 2px solid black">
                    <address>
                       Recommending Approval: <br>
                    </address>
                </div>

                <div class="col-sm-2 invoice-col" >
                    <address>
                    </address>
                </div>
                <div class="col-sm-5 invoice-col">
                    <address>
                        <br>
                        <B>RHODA P. ABARY, CPA</B><BR>
                        Vice Chancellor for Administration & Finance<br>
                        Date: October 21, 2021 <br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-5 invoice-col" >
                    <address>
                        <br>
                        <B>ELNOR C. ROA, PH.D.</B><BR>
                        Chancellor<br>
                        Date: October 21, 2021 <br>
                    </address>
                </div>
              </div>
               
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <!-- <div class="col-12">
                  <a href="{{url('/jobrequests_report')}}" rel="noopener" target="_blank" class="btn btn-block btn-flat  btn-outline-primary"><i class="fas fa-print"></i> Print</a>
                </div> -->
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    <!-- Main Footer -->
    @include('templates/footer')
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


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
