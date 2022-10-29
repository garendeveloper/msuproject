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
    <img class="animation__shake" src="{{ url('adminlte3/dist/img/AdminLTELogo.png') }}" alt="MSUNLogo" height="500" width="500">
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
            <h4>Accomplishment Report</h4>
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
            <div class="row no-print">
                <div class="col-12">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-5">
                                <select name="year" id="year" class = "form-control">
                                    <?php $i=0;?>
                                    @foreach($years as $year)
                                        <option value="{{ $years[$i]->year }}">{{ $years[$i]->year }}</option>
                                        <?php $i++;?>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                                <select name="year" id="year" class = "form-control">
                                    <option value="1">January to May </option>
                                    <option value="1">June to December</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                               <button class = "btn btn-sm btn-primary"><i class = "fa fa-search"></i>&nbsp; Query</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br>
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
                <div class="col-sm-1 invoice-col">
                
                </div>
                <div class="col-sm-3 invoice-col">
                  <address>
                    <img src="{{ url('adminlte3/dist/img/AdminLTELogo.png') }}" style = "width: 100px; height: 100px;" class="brand-image img-circle elevation-2" alt="User Image">
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <center>
                    Republic of the Philippines <br>
                    <strong style = "font-size: 16px">Mindanao Sate University</strong><br>
                    <strong style = "font-size: 13px">NAAWAN CAMPUS</strong><br>
                    9023 Naawan, Misamis Oriental<br><br>

                  </center>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">

                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <div class="row invoice-info">
                <div class="col-sm-1 invoice-col">
                   
                </div>
                <!-- /.col -->
                <div class="col-sm-3 invoice-col">
                   <address>

                   </address> 
                </div>
               <div class="col-sm-4 invoice-col">
                    <center>
                       PHYSICAL PLANT UNIT <br> 
                       <strong>STATUS INFRA PROJECTS</strong><br>
                    </center> 
               </div>
                <!-- /.col -->
              
                <!-- /.col -->
              </div>
              <!-- /.row -->
             
              <br>
              
              <div class="row invoice-info">
                <div class="col-sm-1 invoice-col">
                  
                </div>
                <div class="col-sm-10 invoice-col">
             
                  <table>
                    <thead>
                      <tr style = "text-align: center">
                        <th>DESCRIPTION</th>
                        <th>APPROPRIATION PROGRAM (GAA)</th>
                        <th>AMOUNT</th>
                        <th>AMOUNT UTILIZED</th>
                        <th>STATUS</th>
                        <th>ACCOMPLISHMENT %</th>
                        <th>REMARKS</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                  </table>
                </div>
              </div> <br>
       
              <!-- this row will not appear when printing -->
              <div class="row no-print">
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

</html>
