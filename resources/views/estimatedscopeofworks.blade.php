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
          <div class="col-sm-6">
            <h4>Job Request Full Summary</h4>
            <a href="{{ url('/constructionsbyID/'.$jobrequestdetails->id) }}" class = "btn btn-primary"><i class = "fa fa-arrow-left"></i></a>
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
                  <img src="{{ url('adminlte3/dist/img/AdminLTELogo.png') }}" style = "width: 100px; height: 100px;" class="brand-image img-circle elevation-2" alt="MSUN Logo">
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
              <div class="row invoice-info" style = "border-top: 1px solid black">
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
                        <?php 
                          $ppuhead = DB::select('select users.name
                                              from users, departments
                                              where departments.id = users.department_id
                                              and departments.departmentname = "PPU HEAD"')
                        ?>
                        <B>{{ !empty($ppuhead[0]->name) ? strtoupper($ppuhead[0]->name) : " - " }}</B><BR>
                        Chief, Physical Plant
                    </center>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <div class="row invoice-info" style = "border-top: 1px solid black">
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

              <div class="row invoice-info" style = "border-top: 1px solid black"> 
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

              <div class="row invoice-info" style = "border-top: 1px solid black">
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
                        <tbody>
                          <?php 
                            $totaleer_amount = 0;
                            $totalelc_amount = 0;
                            $totalemc_amount = 0;
                            $overalltotal = 0;
                           $i  = 0;
                            $char = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
                          ?>
                          @foreach($scopeofworks as $sow)
                            <?php
                              $sow_id = $sow->id;
                              $jobrequest_id = $sow->constructiontype_id;

                              $total_emc = DB::select('SELECT sum(estimated_material_costs.amount) as emc_total
                                                      FROM estimated_material_costs, constructions
                                                      WHERE constructions.id = estimated_material_costs.construction_id
                                                      AND constructions.id = "'.$sow_id.'"');

                              $total_eer = DB::select('SELECT sum(estimated_equipment_rental_costs.amount) as eer_total
                                                      FROM estimated_equipment_rental_costs, constructions
                                                      WHERE constructions.id = estimated_equipment_rental_costs.construction_id
                                                      AND constructions.id = "'.$sow_id.'"'); 
                              
                              $total_elc = DB::select('SELECT sum(estimated_labor_costs.amount) as elc_total
                                                      FROM estimated_labor_costs, constructions
                                                      WHERE constructions.id = estimated_labor_costs.construction_id
                                                      AND constructions.id = "'.$sow_id.'"');
                              
                              $total = $total_emc[0]->emc_total + $total_eer[0]->eer_total + $total_elc[0]->elc_total;
                              
                              $totaleer_amount += $total_eer[0]->eer_total;
                              $totalelc_amount += $total_elc[0]->elc_total;
                              $totalemc_amount += $total_emc[0]->emc_total;
                              $overalltotal = $totaleer_amount + $totalelc_amount + $totalemc_amount;
                            ?>
                            <tr>
                              <td align = "center">{{ $char[$i] }} </td>
                              <td>{{ ucwords(strtolower($sow->construction_name)) }}</td>
                              <td></td>
                              <td align = "right">{{ number_format($total_elc[0]->elc_total, 2) > 0 ? number_format($total_elc[0]->elc_total, 2) : " " }}</td>
                              <td align = "right">{{ number_format($total_eer[0]->eer_total, 2) > 0 ? number_format($total_eer[0]->eer_total, 2) : " " }}</td>
                              <td align = "right">{{ number_format($total_emc[0]->emc_total, 2) > 0 ? number_format($total_emc[0]->emc_total, 2) : " " }}</td>
                              <td align = "right">{{ number_format($total, 2) > 0 ? number_format($total, 2) : " "}}</td>
                            </tr>
                          <?php $i++?>
                          @endforeach
                        </tbody>
                        <tfoot>
                          <tr >
                            <td></td>
                            <td style = "text-align: center"><b>TOTAL AMOUNT</b></td>
                            <td></td>
                            <td align = "right"><b>{{ number_format($totalelc_amount,2) }}</b></td>
                            <td align = "right"><b>{{ number_format($totaleer_amount,2) }}</b></td>
                            <td align = "right"><b>{{ number_format($totalemc_amount,2) }}</b></td>
                            <td align = "right"><b>{{ number_format($overalltotal,2) }}</b></td>
                          </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="col-sm-12 invoice-col">
                   <address>Remarks:</address>
                </div>
                <!-- /.col -->
                <div class="col-sm-1 invoice-col" style = "border-top: 1px solid black">
                   <address>III. </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-11 invoice-col" style = "border-top: 1px solid black">
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
                        <?php 
                          $foreman = DB::select(' select users.name
                                                  from users, construction_types, jobrequestschedules, userjobrequestschedules
                                                  where construction_types.id = jobrequestschedules.jobrequest_id
                                                  and jobrequestschedules.id = userjobrequestschedules.jobrequestsched_id
                                                  and users.id = userjobrequestschedules.user_id
                                                  and construction_types.id = "'.$jobrequestdetails->id.'"');
                        
                          $personnels = DB::select('select * from personnels');
                        ?>
                        <B>{{ !empty($foreman) ? strtoupper($foreman[0]->name) : " - " }}</B><BR>
                        Const. & Maintainance Foreman <br>
                        Date: {{ date('M-d-Y'); }} <br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <address>
                        <br>
                        <B>{{ !empty($personnels[0]->engineer) ? strtoupper($personnels[0]->engineer) : " - "}}</B><BR>
                        Engineer I <br>
                        Date: {{ date('M-d-Y'); }} <br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-3 invoice-col" >
                    <address>
                        <br>
                        <?php 
                          $ppuhead = DB::select('select users.name
                                              from users, departments
                                              where departments.id = users.department_id
                                              and departments.departmentname = "PPU HEAD"')
                        ?>
                        <B>{{ !empty($ppuhead[0]->name) ? strtoupper($ppuhead[0]->name) : " - " }}</B><BR>
                        Chief, Physical Plant <br>
                        Date: {{ date('M-d-Y'); }} <br>
                    </address>
                </div>
                <div class="col-sm-1 invoice-col" style = "border-top: 1px solid black">
                    <address>
                        IV. 
                    </address>
                </div>
                <div class="col-sm-11 invoice-col" style = "border-top: 1px solid black">
                    <address>
                        Cost Chargeable Against Item No. <br>
                    </address>
                </div>
                <div class="col-sm-12 invoice-col">
                   <address>
                    Remarks:
                </address>
                </div>
                
                <div class="col-sm-1 invoice-col" style = "border-top: 1px solid black">
                    <address>
                        V. 
                    </address>
                </div>
                <div class="col-sm-11 invoice-col" style = "border-top: 1px solid black">
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
                        <B>{{ !empty($personnels[0]->vicechancellor) ? strtoupper($personnels[0]->vicechancellor) : " - " }}</B><BR>
                        Vice Chancellor for Administration & Finance<br>
                        Date: {{ date('M-d-Y'); }} <br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-5 invoice-col" >
                    <address>
                        <br>
                        <B>{{ !empty($personnels[0]->chancellor) ? strtoupper($personnels[0]->chancellor) : " - "}}</B><BR>
                        Chancellor<br>
                        Date: {{ date('M-d-Y'); }} <br>
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

</html>
