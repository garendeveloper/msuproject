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
        <div class="col-sm-1">
            <a href="{{ url('/accomplishedjobrequests')}}" class = "btn btn-primary btn-sm"><i class = "fa fa-arrow-left"></i></a>
          </div>
          <div class="col-sm-5">
            <h4>Accomplishment Report</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Accomplishment Report</li>
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
                    <form action="{{url('/queryaccomplishmentreport') }}" method="post" >
                      @csrf
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
                                <select name="quarter" id="quarter" class = "form-control">
                                    <option value="1">January to May </option>
                                    <option value="2">June to December</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                               <button class = "btn btn-sm btn-block btn-primary" class = "btn btn-submit"><i class = "fa fa-search"></i>&nbsp; Query</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            <!-- Main content -->
      
            <div class="invoice p-3 mb-3" >
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
                @if(session()->has('data'))
                <div class="col-sm-4 invoice-col">
                    <center>
                       PHYSICAL PLANT UNIT <br> 
                       <strong>STATUS INFRA PROJECTS</strong><br>
                         <?php 
                            $data = session()->get('data');
                            echo $data['date'];
                         ?>
                    </center> 
                </div>
                @endif
                <!-- /.col -->
              
                <!-- /.col -->
              </div>
              <!-- /.row -->
             
              <br>
              
              <div class="row invoice-info">
                <div class="col-sm-1 invoice-col">
                  
                </div>
                <div class="col-sm-10 invoice-col">
                  @if(!empty(session()->has('data')))
                    <?php $data = session()->get('data')['jobrequests'];?>
                    @if(count($data) > 0)
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
                          <?php $accoms = [];   $gaa = " "; 
                            $amount_utilized = " "; $remarks; $amount; $accomplishmentpercent;
                            $elc_amount; $emc_amount; $eec_amount;
                          ?>
                        
                          @foreach($data as $jr)

                              <?php 
                              $jr_id = $jr->jobreq_id;
                              $accoms = DB::select('select accomplishment_reports.*
                                                    from accomplishment_reports, construction_types, jobrequestschedules
                                                    where construction_types.id = jobrequestschedules.jobrequest_id 
                                                    and jobrequestschedules.id=  accomplishment_reports.jobrequest_id 
                                                    and construction_types.id = "'.$jr_id.'"');
                              
                              $emc_amount = DB::select('select sum(estimated_material_costs.amount)  as amount
                                                        from  estimated_material_costs, construction_types, constructions
                                                        where construction_types.id = constructions.constructiontype_id
                                                        and constructions.id = estimated_material_costs.construction_id
                                                        and construction_types.id = "'.$jr_id.'";');
                              $elc_amount = DB::select('select sum(estimated_labor_costs.amount)  as amount
                                                        from estimated_labor_costs, construction_types, constructions
                                                        where construction_types.id = constructions.constructiontype_id
                                                        and constructions.id = estimated_labor_costs.construction_id
                                                        and construction_types.id = "'.$jr_id.'"');
                              $eec_amount = DB::select('select sum(estimated_equipment_rental_costs.amount)  as amount
                                                        from estimated_equipment_rental_costs, construction_types, constructions
                                                        where construction_types.id = constructions.constructiontype_id
                                                        and constructions.id = estimated_equipment_rental_costs.construction_id
                                                        and construction_types.id = "'.$jr_id.'"');
                              
                              if(count($accoms) > 0)
                              {
                                $amount = ($emc_amount[0]->amount)+($elc_amount[0]->amount)+($eec_amount[0]->amount);
                                $gaa = $accoms[0]->gaa;
                                $amount_utilized = $accoms[0]->amount_utilized;
                                $remarks = $accoms[0]->remarks;
                                $accomplishmentpercent = ($amount_utilized / $amount)*100;
                             
                              }
                              else {
                                $gaa = " - ";
                                $remarks = " - ";
                                $accomplishmentpercent = 0;
                                $amount_utilized = 0;
                                $amount = 0;
                              }
                             
                              $jobreqsched_status = $jr->jobreqsched_status;
                              
                             
                            ?>
                            <tr>
                              <td>{{ ucwords($jr->construction_type) }}</td>
                              <td>{{ strtoupper($gaa) }}</td>
                              <td align="right">{{ number_format($amount, 2) }}</td>
                              <td align = "right">{{ number_format($amount_utilized, 2) }}</td>
                              <td> 
                                @if($jobreqsched_status == 1)
                                  Completed
                                @endif
                                @if($jobreqsched_status == 0)
                                  On-Going
                                @endif
                              <td align = "center">{{ number_format($accomplishmentpercent,2) }} %</td>
                              <td>{{ $remarks }}</td>
                            </tr>
                          @endforeach
                      </tbody>
                    </table>
                    @endif
                  @endif
                </div>
                <div class="col-sm-1 invoice-col">

                </div>
              </div> <br><br><br>
              
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
                            $ppuhead = DB::select('select users.name 
                                                    from users, departments
                                                    where departments.departmentname = "PPU HEAD"');
                            $personnels = DB::select('select * from personnels');
                          ?>
                          <B>{{ !empty($ppuhead[0]->name) ? strtoupper($ppuhead[0]->name) : " - " }}</B><BR>
                          Chief, Physical Plant <br>
                      </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">
                      <address>
                          <br>
                          <B>{{ !empty($personnels[0]->adminofficer) ? strtoupper($personnels[0]->adminofficer) : " - " }}</B><BR>
                          Administrative Officer <br>
                      </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 invoice-col" >
                      <address>
                          <br>
                          <B>{{ !empty($personnels[0]->chancellor) ? strtoupper($personnels[0]->chancellor) : " - "}}</B><BR>
                          Chancellor<br>
                      </address>
                  </div>
              </div>
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
    <!-- @include('templates/footer') -->
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
