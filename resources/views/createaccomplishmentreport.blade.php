
<!-- @if($userinfo[0]->departmentname == "PPU HEAD" || $userinfo[0]->departmentname == "PPU PERSONNEL")
  <SCRipt>
    alert("You do not have the authority to visit this page!")
    window.location.href = "/constructiontypes";
  </SCRipt>
  @endif -->
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
            <a href="{{ url('/accomplishedjobrequests')}}" class = "btn btn-primary btn-sm"><i class = "fa fa-arrow-left"></i></a>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Create Accomplishment Report</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-3">

            </div>
            <div class="col-6">
                <!-- general form elements -->
                <div class="card card-primary" >
                    <div class="card-header" style = "background-color: #1C518A; color: white;">
                        <h3 class="card-title">Create Accomplishment Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    @if($errors->any())
                        <div class="alert ">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li style = "color: red">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(count($accomplishedreport) > 0)
                    <form action="{{ url('/saveaccomplishmentreport') }}" method = "post">
                        @csrf
                        <input type="text" style = "display: none" name = "jobrequest_id" value = "{{ $jobrequestschedule[0]->id }}">
                        <input type="text" style = "display: none" name = "id" value = "{{ $accomplishedreport[0]->id }}">
                        <div class="card-body">
                        <div class="form-group">
                            <label >Approriation Program (GsssA)</label>
                            <input type="text" class="form-control" name = "gaa" value = "{{ $accomplishedreport[0]->gaa }}" placeholder="Enter Approriation Program" autocomplete="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Amount Utilized</label>
                            <input type="number" name = "amount_utilized" value = "{{ $accomplishedreport[0]->amount_utilized }}" class="form-control" id="exampleInputPassword1" placeholder="Amount Utilized" autocomplete = "">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Remarks</label>
                            <textarea name="remarks" class = "form-control" value = "{{ $accomplishedreport[0]->remarks }}" cols="30" rows="10" autocomplete>{{ $accomplishedreport[0]->remarks }}</textarea>
                        </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block"><i class = "fa fa-save"></i>&nbsp; Submit</button>
                        </div>
                    </form>
                    @endif

                    @if(empty($accomplishedreport))
                    <form action="{{ url('/saveaccomplishmentreport') }}" method = "post">
                        @csrf
                        <input type="text" style = "display: none" name = "jobrequest_id" value = "{{ $jobrequestschedule[0]->id }}">
                        <div class="card-body">
                        <div class="form-group">
                            <label >Approriation Program (GAA)</label>
                            <input type="text" class="form-control" name = "gaa" value = "{{ old('gaa') }}" placeholder="Enter Approriation Program" autocomplete="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Amount Utilized</label>
                            <input type="number" name = "amount_utilized" value = "{{ old('amount_utilized') }}" class="form-control" id="exampleInputPassword1" placeholder="Amount Utilized" autocomplete = "">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Remarks</label>
                            <textarea name="remarks" class = "form-control" value = "{{ old('remarks') }}" cols="30" rows="10" autocomplete></textarea>
                        </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block"><i class = "fa fa-save"></i>&nbsp; Submit</button>
                        </div>
                    </form>                    
                    @endif
                    </div>
                <!-- /.card -->
          </div>
          <div class="col-3">

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
