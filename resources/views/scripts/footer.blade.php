<!-- jQuery -->
<script src="adminlte3/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="adminlte3/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="adminlte3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="adminlte3/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="adminlte3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="adminlte3/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="adminlte3/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="adminlte3/plugins/jszip/jszip.min.js"></script>
<script src="adminlte3/plugins/pdfmake/pdfmake.min.js"></script>
<script src="adminlte3/plugins/pdfmake/vfs_fonts.js"></script>

<script src="adminlte3/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="adminlte3/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="adminlte3/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="adminlte3/plugins/moment/moment.min.js"></script>
<!-- Sparkline -->
<script src="adminlte3/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="adminlte3/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="adminlte3/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="adminlte3/plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="adminlte3/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="adminlte3/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="adminlte3/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="adminlte3/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="adminlte3/plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE -->
<script src="adminlte3/dist/js/adminlte.js"></script>
<script>
    $(function(){
        $("#dashboard").on('click', function(e){
            $("#nav-item-tables").removeClass("active");
            // $(this).addClass(".menu-open");
        });
        $("#nav-item-tables").on('click', function(e){
            $("#dashboard").removeClass("active");
            $("#nav-item-tables").addClass("active");
        });
    })
  </script>