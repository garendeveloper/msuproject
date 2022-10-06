<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name = "csrf-token" content = "{{ csrf_token() }}">
<title>MSU Job Request Scheduling System</title>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="{{ url('adminlte3/https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback') }}">
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{ url('adminlte3/plugins/fontawesome-free/css/all.min.css') }}">
<!-- DataTables -->
<link rel="stylesheet" href="{{ url('adminlte3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ url('adminlte3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ url('adminlte3/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="{{ url('adminlte3/plugins/fullcalendar/main.css') }}">
<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{ url('adminlte3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ url('adminlte3/plugins/select2/css/select2.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('adminlte3/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ url('adminlte3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ url('adminlte3/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
<!-- IonIcons -->
<link rel="stylesheet" href="{{ url('adminlte3/https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
 <!-- jsGrid -->
 <link rel="stylesheet" href="{{ url('adminlte3/plugins/jsgrid/jsgrid.min.css') }}">
  <link rel="stylesheet" href="{{ url('adminlte3/plugins/jsgrid/jsgrid-theme.min.css') }}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ url('adminlte3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ url('adminlte3/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ url('adminlte3/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('adminlte3/dist/css/adminlte.min.css ') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ url('adminlte3/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ url('adminlte3/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ url('adminlte3/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ url('adminlte3/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
 <!-- Toastr -->
 <link rel="stylesheet" href="{{ url('adminlte3/plugins/toastr/toastr.min.css') }}">
   <!-- icheck bootstrap -->
   <link rel="stylesheet" href="{{ url('adminlte3/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<style>

    [class*=sidebar-dark-] {
        background-color: #0e1822;
    }
    .navbar-white {
        background-color: #1C518A;
        color: #1f2d3d;
    }
    body{
      min-height: 100%;
    }
    .nav-sidebar .nav-item>.nav-link {
    /* margin-bottom: -0.5rem; */
}
.button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 8px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 12px;
  margin: 4px 2px;
  cursor: pointer;
}
</style>