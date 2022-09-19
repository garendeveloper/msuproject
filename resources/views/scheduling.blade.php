<!DOCTYPE html>
<html lang="en">
<head>
  @include('scripts/header')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
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
                      <label>Select Foreman/s</label>
                      <div class="select2-purple">
                        <select class="select2" name = "foremans[]" id = "foremans" multiple="multiple" data-placeholder="Select a foreman" data-dropdown-css-class="select2-purple" style="width: 100%; height: 50px" >

                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Select Laborers</label>
                      <div class="select2-blue">
                        <select class="select2" name = "laborers[]" id = "laborers" multiple="multiple" data-placeholder="Select a laborer" data-dropdown-css-class="select2-blue" style="width: 100%;" >
    
                        </select>
                      </div>
                    </div>
                  </div>
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
<!-- jQuery -->
<script src="adminlte3/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jQuery UI -->
<script src="adminlte3/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="adminlte3/plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="adminlte3/dist/js/adminlte.min.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="adminlte3/plugins/moment/moment.min.js"></script>
<script src="adminlte3/plugins/fullcalendar/main.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="adminlte3/dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  })
</script>
<script>
  // alert("Please click on the calendar to add schedule")
  show_allJobRequests();
  show_allLaborers();
  show_allForemans();
  function show_allJobRequests()
  {
    $.ajax({
      type: 'get',
      url: '/get_allconstructions_approved',
      dataType: 'json',
      success: function(data)
      {
        var option = "";
        option += '<option> -- Select Here --</option>'
        for(var i = 0; i<data.length; i++)
        {
          option += '<option value = '+data[i].construction_id+'>'+data[i].construction_type+': '+data[i].construction_name+'</option>';
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
        var option = "";
        for(var i = 0; i<data.length; i++)
        {
          option += '<option value = '+data[i].user_id+'>'+data[i].name+'</option>';
        }
        $("#laborers").html(option);
      }
    })
  }
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
  $(function () {

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
            alert("Job request successfully on scheduled!");
            $("#open_modal").modal('hide');
            $("#schedule_form").trigger('reset');
            $("#foremans").text("");
            $("#laborers").text("");
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
        },
        error: function(response){
          alert("Server error: Reload your page!");
        }
      })
    })
    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {

        // create an Event Object (https://fullcalendar.io/docs/event-object)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    ini_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendar.Draggable;

    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');

    // initialize the external events
    // -----------------------------------------------------------------

    new Draggable(containerEl, {
      itemSelector: '.external-event',
      eventData: function(eventEl) {
        return {
          title: eventEl.innerText,
          backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
        };
      }
    });

    var calendar = new Calendar(calendarEl, {
      headerToolbar: {
        left  : 'prev,next today',
        center: 'title',
        right : 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      themeSystem: 'bootstrap',
      //Random default events
      events: '/get_schedules',
      selectable: true,
      selectHelper: true,
      editable  : true,
      select: function(start, end, allDay)
      {
        var start_month = start.start.getMonth()+1;
        var start_day = start.start.getDate();
        var start_year = start.start.getFullYear();
        if(start_month > 9) start_month = 0+""+start_month;

        var end_month = start.end.getMonth()+1;
        var end_day = start.end.getDate();
        var end_year = start.end.getFullYear();
        if(end_month > 9) end_month = 0+""+end_month;
        $(".open_modal").modal('show');
        $(".modal-title").text('Add Schedule');
  
        $("#start").val(start_year+"-"+start_month+"-"+start_day);
        $("#end").val(end_year+"-"+end_month+"-"+end_day);
      }
    });

    calendar.render();
    // $('#calendar').fullCalendar()

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    // Color chooser button
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      // Save color
      currColor = $(this).css('color')
      // Add color effect to button
      $('#add-new-event').css({
        'background-color': currColor,
        'border-color'    : currColor
      })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      // Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      // Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.text(val)
      $('#external-events').prepend(event)

      // Add draggable funtionality
      ini_events(event)

      // Remove event from text input
      $('#new-event').val('')
    })
  })
</script>
</body>
</html>
