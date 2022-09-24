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
<style>
    .login-page{
        background-color: #0e1822;
    }
</style>
<body class="hold-transition login-page">
   <!-- Preloader -->
   <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="adminlte3/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="500" width="500">
  </div>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
    <div class="image">
          <img src="adminlte3/dist/img/AdminLTELogo.png" style = "width: 200px; height: 200px;" class="img-circle elevation-2" alt="User Image">
        </div>
    </div>
    @if(Session::get('success'))
        <div class="alert alert-success">
           <p> {{ Session::get('success') }} </p> 
        </div>
    @endif

    @if(Session::get('fail'))
        <div class="alert alert-danger">
           <p> {{ Session::get('fail') }} </p> 
        </div>
    @endif

    @if(Session::get('Fail'))
        <div class="alert alert-danger">
           <p> {{ Session::get('fail') }} </p> 
        </div>
    @endif
    <div class="card-body">
      <h5 style = "text-align: center">MSUN JRSched System</h5>
      <p class="login-box-msg">Sign in to start your session</p>
      <form action="{{ url('/loginuser') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input autocomplete = "off" type="text" class="form-control" value = "" name = "username" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        @if($errors->has('username'))
            <span class = "text-danger">{{$errors->first('username')}}</span>
          @endif
        @if($errors->has('usertype'))
            <span class = "text-danger">{{$errors->first('usertype')}}</span>
          @endif
        <div class="input-group mb-3">
          <input autocomplete = "off" type="password" class="form-control" name = "password"  placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @if($errors->has('password'))
            <span class = "text-danger">{{$errors->first('password')}}</span>
          @endif
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p> -->
      <p class="mb-0">
        <a href="https://msunaawan.edu.ph" class="text-center">Go to MSU Naawan Website</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- REQUIRED SCRIPTS -->
@include('scripts/footer')
</body>
</html>
