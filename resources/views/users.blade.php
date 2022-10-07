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
  <!-- Navbar -->
  @include('templates/navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('templates/sidebar')
  <!-- /.control-sidebar -->

    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="adminlte3/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="500" width="500">
  </div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Employees & Workers</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              
                <div class="row">
                  <div class="col md-6">
                    <button class = "btn btn-outline-primary" id = "btn_modal" type = "button" align = "left"><i class = "fa fa-user-plus"></i> Add User</button>
                  </div>
                  <div class="col-md-6">
                  <input class="form-control" id = "search" type="search" placeholder="Search Item" aria-label="Search">
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tbl_Users" style = "table-layout: absolute;   border: 1px solid black;" class="table table-bordered table-striped">
                  <thead style = "background-color: #1C518A;color: white; ">
                  <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>User Type</th>
                    <th>Designated Office</th>
                    <th>Email</th>
                    <th>Employment Status</th>
                    <!-- <th>Date Created</th>
                    <th>Date Updated</th> -->
                   
                    <th style = "text-align: center">Actions</th>
                  </tr>
                  </thead>
                  <tbody id = "tbody_Users">
                
                  </tbody>
                  <tfoot>
                 
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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
  
  <!-- modal -->
  <div class="modal fade modal" id="modal-info">
      <div class="modal-dialog modal-lg" >
        <div class="modal-content"  >
          <div class="modal-header" style = "background-color: #1C518A; color: white;">
            <h4 class="modal-title">User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <ul id = "ajaxresponse">

          </ul>
          <form id = "userform" action="" method = "post">
            <div class="modal-body">
              @csrf
              <input type="text" style = "display: none" name = "id" id = "id" value = "" >
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="construction">Fullname</label>
                        <input type="text" name = "name" id= "name" class = "form-control" autofocus autocomplete = "off">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="construction">Email</label>
                        <input type="email" name = "email" id= "email" class = "form-control" autocomplete = "off">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="construction">Phone Number</label>
                        <input type="number" name = "phone_num" id= "phone_num" class = "form-control" autocomplete = "off">
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Type">Type</label>
                        <select name="departmentname" id="departments" class = "form-control" >
                        
                        </select>
                        <!-- <input autocomplete = "off" type="deparment" list = "departments" name = "department" id= "department" class = "form-control" autofocus>
                        <datalist id = "departments">

                        </datalist> -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="designation">Designation</label>
                        <select name="designation" id="designated_offices" class = "form-control">

                        </select>
                    </div>
                </div>
                <span style = "color: blue"><i> Note: Upon adding of a job requestor. His default password will be his username which have no spaces.</i></span>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-outline-primary btn-block" id = "save"><i class = "fa fa-save"></i> Save</button>
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

<script type = "text/javascript">
    show_allData()
    show_allUserTypes()
    show_allDesignatedOffices()
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    const formatToCurrency = amount => {
		return "" + amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,");
	};

    $("#search").on('keyup', function(){
      var value = $(this).val().toLowerCase();
      $("#tbl_Users tbody tr").filter(function(){
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
    // $('#tbl_Users').DataTable({
    //     pagingType: 'full_numbers',
    // });
    $("#userform").on('submit', function(e){
      e.preventDefault();
      var data = $(this).serialize();
      $.ajax({
        type: 'post',
        url: '/useractions',
        data: data,
        dataType: 'json',
        success: function(response)
        {
          if(response.status == 400)
          {
            $("#ajaxresponse").html("");
            $("#ajaxresponse").removeClass('alert alert-danger');
            $("#ajaxresponse").addClass('alert alert-danger');
            $.each(response.errors, function (key, err_values){
              $("#ajaxresponse").append('<li>'+err_values+'</li>');
            });
          }
          if(response.status == 200)
          {
            alert(response.success);
            $("#ajaxresponse").html("");
            $("#ajaxresponse").removeClass('alert alert-danger');
            $(this).trigger('reset');
            $(".modal").modal('hide');
            show_allData();
            show_allDesignatedOffices();
            show_allUserTypes();
          }
          if(response.status == 201)
          {
            alert(response.fails);
          }
         
        },
        error: function(response) {alert("Something went wrong!");}
      })
    })
    $("body").on('click', '.edit', function(e){
      e.preventDefault();
      var id = $(this).data('id');
      $("#id").val(id);
      $("#ajaxresponse").html('')
      $("#ajaxresponse").removeClass('alert-danger');
      $.ajax({
        type: 'GET',
        url: '/get_userinfo/'+id,
        dataType: 'json',
        success: function(data){
          $("#name").val(data[0].name);
          $("#email").val(data[0].email);
          $("#designated_offices option:selected").val(data[0].designated_id);
          $("#designated_offices option:selected").text(data[0].designation);
          $("#departments option:selected").val(data[0].department_id);
          $("#departments option:selected").text(data[0].departmentname);
          $("#phone_num").val(data[0].phone_num);
        },
      })
      $("#modal-title").text("Edit User Details")
      $(".modal").modal({
        backdrop: 'static',
        keyboard: false,
      })
    })
    function show_allUserTypes()
    {
      $.ajax({
        type: 'GET',
        url: '/get_allDepartments',
        dataType: 'json',
        success: function(data){
          var option = "<option value = ''> -- Please select user type here -- </option>";
          for(var i = 0; i<data.length; i++)
          {
            if(data[i].departmentname == "JOB REQUESTOR" ||  (data[i].departmentname == "FOREMAN"))
            {
               option += "<option value = "+data[i].id+">"+data[i].departmentname+"</option>";
            }
          }
          $("#departments").html(option);
        },
      })
    }
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
            option += "<option value = "+data[i].id+">"+data[i].designation+"</option>";
          }
          $("#designated_offices").html(option);
        },
      })
    }
    function toTitleCase(str) {
        return str.replace(/(?:^|\s)\w/g, function(match) {
            return match.toUpperCase();
        });
    }
    function show_allData(){
      $.ajax({
          type: 'GET',
          url: '/get_allusers',
          dataType: 'json',
          success: function(data){
              var row = "";
              if(data.length < 0) 
              {
                  row = "<tr> --No data available -- </tr>"
              }
              else
              {
                  for(var i = 0; i<data.length; i++)
                  {
                    var optionRetirement = "";

                    var retirementstatus = "<span class = 'badge badge-success'>Employee</span>";
                  
                    if(data[i].retirementstatus == 1)
                    {
                      retirementstatus = "<span class = 'badge badge-danger'>Resigned</span>";
                      optionRetirement = "<button class = 'btn btn-outline-warning btn-sm btn_reemployed' data-id = "+data[i].user_id+"><i class = 'fa fa-alarm'></i> Re-Employed ?</button>";
                    } 
                    if(data[i].retirementstatus == 0)
                    {
                      optionRetirement = "<button class = 'btn btn-outline-danger btn-sm btn_retired' data-id = "+data[i].user_id+"><i class = 'fa fa-alarm'></i> Resigned ?</button>";
                    } 
                    if(data[i].departmentname == "PPU HEAD" ||  (data[i].departmentname == "FINANCIAL DIVISION"))
                    {   
                      optionRetirement = "<span class = 'badge badge-info'>Admin</span>";
                      retirementstatus = "<span class = 'badge badge-warning'>Admin</span>";
                    }
                    row += "<tr>";
                    row += "<td>"+toTitleCase(data[i].name.toLowerCase())+"</td>";
                    row += "<td>"+data[i].username.toLowerCase()+"</td>";
                    row += "<td>"+data[i].departmentname+"</td>";
                    row += "<td>"+data[i].designation+"</td>";
                    row += "<td>"+data[i].email+"</td>";
                    row += "<td align = 'center'>"+retirementstatus+"</td>";
                    row +=  "<td style = 'text-align: center'>"+
                                "<button class = 'btn btn-outline-primary btn-sm edit' data-id = "+data[i].user_id+"><i class = 'fa fa-edit'></i> Edit</button>"+
                                optionRetirement+
                            "</td>";
                    row += "</tr>";
                  }
              }
              $("#tbl_Users tbody").html(row);
          },
      })
    }
    $("#btn_modal").on('click', function(e){
        e.preventDefault();
        $("#ajaxresponse").html("");
        $("#ajaxresponse").removeClass('alert alert-danger');
        $("#userform").trigger('reset');
        $("#designated_offices").val("");
        $("#designated_offices option:selected").text(" -- Please select designation here --");
        $("#departments").val("");
        $("#departments option:selected").text(" -- Please select department here --");
        $(".modal").modal({
          backdrop: 'static',
          keyboard: false,
        }, 'show');
        $('.modal-title').text('Add User ( Job Requestor / Admin / Manpower )');
    })
   
    $("body").on('click', '.btn_reemployed', function(e){
      e.preventDefault();
      var id = $(this).data('id');
      if(confirm("Are you sure you want to proceed this process?\nThis action cannot be undone!\n\nPlease confirm ok otherwise cancel"))
      $.ajax({
        type: 'post',
        url: '/change_retirementStatus',
        data: {
          type: 'reemployed',
          id: id, 
        },
        success: function(response)
        {
          if(response.status == 200)
          {
            alert(response.success);
            show_allData();
          }
          else
          {
            alert("Something went wrong!");
          } 
        }
      })
    })
    $("body").on('click', '.btn_retired', function(e){
      e.preventDefault();
      var id = $(this).data('id');
      if(confirm("Are you sure you want to proceed this process?\nThis action cannot be undone!\n\nPlease confirm ok otherwise cancel"))
      $.ajax({
        type: 'post',
        url: '/change_retirementStatus',
        data: {
          type: 'retired',
          id: id, 
        },
        success: function(response)
        {
          if(response.status == 200)
          {
            alert(response.success);
            show_allData();
          }
          else
          {
            alert("Something went wrong!");
          } 
        }
      })
    })
</script>
</body>
</html>
