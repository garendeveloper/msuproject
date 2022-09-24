@if($userinfo[0]->departmentname == "FINANCIAL DIVISION")
  <script>
    alert("You do not have the authority to visit this page!")
    window.location.href = "/checking_fundsAvailability";
  </script>
@endif
<!DOCTYPE html>
<html lang="en">
<head>
  @include('scripts/header')
  <link href='fullcalendar/lib/main.css' rel='stylesheet' />
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="adminlte3/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <link href='fullcalendar/lib/main.min.css' rel='stylesheet' />
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="adminlte3/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
      <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="adminlte3/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="adminlte3/plugins/toastr/toastr.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
   <!-- Preloader -->
   <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="adminlte3/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="500" width="500">
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
            <h1>Scheduling of Job Request and Laborers</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Scheduling of Job Request and Laborers</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-1" style = "display: none">
            <div class="sticky-top mb-3">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Dragg the job request</h4>
                </div>
                <div class="card-body">
                  <!-- the events -->
                  <div id="external-events">
                    <!-- <div class="external-event bg-success">Lunch</div>
                    <div class="external-event bg-warning">Go home</div>
                    <div class="external-event bg-info">Do homework</div>
                    <div class="external-event bg-primary">Work on UI design</div>
                    <div class="external-event bg-danger">Sleep tight</div> -->
                    <div class="checkbox">
                      <label for="drop-remove">
                        <input type="checkbox" id="drop-remove">
                        remove after drop
                      </label>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Create Event</h3>
                </div>
                <div class="card-body">
                  <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                    <ul class="fc-color-picker" id="color-chooser">
                      <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                    </ul>
                  </div>
                  <!-- /btn-group -->
                  <div class="input-group">
                    <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                    <div class="input-group-append">
                      <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                    </div>
                    <!-- /btn-group -->
                  </div>
                  <!-- /input-group -->
                </div>
              </div>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-body p-0">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @include('templates/footer')
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

 <!-- modal -->
 <div class="modal fade open_modal" id="modal-info">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header" style = "background-color: #1C518A; color: white;">
            <h4 class="modal-title" ></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <ul id = "ajaxresponse">

          </ul>
          <form action="#" id = "schedule_form">
              <div class="modal-body">
                @csrf
                <input type="date" style = "display:none" id = "start" name ="start">
                <input type="date" style = "display: none" id = "end" name = "end">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="construction">Approved; Constructions/Job Requests</label>
                      <select class = "form-control" name="construction" id="construction">

                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Color picker with addon:</label>
                      <div class="input-group my-colorpicker2">
                        <input type="text" name = "color" class="form-control" readonly>
                        <div class="input-group-append">
                          <span class="input-group-text"><i class="fas fa-square"></i></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- <div class="col-md-12">
                    <div class="form-group">
                      <label>Select Laborers</label>
                      <div class="select2-blue">
                        <select class="select2" name = "laborers[]" id = "laborers" multiple="multiple" data-placeholder="Select a laborer" data-dropdown-css-class="select2-blue" style="width: 100%;" >
    
                        </select>
                      </div>
                    </div>
                  </div> -->
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id = "btn_save">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
            </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
      <!-- /.modal -->
      <div class="modal fade  selection_modal" id="modal-lg">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <!-- <div class="overlay">
                <i class="fas fa-2x fa-sync fa-spin"></i>
            </div> -->
            <div class="modal-header" style = "background-color: #1C518A; color: white;">
              <div class = "row">
                <div class="col-md-12">
                    <h4 class="modal-title" id = "sm_modaltitle" > SELECT ON THE ITEMS</h4>
                </div>
                <div class="col-md-12">
                    <h9 class="modal-title" id = "sm_descriptiontitle" > SELECT ON THE ITEMS</h9>
                </div>
              </div>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                @csrf
                <input type="text" style = "display: none" id = "jobrequest_id">
                <!-- <div class="row">
                    <div class="col-md-3">
                      <a class = "btn btn-app bg-success" id = "btn_complete" style = "width: 200px; font-size: 16px; height: 80px" ><i class = "fa fa-check"></i> Complete</a>
                    </div>
                    <div class="col-md-3">
                      <a class = "btn btn-app bg-primary" id = "btn_update" style = "width: 200px; font-size: 16px; height: 80px" ><i class = "fa fa-edit"></i> Update Color</a>
                    </div>
                    <div class="col-md-3">
                      <a class = "btn btn-app bg-warning" id = "btn_scheduleManpower" style = "width: 200px; font-size: 16px; height: 80px" ><i class = "fa fa-users"></i> Schedule Manpowers</a>
                    </div>
                    <div class="col-md-3">
                      <a class = "btn btn-app bg-danger" id = "btn_remove" style = "width: 200px; font-size: 16px; height: 80px" ><i class = "fa fa-trash"></i> Remove</a>
                    </div>
                </div> -->
                <!-- <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Multiple</label>
                      <select class="duallistbox" id = "laborers" multiple>
                      </select>
                    </div>
                  </div>
                </div> -->
                <div class="row">
                  <div class="col-md-6">
                    <table id = "manpowers" class = "table table-stripped table-hover">
                      <thead>
                        <tr>
                          <th style = "text-align: center">Manpowers</th>
                          <th></th>
                        </tr>
                        <tr>
                          <th>Search</th>
                          <th>
                            <input type="text" class = "form-control" >
                          </th>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <table id = "selected_persons" class = "table table-stripped table-hover">
                      <thead>
                      <tr>
                          <th style = "text-align: center">Selected For Constructions</th>
                          <th></th>
                        </tr>
                        <tr>
                          <th>Search</th>
                          <th>
                            <input type="text" class = "form-control" >
                          </th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<!-- jQuery -->

