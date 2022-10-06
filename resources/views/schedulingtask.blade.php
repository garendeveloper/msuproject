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
  <style>
 
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
   <!-- Preloader -->
   <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="adminlte3/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="500" width="500">
  </div> -->
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
            <h1>Scheduling of Job Requests and Manpowers</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Scheduling </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
         
          <!-- /.col -->
          <div class="col-md-8">
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
          <div class="col-md-4" >
          
          <div class="card" >
            <div class="card-header" style = "text-align: center;">
              <h6 class="card-title" style = " font-weight: bold; align: center" >Details of a complete job request</h6>
            </div>
            <div class="card-body">
              <table style = "border-line: 1px solid black; font-size: 12px" id = "schedule_details"  class = "table table-bordered table-stripped table-hovered">
                  <tbody >
                  </tbody>
              </table>
              <br>
              <table style = "border-line: 1px solid black; font-size: 12px" id = "manpower_details"  class = "table table-bordered">
                
              <tbody >
                  </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

      </div>
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
 <div class="modal fade open_modal" id="modal-info" style = "font-size: 12px">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header" style = "background-color: #1C518A; color: white;">
            <h6 class="modal-title" ></h6>
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
                      <label for="construction">Job Request Prioritize Urgent</label>
                      <select style = "font-size: 12px" class = "form-control" name="construction" id="urgentconstructions">

                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Color picker with addon:</label>
                      <div class="input-group my-colorpicker2">
                        <input type="text" name = "color" class="form-control" style = "font-size: 12px" readonly>
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
                <button type="submit" class="btn btn-outline-primary btn-block" id = "btn_save"><i class = "fa fa-save"></i> Submit</button>
              </div>
            </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
      <!-- /.modal -->
      <div class="modal fade  selection_modal" id="modal" style = "font-size: 12px">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header" style = "background-color: #1C518A; color: white;">
              <div class = "row">
                <div class="col-md-12">
                    <h6 class="modal-title" id = "sm_modaltitle" > SELECT ON THE ITEMS</h6>
                </div>
                <div class="col-md-12">
                    <h9 class="modal-title" id = "sm_descriptiontitle" > SELECT ON THE ITEMS</h9>
                </div>
              </div>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <ul id = "ajaxresponse1"></ul>
              <div class="modal-body">
                <form action="" id = "manpowerform">
                @csrf
                <input type="text" style = "display: none" name = "jobrequest_id" id = "jobrequest_id">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Select Head of Constructions (Foreman/s)</label>
                      <div class="select2-blue">
                        <select style = "font-size: 12px" class="select2" name = "foremans[]" id = "foremans" multiple="multiple" data-placeholder="Select the company of ..." data-dropdown-css-class="select2-blue" style="width: 100%;" required>
    
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <button style = "font-size: 12px" class = "btn btn-outline-primary btn-block" type = "submit" ><i class = "fa fa-save"></i> Submit</button>
                  </div>
                  <br><br>

                  <div class="col-md-12">
                   <table style = "font-size: 12px" class = "table table-stripped table-bordered table-hovered">
                    <thead>
                      <tr>
                        <th>Selected Worker Head/s (Foreman)</th>
                        <th>Date Scheduled</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id = "selected_workers">

                    </tbody>
                   </table>
                  </div>
                </div> <br> 
              
              </form>
              <div class="row">
                    <div class="col-md-6">
                      <button class = "btn btn-outline-success btn-sm btn-block" id = "btn_complete"><i class = "fa fa-check"></i> Complete</button>
                    </div>
                    <div class="col-md-6">
                      <div class="input-group my-colorpicker2">
                          <input type="text" placeholder = "Choose color here" name = "color" id = "changecolor" class="form-control" readonly>
                          <div class="input-group-append">
                            <button class= "btn btn-sm btn-outline-primary" id = "btn_changecolor">Change color</button>
                          </div>
                        </div>
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
$(document).ready(function() {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  })

  show_allLaborers();
  show_allForemans();
  var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
  
    var calendarE1 = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarE1, {
    defaultView: 'dayGridMonth',
    // plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
      // height: 'parent',
    headerToolbar: {
        left  : 'prev,next today',
        center: 'title',
        right : 'dayGridMonth,timeGridWeek,timeGridDay'
      },
    eventLimit: true,
    navLinks: true,
    selectable: true,
    events: '/get_schedules',
    themeSystem: 'bootstrap',
    selectHelper: true,
    draggable: false,
    select: function(select, start, end, allDay)
    {
      var start = new Date(select.start);
      // var start = ((start.getMonth() > 8) ? (start.getMonth() + 1) : ('0' + (start.getMonth() + 1))) + '/' + ((start.getDate() > 9) ? start.getDate() : ('0' + start.getDate())) + '/' + start.getFullYear();
      var start = ((start.getMonth() > 8) ? start.getFullYear() + '-' + (start.getMonth() + 1): start.getFullYear() + '-' + ('0' + (start.getMonth() + 1))) + '-' + ((start.getDate() > 9) ? start.getDate() : ('0' + start.getDate()));
      var end = new Date(select.end);
      var end = ((end.getMonth() > 8) ? end.getFullYear() + '-' +(end.getMonth() + 1 ): end.getFullYear() + '-' + ('0' + (end.getMonth() + 1))) + '-' + ((end.getDate() > 9) ? end.getDate(): ('0' + end.getDate()));
      $(".open_modal").modal({
        backdrop: 'static',
        keyboard: false,
      }, 'show');
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

      $.ajax({
        type: 'get',
        url: '/get_eventInfo/'+id,
        dataType: 'json',
        success: function(data)
        {
          if(data.scheduleinfo[0].status == 0)
          {
            show_allworkers(id);
          
            $("#sm_modaltitle").text(title);
            $("#sm_descriptiontitle").text("FROM "+start+" TO "+end);
            $(".selection_modal").modal({
                  backdrop: 'static',
                  keyboard: false,
              }, 'show');
            $("#jobrequest_id").val(id);
            $("#changecolor").val("");
          }
          else
          {
            var details = "<tr>";
                details += "<td style = 'background-color: #1C518A; color: white'>Job Request</td>";
                details += "<td style = 'background-color: #1C518A; color: white;'>"+data.scheduleinfo[0].title+"</td>";
                details += "</tr>";

                details += "<tr>";
                details += "<td>Status</td>";
                details += "<td><span class = 'badge badge-success'> Completed </span></td>";
                details += "</tr>";

                details += "<tr>";
                details += "<td >Date Started</td>";
                details += "<td>"+data.scheduleinfo[0].start+"</td>";
                details += "</tr>";

                details += "<tr>";
                details += "<td >Date Ended</td>";
                details += "<td> "+data.scheduleinfo[0].end+"</td>";
                details += "</tr>";

                var startDay = new Date(data.scheduleinfo[0].start);
                var endDay = new Date(data.scheduleinfo[0].end);

                var millisBetween = startDay.getTime() - endDay.getTime();
                var days = millisBetween / (1000 * 3600 * 24);
   
                var numberofdays = Math.round(Math.abs(days));

                details += "<tr>";
                details += "<td >Total Days</td>";
                details += "<td> "+numberofdays+"</td>";
                details += "</tr>";

                details += "<tr>";
                details += "<td >Requested By: </td>";
                details += "<td> "+data.scheduleinfo[0].name+"</td>";
                details += "</tr>";

                details += "<tr>";
                details += "<td >Designation </td>";
                details += "<td> "+data.scheduleinfo[0].designation+"</td>";
                details += "</tr>";

                details += "<tr>";
                details += "<td> Type: </td>";
                details += "<td> "+toTitleCase(data.scheduleinfo[0].departmentname.toLowerCase())+"</td>";
                details += "</tr>";

            $("#schedule_details tbody").html(details)

            var manpowers = ""; 
            manpowers += '<tr style = "background-color: #1C518A; color: white">'+
                            '<th>Head Of Construction</th>'+
                          '</tr>';
            for(var i = 0; i<data.manpowers.length; i++)
            {
              manpowers += "<tr >";
              manpowers += "<td> FOREMAN: "+data.manpowers[i].name.toUpperCase()+"</td>";
              manpowers += "</tr";
            }
            $("#manpower_details").html(manpowers)
          }
        }
      })
    },
  })
  calendar.render();
  function toTitleCase(str) {
        return str.replace(/(?:^|\s)\w/g, function(match) {
            return match.toUpperCase();
        });
    }
  function show_allForemans()
    {
    $.ajax({
      type: 'get',
      url: '/get_allScheduledWorkers',
      dataType: 'json',
      success: function(data)
      {
        var row = "";
        for(var i = 0; i<data.length; i++)
        {
          if(data[i].departmentname == "FOREMAN")
          {
            row += "<option value = "+data[i].id+" >"+data[i].name+"</option>";
          }
        }
        $("#foremans").html(row);
      }
    })
  }
    $('.swalDefaultSuccess').click(function() {
    
    });
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
  function show_allworkers(id)
  {
    $.ajax({
        type: 'get',
        url: '/get_allworkers/'+id,
        dataType: 'json',
        success: function(data)
        {
          var row = "";
          for(var i = 0; i<data.length; i++)
          {
              row += "<tr>";
              row += "<td data-id = "+data[i].userjobrequest_id+">"+data[i].name+"</td>";
              row += "<td data-id = "+data[i].userjobrequest_id+">"+data[i].created_at+"</td>";
              row += "<td  style = 'text-align: center'><a  data-id = "+data[i].userjobrequest_id+"  class = 'btn btn-outline-danger btn-sm selectedworker'><i class = 'fa fa-'></i> Remove</a></td>";
              row += "</tr>";
            
          }
          $("#selected_workers").html(row);
        }
      })
  }

  $("body").on('click', '.selectedworker', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    var jobrequest_id = $("#jobrequest_id").val();
    if(confirm("Do you want to remove this person in this contruction?"))
    {
      $.ajax({  
        type: 'get',
        url: '/remove_workerinschedule/'+id,
        dataType: 'json',
        success: function(data)
        {
          if(data.status == 200)
          {
              Toast.fire({
                  icon: 'success',
                title: data.success
              })
              show_allworkers(jobrequest_id);
              show_allForemans();
          }
          else
          {
            alert("Something went wrong in server");
          }
        }
      })
    }
  })
  $("#btn_complete").on('click', function(e){
    e.preventDefault();
    var jobrequest_id = $("#jobrequest_id").val();

    if(confirm("Do you want to complete the construction on this schedule?\nThis action cannot be undone\n\nPress Ok otherwise Cancel"))
    {
      $.ajax({  
        type: 'get',
        url: '/complete_schedule/'+jobrequest_id,
        dataType: 'json',
        success: function(data)
        {
          if(data.status == 200)
          {
              Toast.fire({
                  icon: 'success',
                title: data.success
              })
              calendar.refetchEvents();
              $("#manpower_form").trigger('reset');
              $(".selection_modal").modal('hide');
              show_allForemans();
          }
          else if(data.status == 201) 
          {
            alert(data.message)
          }
          else
          {
            alert("Something went wrong in server");
          }
        }
      })
    }
  })
  $("#manpowerform").on('submit', function(e){
    e.preventDefault();
    var jobrequest_id = $("#jobrequest_id").val();
    var data = $(this).serialize();
    if(confirm("Do you want to proceed with the person/s selected?\nThis action cannot be undone\n\nPress Ok to proceed otherwise Cancel."))
    {
      $.ajax({
        type: 'post',
        url: '/manpower_actions',
        data: data,
        success: function(response)
        {
          if(response.status == 200)
          {
            calendar.refetchEvents();
            Toast.fire({
                icon: 'success',
              title: response.success
            })
            $("#manpower_form").trigger('reset');
            $("#foremans").text("");
            $("#laborers").text("");
            show_allForemans();
            show_allworkers(jobrequest_id);
            
          }
          if(response.status == 401)
          {
            alert(response.fail)
          }
          if(response.status == 400)
          {
            $("#ajaxresponse1").html("");
            $("#ajaxresponse1").removeClass('alert alert-danger');
            $("#ajaxresponse1").addClass('alert alert-danger');
            $.each(response.errors, function (key, err_values){
              $("#ajaxresponse1").append('<li>'+err_values+'</li>');
            });
          }
          if(response.users.length() > 0)
          {
            for(var i = 0; i<response.users.length(); i++)
            {
              console.log(response.users);
            }
          }
          show_allForemans();
          show_allJobRequestsNotUrgent();
          show_allJobRequestsUrgent()
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
  show_allJobRequestsUrgent()
  function show_allJobRequestsUrgent()
  {
    $.ajax({
      type: 'get',
      url: '/get_allurgentconstructions_approved_forscheduling',
      dataType: 'json',
      success: function(data)
      {
        var option = "";
        option += '<option value = ""> -- Select Here --</option>';
        var jobrequests = data;
        for(var i = 0; i<jobrequests.length; i++)
        {
          var urgent = jobrequests[i].urgentstatus;
          if(urgent == 1) 
          {
            option += '<option  style = "color: green" value = '+jobrequests[i].construction_id+' >'+jobrequests[i].construction_type+':  <b> URGENT </b> </option>';
          }
          else{
            option += '<option style = "color: blue" value = '+jobrequests[i].construction_id+' >'+jobrequests[i].construction_type+'</option>';
          }
           
        }
        $("#urgentconstructions").html(option);
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
          row += '<td  class = "manpower"  data-name = '+data[i].name+' data-id = '+data[i].user_id+'>  '+data[i].name+' </td>';
        }
        $("#manpowers tbody").html(row);
      }
    })
  }
  $("body").on('click', '.manpower', function(response){
    alert()
    var id = $(this).data('id');
    var name = $(this).data('name');
    var td = '<tr><td align = "left"> <a class = "btn btn-danger btn-sm s_manpower" data-name = '+name+' data-id = '+id+'> << </a> </td><td>'+name+'</td></tr>';
    $(this).remove();
    $("#selected_persons").append(td);
   
  })
  $("#btn_changecolor").on('click', function(e){
    var id = $("#jobrequest_id").val();

    var value = $("#changecolor").val();
    $.ajax({
      type: 'post',
      url: '/changecolor',
      data: {color: value, id: id},
      cache:false,
      success: function(response)
      {
        if(response.status == 200)
        {
          calendar.refetchEvents();
        }
      }
    })
  })
  function users()
  {
    var data;
    $.ajax({
      type: 'get',
      url: '/get_allusers',
      dataType: 'json',
      success: function(data)
      {
        data = data;
      }
    })
    return data;
  }
  function check_worker(id)
  {
    $.ajax({
      type: 'get',
      url: '/check_worker/'+id,
      dataType: 'json',
      success: function(data) 
      {
        return data;
      },
    })
  }


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
          show_allForemans();
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
       show_allJobRequestsUrgent();
        
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
