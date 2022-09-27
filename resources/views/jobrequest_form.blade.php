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
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              This page has been enhanced for printing. Click the print button at the bottom of the job request form to test.
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

                    <p><b>JOB REQUEST FORM</b> </p> <br><br>

                  </center>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">

                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <div class="row invoice-info">
                <div class="col-sm-8 invoice-col">

                </div>
                <!-- /.col -->
                <div class="col-sm-10 invoice-col">
                 
                </div>
                <!-- /.col -->
                
                <div class="col-sm-2 invoice-col" style = " text-align: center">
                  <p style = "border-bottom: 2px solid black"> <?= date('M/d/Y')?> </p>
                    Date 
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row invoice-info">
                <div class="col-sm-10 invoice-col">
                    <address>
                        Note: Every request for construction, repair, or improvement of building to be undertaken 
                        must be accomplished by this JOB REQUEST to be accomplished in triplicate <br> <br>
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

              <div class="row invoice-info" style = "border-top: 3px solid black">
                <div class="col-sm-12 invoice-col">
                    <br>
                    <textarea name="constructiontype" id="constructiontype" cols="30" rows="10" style="border:solid 1px orange;" class = "form-control"></textarea>
                    <br>
                </div>
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-6">
                  <a href="{{url('/jobrequests_report')}}" rel="noopener" target="_blank" class="btn btn-block btn-flat  btn-outline-primary"><i class="fas fa-print"></i> Print</a>
                </div>
                <div class="col-6">
                  <a rel="noopener" id = "btn_add" class="btn btn-block btn-flat  btn-outline-success"><i class="fas fa-save"></i> Submit Request</a>
                </div>
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
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $("#tbl_jobrequests").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tbl_jobrequests_wrapper .col-md-6:eq(0)');
    $("#btn_add").on('click', function(e) {
      e.preventDefault();

      var constructiontype = $("#constructiontype").val();

      $.ajax({
        type: "POST",
        url: "/addconstructiontype",
        data: {
          construction_type: constructiontype,
        },
        dataType: "json",
        success:  function(response){
          if(response.status == 400){
            alert("Please check your field!");
          }
          if(response.status == 200){
            alert(response.success);
            $(".modal_addconstructiontype").modal('hide');
            $("#constructiontype").val();
          }
        },
        error:  function(response, error){
          alert("Something went wrong\nPlease contact your administrator for immediate actions!");
        }
      });
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
