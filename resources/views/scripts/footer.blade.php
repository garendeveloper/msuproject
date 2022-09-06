<!-- jQuery -->
<script src="adminlte3/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="adminlte3/dist/js/adminlte.js"></script>
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

<!-- OPTIONAL SCRIPTS -->
<script src="adminlte3/plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="adminlte3/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="adminlte3/dist/js/pages/dashboard3.js"></script>
<script>
    $(function(){
        $("#dashboard").on('click', function(e){
            $("#nav-item-tables").removeClass("active");
            $("#dashboard").addClass("active");
        });
        $("#nav-item-tables").on('click', function(e){
            $("#dashboard").removeClass("active");
            $("#nav-item-tables").addClass("active");
        });
    })
  </script>