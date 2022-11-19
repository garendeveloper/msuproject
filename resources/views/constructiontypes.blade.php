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
  <div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h5>Constructions/Repair/Improvements (JOB REQUESTS) Ordered By Date  </h5>
          </div>
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/constructions') }}">Constructions</a> </li>
              <li class="breadcrumb-item active">Constructions/Repair/Improvements</li>
            </ol>
          </div> -->
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="{{ url('/jobrequest_form') }}" class="btn btn-sm btn-primary btn-block mb-3">Compose</a>

          <div class="card" >
            <div class="card-header">
              <h3 class="card-title" align = "center">Information </h3>
              <br><br>
              <h4 class="card-title" id = "title" style = "font-weight: bold" ></h4>
            
            </div>
            <table id = "information" class = "table table-stripped table-bordered" style = "font-size: 12px">

            </table>
            <div class="card-body p-0">
              <!-- <ul class="nav nav-pills flex-column">
                <li class="nav-item active">
                  <a href="#" class="nav-link">
                    <i class="fas fa-inbox"></i> Inbox
                    <span class="badge bg-primary float-right">12</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-envelope"></i> Sent
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-file-alt"></i> Drafts
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="fas fa-filter"></i> Junk
                    <span class="badge bg-warning float-right">65</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-trash-alt"></i> Trash
                  </a>
                </li>
              </ul> -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <div class="card">
          
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Inbox</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm">
                  <input type="text" id = "search" class="form-control" placeholder="Search Mail">
                  <div class="input-group-append">
                    <div class="btn btn-primary">
                      <i class="fas fa-search"></i>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <!-- <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
                </button> -->
                <!-- <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm">
                    <i class="far fa-trash-alt"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm">
                    <i class="fas fa-reply"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm">
                    <i class="fas fa-share"></i>
                  </button>
                </div> -->
                <!-- /.btn-group -->
                 <button type="button" id = "btn_refresh" class="btn btn-default btn-sm">
                  <i class="fas fa-sync-alt"></i> 
                </button>

                  <!-- /.btn-group -->
                </div>
                <!-- /.float-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table id = "tbl_constructiontypes" style = "font-size: 12px" class="table table-hover table-striped">
                  <thead>
                    <tr>
                      <th>Job Request</th>
                      <th>Urgency</th>
                      <th>Status</th>
                      <th>Requested By: </th>
                      <th>Date Requested</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id = "tbody_constructiontypes">
                 
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer p-0">
              <div class="mailbox-controls">

              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  
  <!-- modal -->
  <div class="modal fade modal_addconstructiontype" id="modal-info">
      <div class="modal-dialog  modal-lg">
        <div class="modal-content">
          <!-- <div class="overlay">
              <i class="fas fa-2x fa-sync fa-spin"></i>
          </div> -->
          <div class="modal-header" style = "background-color: #1C518A; color: white;">
            <h4 class="modal-title" ></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <ul id = "ajaxresponse">

          </ul>
          <form action="#" id = "addform">
              <div class="modal-body">
                @csrf
                <div class="form-group">
                  <label for="construction">Construction/Repair/Improvements</label>
                  <input type="text" style = "display: none" val = "" id = "id" name = "id">
                  <!-- <input type="text" name = "construction_type" id= "construction_type" class = "form-control" autocomplete ='off' autofocus> -->
                  <textarea class= "form-control" name="construction_type" id="construction_type" cols="30" rows="10" autofocus></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-outline-primary btn-block" id = "btn_save"><i class = "fa fa-save"> </i> Save</button>
              </div>
            </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  
      <!-- /.modal -->
 <!-- /.content-wrapper -->
 <div class="modal fade openmodal" id="modal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <!-- <div class="overlay">
                <i class="fas fa-2x fa-sync fa-spin"></i>
            </div> -->
            <div class="modal-header " >
              <h4 class="modal-title">Add Construction (SOW ) </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <ul id = "ajaxresponse">

            </ul>
            <form id = "addconstruction_form" action="" method = "post">
              <div class="modal-body">
                @csrf
                <input type="hidden" value = "" id = "id" name = "id">
               
                <div class="form-group">
                  <label for="constructiontype_id">Construction Type</label>
                  <input type="hidden" value = "" name = "constructiontype_id" id = "constructiontype_id">
                  <!-- <input type="text" class = "form-control"  readonly> -->
                  <textarea name="" id = "constructiontype" class = "form-control" cols="30" rows="4" readonly></textarea>
                </div>
                <div class="form-group">
                  <label for="construction">Scope of Work </label>
                 
                  <textarea name="construction_name" id="construction_name" class = "form-control" cols="30" rows="4" autocomplete = "off" ></textarea>
                </div>

              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id = "save"><i class  = "fa fa-save" ></i> Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class = "fa fa-close-o"></i> Close</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

  <!-- Main Footer -->
  @include('templates/footer')
</div>
<!-- ./wrapper -->


