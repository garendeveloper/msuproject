<!DOCTYPE html>
<html lang="en">
<head>
  @include('scripts/header')
    <!-- BS Stepper -->
    <link rel="stylesheet" href="adminlte3/plugins/bs-stepper/css/bs-stepper.min.css">
     <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="adminlte3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<style>
    .login-page{
        background-image: url(adminlte3/dist/img/AdminLoginBG.png);
        background-repeat: no-repeat;
        background-size: cover;
    }
    /* .login-box .card, .register-box .card {
        margin-bottom: 0;
        background-color: #ff5151;
    } */
    /* .card-primary.card-outline {
        border-top: 3px solid #500015;
    } */
</style>
<body class="hold-transition login-page">
   <!-- Preloader -->
   <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="adminlte3/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="100" width="100">
  </div>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
    <div class="image">
    <img src="adminlte3/dist/img/manajr.png" style="display:block; margin: 10px; margin-left: auto; margin-right: auto; height: 40px">
        </div>
    </div>
    @if(Session::get('success'))
        <script>
            alert("Thank you Job Requestor! You are now successfully registered.")
        </script>
    @endif

    @if(Session::get('fail'))
        <div class="alert alert-danger" style = "color: white">
           <p> {{ Session::get('fail') }} </p> 
        </div>
    @endif

    @if(Session::get('Fail'))
        <div class="alert alert-danger" style = "color: white">
           <p> {{ Session::get('fail') }} </p> 
        </div>
    @endif
    <div class="card-body">
      <!--<h5 style = "text-align: center">ScheManajr System</h5>-->
    <h5 style = "text-align:center; font-family: Tahoma; font-weight: bold"> Job Requestor Registration</h5>
      <!-- <p class="login-box-msg">Sign in to start your session</p> --> <p></p>
      <form action="{{ url('/register_jobrequestor') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input autocomplete = "off" type="text" class="form-control" id = "name" value = "{{ old('name') }}" name = "name" placeholder="Fullname" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        @if($errors->has('name'))
            <span style = "color: red">{{$errors->first('name')}}</span>
        @endif
        <div class="input-group mb-3">
          <input autocomplete = "off" type="email" class="form-control" id = "email" value = "{{ old('email') }}" name = "email" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        @if($errors->has('email'))
            <span style = "color: red">{{$errors->first('email')}}</span>
        @endif
        <div class="input-group mb-3">
          <input  type="text" class="form-control" id = "phone_num"  name = "phone_num" value = "{{ old('phone_num') }}" data-inputmask='"mask": "9999-999-9999"' data-mask required autocomplete ="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        @if($errors->has('phone_num'))
            <span style = "color: red">{{$errors->first('phone_num')}}</span>
        @endif

        <div class="input-group mb-3">
          <input autocomplete = "off" type="text" list = "designated_offices" class="form-control" value = "{{ old('designation') }}" id = "designation" value = "" name = "designation" placeholder="Designation" required autocomplete ="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-building"></span>
            </div>
          </div>
          <datalist id = "designated_offices">

          </datalist>
        </div>
        @if($errors->has('designation'))
            <span style = "color: red">{{$errors->first('designation')}}</span>
        @endif

        <div class="input-group mb-3">
          <input autocomplete = "off" type="text" class="form-control" value = "{{ old('username') }}" name = "username" placeholder="Username" required autocomplete ="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        @if($errors->has('username'))
            <span style = "color: red">{{$errors->first('username')}}</span>
        @endif
        <div class="input-group mb-3">
          <input  type="password" class="form-control" value = "{{ old('password') }}" name = "password"  placeholder="Password" required autocomplete ="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @if($errors->has('password'))
            <span style = "color: red">{{$errors->first('password')}}</span>
        @endif
        <div class="input-group mb-3">
          <input  type="password" class="form-control" name = "confirm_password"  placeholder="Confirm password" required autocomplete ="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @if($errors->has('confirm_password'))
            <span style = "color: black">{{$errors->first('confirm_password')}}</span>
          @endif
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p> -->
      <p class="mb-0" style="margin-top: 15px">
      <a href="{{ url('/')}}" class = "" class="text-center">
          I have already an account</a> <br>
        <a href="https://msunaawan.edu.ph" class = "" class="text-center">
          Go to MSU Naawan Website</a> <br>
         
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- REQUIRED SCRIPTS -->
@include('scripts/footer')
<!-- Tempusdominus Bootstrap 4 -->
<script src="adminlte3/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="adminlte3/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="adminlte3/plugins/bs-stepper/js/bs-stepper.min.js"></script>
<script src="adminlte3/plugins/moment/moment.min.js"></script>
<script src="adminlte3/plugins/inputmask/jquery.inputmask.min.js"></script>
<script>
     //Datemask dd/mm/yyyy
     $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()
    show_allDesignatedOffices();
    function show_allDesignatedOffices()
    {
      $.ajax({
        type: 'GET',
        url: '/get_allDesignatedOffices',
        dataType: 'json',
        success: function(data){
          var option = "<option value = ''> -- Please select designation here -- </option>";
          for(var i = 0; i<data.length; i++)
          {
            option += "<option >"+data[i].designation+"</option>";
          }
          $("#designated_offices").html(option);
        },
      })
    }

</script>
</body>
</html>
