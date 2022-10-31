
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
            <!-- <a href="{{ url('/dashboard')}}" class = "btn btn-primary btn-sm"><i class = "fa fa-arrow-left"></i></a> -->
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Personnels</li>
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
                        <h3 class="card-title">Personnels / Honorables Details</h3>
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
                      @if(session()->has('success'))
                          <div class="alert alert-success">
                            {{ session()->get('success') }}
                          </div>
                      @endif
                    @if(!empty($personnels))
                    <form action="{{ url('/savepersonnel') }}" method = "post">
                        @csrf
                        
                        <input type="text" style = "display: none" name = "id" value = "{{ $personnels[0]->id }}">
                        <div class="card-body">
                          <div class="form-group">
                              <label >Administrative Officer</label>
                              <input type="text" class="form-control" name = "adminofficer" value = "{{ $personnels[0]->adminofficer }}" placeholder="Enter Administrative Officer" autocomplete="">
                          </div>
                          <div class="form-group">
                              <label >Engineer</label>
                              <input type="text" class="form-control" name = "engineer" value = "{{ $personnels[0]->engineer }}" placeholder="Engineer" autocomplete="">
                          </div>
                          <div class="form-group">
                              <label >Vice Chancellor</label>
                              <input type="text" class="form-control" name = "vicechancellor" value = "{{ $personnels[0]->vicechancellor }}" placeholder="Enter Vice Chancellor" autocomplete="">
                          </div>
                          <div class="form-group">
                              <label >Chancellor</label>
                              <input type="text" class="form-control" name = "chancellor" value = "{{ $personnels[0]->chancellor }}" placeholder="Enter Chancellor" autocomplete="">
                          </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block"><i class = "fa fa-save"></i>&nbsp; Submit</button>
                        </div>
                    </form>                    
                    @endif

                    @if(empty($personnels))
                    <form action="{{ url('/savepersonnel') }}" method = "post">
                        @csrf
                        <input type="text" style = "display: none" name = "jobrequest_id" >
                        <div class="card-body">
                          <div class="form-group">
                              <label >Administrative Officer</label>
                              <input type="text" class="form-control" name = "adminofficer" value = "{{ old('adminofficer') }}" placeholder="Enter Administrative Officer" autocomplete="">
                          </div>
                          <div class="form-group">
                              <label >Engineer</label>
                              <input type="text" class="form-control" name = "engineer" value = "{{ old('engineer') }}" placeholder="Engineer" autocomplete="">
                          </div>
                          <div class="form-group">
                              <label >Vice Chancellor</label>
                              <input type="text" class="form-control" name = "vicechancellor" value = "{{ old('vicechancellor') }}" placeholder="Enter Vice Chancellor" autocomplete="">
                          </div>
                          <div class="form-group">
                              <label >Chancellor</label>
                              <input type="text" class="form-control" name = "chancellor" value = "{{ old('chancellor') }}" placeholder="Enter Chancellor" autocomplete="">
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
