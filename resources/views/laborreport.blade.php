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
    <img class="animation__shake" src="{{ url('adminlte3/dist/img/AdminLTELogo.png') }}" alt="MSUNLogo" height="120" width="120">
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
          <div class="col-sm-10">
            <h4>Job Request Estimated Labor Cost Summary</h4>
            <a href="{{ url('/constructionsbyID/'.$jobrequestdetails->id) }}" class = "btn btn-primary"><i class = "fa fa-arrow-left"></i></a>
          </div>
          <div class="col-sm-2">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Report</li>
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
                       Project <br> <br>
                       Date <br> <br> <br> 

                       <strong>PROJECT COST SUMMARY</strong> <br> 
                    </address>  
                </div>
                <!-- /.col -->
                <div class="col-sm-8 invoice-col">
                    : <b>{{ $jobrequestdetails->construction_type}} </b> <br> <br>
                    : {{ date('dS F Y', strtotime($jobrequestdetails->created_at)) }} <br> 
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <div class="row invoice-info" >
                <div class="col-sm-1 invoice-col">
              
                </div>
                <div class="col-sm-10 invoice-col">
                  <table class = "" >
                      <thead>
                        <tr >
                          <th style = "text-align: center">Description</th>
                          <th style = "text-align: center">Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>I: Estimated Material Cost</td>
                          <td align = "right">{{ number_format($total_emc[0]->emc_total,2) }}</td>
                        </tr>
                        <tr>
                          <td>II: Estimated Labor Cost</td>
                          <td align = "right">{{ number_format($total_eer[0]->eer_total,2) }}</td>
                        </tr>
                        <tr>
                          <td>III: Estimated Rental</td>
                          <td align = "right">{{ number_format($total_elc[0]->elc_total,2) }}</td>
                        </tr>
                        <tr>
                          <td align = "center"><b>Total Project Cost</b></td>
                          <td align = "right"><b>{{ number_format($total_projectcost,2) }}</b></td>
                        </tr>
                      </tbody>
                  </table>
                </div>
              </div> <br>
              <div class="row invoice-info">
                <div class="col-sm-1 invoice-col">

                </div>
                <div class="col-sm-11 invoice-col">
                  <b>Estimated Labor Cost</b> <br>
                </div>
              </div> 
              <br>
              <?php 
              $i = 0;
              $char = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
              ?>
              @foreach($scopeofworksEstimated as $sow)
              <?php
                $sow_id = $sow->id;
                $jobrequest_id = $sow->constructiontype_id;

                $items = DB::select('select estimated_labor_costs.*
                                    from constructions, estimated_labor_costs
                                    where constructions.id = estimated_labor_costs.construction_id
                                    and constructions.id = "'.$sow_id.'"');
                
              ?>
              <div class="row invoice-info">
                <div class="col-sm-1 invoice-col">
                  
                </div>
                <div class="col-sm-10 invoice-col">
                   {{$char[$i].". ".strtoupper($sow->construction_name) }} <br>
                  <table>
                    <thead>
                      <tr style = "text-align: center">
                        <th>Manpower</th>
                        <th>No.</th>
                        <th>No. of Days</th>
                        <th>Total Days</th>
                        <th>Rate/Day</th>
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $total = 0;?>
                      @foreach($items as $item)
                        <tr>
                          <td>{{ $item->manpower }}</td>
                          <td align = "center">{{ $item->no_ofpersons }}</td>
                          <td align = "center">{{ $item->no_ofheaddays }}</td>
                          <td align = "center">{{ $item->no_mandays }}</td>
                          <td align = "center">{{ number_format($item->daily_rate, 2) }}</td>
                          <td align = "right">{{ number_format($item->amount, 2) }}</td>
                        </tr>
                        <?php $total += $item->amount ?>
                        @endforeach
                          <tr>
                            <td><b>Labor Cost:</b></td>
                            <td colspan = "4"></td>
                            <td  align = "right"><b> {{ number_format($total,2) }} </b> </td>
                          </tr>
                    </tbody>
                  </table>
                </div>
              </div> <br>
              <?php $i++;?>
              @endforeach
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