<script src="adminlte3/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jQuery UI -->
<script src="adminlte3/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="adminlte3/plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="adminlte3/dist/js/adminlte.min.js"></script>
<!-- SweetAlert2 -->
<script src="adminlte3/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="adminlte3/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- Toastr -->
<script src="adminlte3/plugins/toastr/toastr.min.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="adminlte3/plugins/moment/moment.min.js"></script>
<script src='fullcalendar/lib/main.js'></script>
<script src='fullcalendar/lib/main.min.js'></script>
<!-- bootstrap color picker -->
<script src="adminlte3/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->

<!-- Page specific script -->
<script>
  $(function () {
    
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
     //Colorpicker
     $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()
     //Bootstrap Duallistbox
     $('.duallistbox').bootstrapDualListbox()
  })
</script>

<script>
$(function(){
  var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('.swalDefaultSuccess').click(function() {
    
    });
  show_allJobRequests();
  show_allLaborers();
  show_allForemans();
  var calendarE1 = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarE1, {
    initialView: 'dayGridMonth',
    selectable: true,
    events: '/get_schedules',
    themeSystem: 'bootstrap',
    selectHelper: true,
    select: function(select, start, end, allDay)
    {
      var start = new Date(select.start);
      // var start = ((start.getMonth() > 8) ? (start.getMonth() + 1) : ('0' + (start.getMonth() + 1))) + '/' + ((start.getDate() > 9) ? start.getDate() : ('0' + start.getDate())) + '/' + start.getFullYear();
      var start = ((start.getMonth() > 8) ? start.getFullYear() + '-' + (start.getMonth() + 1): start.getFullYear() + '-' + ('0' + (start.getMonth() + 1))) + '-' + ((start.getDate() > 9) ? start.getDate() : ('0' + start.getDate()));
      var end = new Date(select.end);
      var end = ((end.getMonth() > 8) ? end.getFullYear() + '-' +(end.getMonth() + 1 ): end.getFullYear() + '-' + ('0' + (end.getMonth() + 1))) + '-' + ((end.getDate() > 9) ? end.getDate(): ('0' + end.getDate()));
      $(".open_modal").modal('show');
      $(".modal-title").text('Schedule job request');
      $("#ajaxresponse").html("");
      $("#schedule_form").trigger('reset');
      $("#start").val(start);
      $("#end").val(end);
    },
    editable: true,
    eventResize: async function(event, delta)
    {
      var start = new Date(event.event.start)
      var start = ((start.getMonth() > 8) ? start.getFullYear() + '-' + (start.getMonth() + 1): start.getFullYear() + '-' + ('0' + (start.getMonth() + 1))) + '-' + ((start.getDate() > 9) ? start.getDate() : ('0' + start.getDate()));
      var end = new Date(event.event.end);
      var end = ((end.getMonth() > 8) ? end.getFullYear() + '-' +(end.getMonth() + 1 ): end.getFullYear() + '-' + ('0' + (end.getMonth() + 1))) + '-' + ((end.getDate() > 9) ? end.getDate(): ('0' + end.getDate()));
      var id = event.event.id;
      $.ajax({
        type: 'post',
        url: '/scheduling_actions',
        data: {
          type: 'update',
          start: start,
          end: end,
          id: id,
        },
        dataType: 'json',
        success: function(response)
        {
          if(response.status == 200)
          {
            Toast.fire({
              icon: 'success',
              title: response.success
            })
            calendar.refetchEvents();
          }
          if(response.status == 400)
          {
            alert(response.fail);
          }
        }
      })
    },
    eventDrop: async function(event, delta)
    {
      var start = new Date(event.event.start)
      var start = ((start.getMonth() > 8) ? start.getFullYear() + '-' + (start.getMonth() + 1): start.getFullYear() + '-' + ('0' + (start.getMonth() + 1))) + '-' + ((start.getDate() > 9) ? start.getDate() : ('0' + start.getDate()));
      var end = new Date(event.event.end);
      var end = ((end.getMonth() > 8) ? end.getFullYear() + '-' +(end.getMonth() + 1 ): end.getFullYear() + '-' + ('0' + (end.getMonth() + 1))) + '-' + ((end.getDate() > 9) ? end.getDate(): ('0' + end.getDate()));
      var id = event.event.id;
      $.ajax({
        type: 'post',
        url: '/scheduling_actions',
        data: {
          type: 'update',
          start: start,
          end: end,
          id: id,
        },
        dataType: 'json',
        success: function(response)
        {
          if(response.status == 200)
          {
            Toast.fire({
              icon: 'success',
              title: response.success
            })
            calendar.refetchEvents();
          }
          if(response.status == 400)
          {
            alert(response.fail);
          }
        }
      })
    },
    eventClick: function(event)
    {
      var id = event.event.id;
      var title = event.event.title;
      var start = new Date(event.event.start)
      var start = ((start.getMonth() > 8) ? start.getFullYear() + '-' + (start.getMonth() + 1): start.getFullYear() + '-' + ('0' + (start.getMonth() + 1))) + '-' + ((start.getDate() > 9) ? start.getDate() : ('0' + start.getDate()));
      var end = new Date(event.event.end);
      var end = ((end.getMonth() > 8) ? end.getFullYear() + '-' +(end.getMonth() + 1 ): end.getFullYear() + '-' + ('0' + (end.getMonth() + 1))) + '-' + ((end.getDate() > 9) ? end.getDate(): ('0' + end.getDate()));
      $("#sm_modaltitle").text(title);
      $("#sm_descriptiontitle").text("FROM "+start+" TO "+end);
      $(".selection_modal").modal({
            backdrop: 'static',
            keyboard: false,
        }, 'show');
      $("#jobrequest_id").val(id);
    }
  })
  calendar.render();
  $("#btn_remove").on('click', function(e){
    e.preventDefault();
    var id = $("#jobrequest_id").val();
    if(confirm("Are you sure you want to remove the job request in the schedule?"))
    {
      $.ajax({
        type: 'post',
        url: '/scheduling_actions',
        data: {
          id: id,
          type: 'delete',
        },
        dataType: 'json',
        success:  function(response)
        {
          if(response.status == 200)
          {
            alert(response.success);
            $(".selection_modal").modal('hide');
            $("#jobrequest_id").val("");
            calendar.refetchEvents();
          }
          if(response.status == 400)
          {
            alert(response.fail);
          }
        }
      })
    }
  })
  function check_jobRequests(constructionid)
  {
    $.ajaxSetup({
      type: 'get',
      url: '/get_allconstructions_approved_forscheduling/'+constructionid,
      dataType: 'json',
      async: false,
      contentType: false,
      success: function(data)
      {
        var result = false;
        if(data[0].totalJR > 0) result = true;
        return result;
      }
    })
  }
  function show_allJobRequests()
  {
    $.ajax({
      type: 'get',
      url: '/get_allconstructions_approved_forscheduling',
      dataType: 'json',
      success: function(data)
      {
        var option = "";
        option += '<option value = ""> -- Select Here --</option>';
        var jobrequests = data;
        for(var i = 0; i<jobrequests.length; i++)
        {
            option += '<option value = '+jobrequests[i].construction_id+' >'+jobrequests[i].construction_type+': '+jobrequests[i].construction_name+'</option>';
        }
        $("#construction").html(option);
      }
    })
  }

  function show_allLaborers()
  {
    $.ajax({
      type: 'get',
      url: '/get_allLaborers',
      dataType: 'json',
      success: function(data)
      {
        var row = "";
        for(var i = 0; i<data.length; i++)
        {
          row += '<tr>';
          row += '<td >'+data[i].name+'</td>';
          row += '<td align = "right"> <a class = "btn btn-warning btn-sm manpower" data-name = '+data[i].name+' data-id = '+data[i].user_id+'> >> </a> </td>'
          row += '</tr>';
        }
        $("#manpowers tbody").html(row);
      }
    })
  }
  $("body").on('click', '.manpower', function(response){
    var id = $(this).data('id');
    var name = $(this).data('name');
    var td = '<tr><td align = "left"> <a class = "btn btn-danger btn-sm s_manpower" data-name = '+name+' data-id = '+id+'> << </a> </td><td>'+name+'</td></tr>';
    $("#selected_persons").append(td);
  })
  function show_allForemans()
  {
    $.ajax({
      type: 'get',
      url: '/get_allForemans',
      dataType: 'json',
      success: function(data)
      {
        var option = "";
        for(var i = 0; i<data.length; i++)
        {
          option += '<option value = '+data[i].user_id+'>'+data[i].name+'</option>';
        }
        $("#foremans").html(option);
      }
    })
  }
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  })
  $("#schedule_form").on('submit', function(e){
    e.preventDefault();
    var data =$(this).serialize();
    $.ajax({
      type: 'post',
      url: '/scheduling_actions',
      data: data,
      dataType: 'json',
      success: function(response){
        if(response.status == 200)
        {
          calendar.refetchEvents();
          alert(response.success);
          $(".open_modal").modal('hide');
          $("#schedule_form").trigger('reset');
          $("#foremans").text("");
          $("#laborers").text("");
          
        }
        if(response.status == 401)
        {
          alert(response.fail)
        }
        if(response.status == 400)
        {
          $("#ajaxresponse").html("");
          $("#ajaxresponse").removeClass('alert alert-danger');
          $("#ajaxresponse").addClass('alert alert-danger');
          $.each(response.errors, function (key, err_values){
            $("#ajaxresponse").append('<li>'+err_values+'</li>');
          });
        }
        // alert("Total added laborers: "+response.total_added_laborers+"\n"+
        //       "Total_added_foremans: "+response.total_added_foremans+"\n"+
        //       "Foremans not saved: "+response.foremans_notsaved+"\n"+
        //       "Laborers not saved: "+response.laborers_notsaved);
        show_allJobRequests();
      },
      error: function(response){
        alert("Server error: Reload your page!");
      }
    })
  })
})
</script>
</body>
</html>