<!-- REQUIRED SCRIPTS -->
@include('scripts/footer')

<script>
  $(function () {
    //Enable check and uncheck all functionality
    $('.checkbox-toggle').click(function () {
      var clicks = $(this).data('clicks')
      if (clicks) {
        //Uncheck all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
        $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
      } else {
        //Check all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
        $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
      }
      $(this).data('clicks', !clicks)
    })

    //Handle starring for font awesome
    $('.mailbox-star').click(function (e) {
      e.preventDefault()
      //detect type
      var $this = $(this).find('a > i')
      var fa    = $this.hasClass('fa')

      //Switch states
      if (fa) {
        $this.toggleClass('fa-star')
        $this.toggleClass('fa-star-o')
      }
    })
  })
</script>

<script>
  $(function () {
    $("#search").on('keyup', function(){
      var value = $(this).val().toLowerCase();
      $("#tbl_constructiontypes tbody tr").filter(function(){
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>
<script type = "text/javascript">

    show_allData();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    
    // $('#tbl_constructiontypes').DataTable({ pagingType: 'full_numbers',});
    $("#btn_addconstructiontype").on('click', function(e){
      e.preventDefault();
      $("#addform").trigger('reset');
      $(".modal_addconstructiontype").modal({
        backdrop: 'static',
        keyboard: false,
      }, 'show');
      $(".modal-title").text('Add Construction Type');
    });
    // $("#search").on('keyup', function(){
    //   var value = $(this).val().toLowerCase();
    //   $("#tbl_constructiontypes tr").filter(function(){
    //     $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    //   });
    // });
    $("#btn_refresh").on('click', function(e){
      e.preventDefault();
      show_allData();
    })
    $("body").on('click', '.addconstruction', function(e){
      e.preventDefault();
      var constructiontype_id = $(this).data('id');
      var constructiontype = $(this).data('constructiontype');
      $("#constructiontype").val(constructiontype);
      $("#constructiontype_id").val(constructiontype_id);
      $(".modal-title").text('Add Scope Of Work Of: ')
      $(".openmodal").modal('show');
    })
    $("#addconstruction_form").on('submit', function(e){
      e.preventDefault();
      var formdata = $(this).serializeArray();
      $.ajax({
        type: 'POST',
        url: '/construction_actions',
        data: formdata,
        dataType: 'json',
        success:  function  (response)
        {
          if(response.status == 200){
            $("#ajaxresponse").html("");
            $("#ajaxresponse").removeClass('alert alert-danger');
            $("#modal").modal('hide');
            $("form").trigger('reset');
            alert(response.success);
          }
          if(response.status == 400){
            $("#ajaxresponse").html("");
            $("#ajaxresponse").removeClass('alert alert-danger');
            $("#ajaxresponse").addClass('alert alert-danger');
            $.each(response.errors, function (key, err_values){
              $("#ajaxresponse").append('<li>'+err_values+'</li>');
            });
          }
          if(response.status == 401){
            $("#ajaxresponse").html("");
            $("#ajaxresponse").removeClass('alert alert-danger');
            $("#ajaxresponse").addClass('alert alert-danger');
            alert(response.message);
          }
          show_allData();
        },
        error:  function  (response)
        {
          alert('Something went wrong! Reload the page.')
        }
      });
    });
    function show_allData(){
      $.ajax({
        type: 'GET',
        url: '/get_allconstructiontypes',
        dataType: 'json',
        contentType: false,
        cache: false,
        async: false,
        success: function(data){
          var html = "";
          for(var i = 0; i<data.length; i++)
          {
            var urgentstatus = "<span class = 'badge badge-primary'>No</span>";
            if(data[i].urgentstatus == 1) urgentstatus = "<span class = 'badge badge-danger'>Urgent</span>";

            var status = "<span class = 'badge badge-warning'>In Process</span>";
            if(data[i].status == 1) status = "<span class = 'badge badge-success'>Approved</span>";
            // var date = new Date(data[i].created_at);
            html += "<tr style = 'text-align:center'>";
            html += "<td class='mailbox-name'><b>"+toTitleCase(data[i].construction_type.toLowerCase())+"</b></td>";
            html += "<td>"+urgentstatus+"</td>";
            html += "<td>"+status+"</td>";
            html += "<td style = 'color: blue'>"+toTitleCase(data[i].name.toLowerCase())+"</td>";
            // html += "<td >"+jQuery.timeago(date)+"</td>";
            html += "<td >"+data[i].dateRequested+"</td>";
            html += '<td align = "center" > '+
                        '<a style  ="color:black"  class = " info" data-constructiontype = "'+data[i].construction_type+'" data-id = "'+data[i].id+'" ><i class = "fa fa-info"></i>&nbsp; Info</a> '+ 
                        '<a href = "/jobrequest_formById/'+data[i].id+'" ><i class = "fa fa-edit"></i>&nbsp; Update</a> '+ 
                        '<a style  ="color:red"  href = "/constructionsbyID/'+data[i].id+'" ><i class = "fa fa-arrow-right"></i>&nbsp; Estimation</a>'+ 
                     '</td>';
            html += "</tr>";
          }
          $("#tbody_constructiontypes").html(html);
        },
        error: function(response){
          alert("Something went wrong in fetching data in database.");
        }
      });
    }
    $("body").on('click', '.info', function(e){
      e.preventDefault();
      var id = $(this).data('id');
      $.ajax({
        type: 'GET',
        url: '/get_jobrequestdata/'+id,
        dataType: 'json',
        success: function(data){
        
          $("#title").text(toTitleCase(data.user[0].construction_type.toLowerCase()));
          var user = '<tr>'+
                        '<th>Requested By: </th>'+
                        '<td>'+data.user[0].name+'</td>'+
                      '</tr>';
          user += '<tr>'+
                    '<th>Designation</th>'+
                    '<td>'+data.user[0].designation+'</td>'+
                  '</tr>';
          user += '<tr>'+
                    '<th>Type</th>'+
                    '<td>'+data.user[0].departmentname+'</td>'+
                  '</tr>';
           user += '<tr>'+
                    '<th>Date Requested</th>'+
                    '<td>'+data.user[0].dateRequested+'</td>'+
                  '</tr>';
          if(data.user[0].status == 1)
          {
            user += '<tr>'+
                    '<th>Status</th>'+
                    '<td> <span class = "badge badge-success">Approved</span></td>'+
                  '</tr>';
          }
          if(data.user[0].urgentstatus == 1)
          {
            user += '<tr>'+
                    '<th>Urgency</th>'+
                    '<td> <span class = "badge badge-danger">Urgent</span></td>'+
                  '</tr>';
          }
          if(data.user[0].status == 0)
          {
            user += '<tr>'+
                    '<th>Approval Status</th>'+
                    '<td> <span class = "badge badge-warning">In Process</span></td>'+
                  '</tr>';
          }
          if(data.scheduling_info[0].status == 0 || data.scheduling_info[0].status == " ")
          {
            user += '<tr>'+
                    '<th>Scheduling Status</th>'+
                    '<td> <span class = "badge badge-warning">Pending</span></td>'+
                  '</tr>';
          }
          if(data.scheduling_info[0].status == 1)
          {
            user += '<tr>'+
                    '<th>Scheduling Status</th>'+
                    '<td> <span class = "badge badge-success">Completed</span></td>'+
                  '</tr>';
          }
          $("#information").html(user);
        },
        error: function(response){
          alert('Something went wrong in fetching data in database.');
        }
      });
    })
    function toTitleCase(str) {
        return str.replace(/(?:^|\s)\w/g, function(match) {
            return match.toUpperCase();
        });
    }
    $("body").on('click', '.edit', function(){
      var id = $(this).data('id');  
      $("form").trigger('reset');
      $("#ajaxresponse").html("");
      $("#ajaxresponse").removeClass("alert alert-danger");
      $.ajax({
        type: 'GET',
        url: '/get_constructiondata/'+id,
        dataType: 'json',
        success: function(data){
          $("#id").val(id);
          $("#construction_type").val(data.construction_type);
          $(".modal-title").text('Edit Construction Type');
          $(".modal_addconstructiontype").modal('show');
        },
        error: function(response){
          alert('Something went wrong in fetching data in database.');
        }
      });
    });

    $("body").on('click', '.remove', function(){
      var id = $(this).data('id');
      
      if(confirm("Are you sure you want to remove this item?")) {
        $.ajax({
          type: 'POST',
          url: '/remove_constructiontype/'+id,
          dataType: 'json',
          success: function (response){
            if(response.status == 200){
              alert(response.success);
            }
            if(response.status == 400){
              alert(response.error);
            }
            show_allData();
          },
          error: function (r){
            alert("Something went wrong!Please reload the page!");
          }
        })
      }
    });
   
    $("#addform").on('submit', function(e) {
      e.preventDefault();

      var data = $(this).serializeArray();

      $.ajax({
        type: "POST",
        url: "/addconstructiontype",
        data: data,
        dataType: "json",
        success:  function(response){
          if(response.status == 400){
            $("#ajaxresponse").html("");
            $("#ajaxresponse").addClass("alert alert-danger");
            $.each(response.errors, function (key, err_values){
              $("#ajaxresponse").append('<li>'+err_values+'</li>');
            });
          }
          if(response.status == 200){
            $("#ajaxresponse").html("");
            $("#ajaxresponse").removeClass('alert alert-danger');
            alert(response.success);
            $(".modal_addconstructiontype").modal('hide');
            $("#addform").trigger('reset');
          }
          show_allData();
        },
        error:  function(response, error){
          alert("Something went wrong\nPlease contact your administrator for immediate actions!");
        }
      });
    });
</script>
</body>
</html>
