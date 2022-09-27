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
                <table id="tbl_Users" style = "table-layout: absolute; width: 100%;  border: 1px solid black;" class="table table-bordered table-striped">
                  <thead style = "background-color: #1C518A;color: white; ">
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Retirement Status</th>
                    <th>Date Created</th>
                    <th>Date Updated</th>
                   
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
          <!-- <div class="overlay">
              <i class="fas fa-2x fa-sync fa-spin"></i>
          </div> -->
          <div class="modal-header bg-dark">
            <h4 class="modal-title">User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <ul id = "ajaxresponse">

          </ul>
          <form id = "form" action="" method = "post">
            <div class="modal-body">
              @csrf
              <input type="text" style = "display: none" name = "id" id = "id" value = "">
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="construction">Fullname</label>
                        <input type="text" name = "fullname" id= "fullname" class = "form-control" autofocus>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="construction">Username</label>
                        <input type="text" name = "username" id= "username" class = "form-control" autofocus>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="construction">Email</label>
                        <input type="email" name = "email" id= "email" class = "form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="construction">Department</label>
                        <input autocomplete = "off" type="deparment" list = "departments" name = "department" id= "department" class = "form-control" autofocus>

                        <datalist id = "departments">

                        </datalist>
                    </div>
                </div>
                <span style = "color: blue"><i> Note: Upon adding of user. <br>His default password will be his username.</i></span>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-primary btn-block" id = "save"><i class = "fa fa-save"></i> Save</button>
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
                else{
                    for(var i = 0; i<data.length; i++){
                      var retirementstatus = "<span class = 'badge badge-success'>Employee</span>";
                      var optionRetirement = "<button class = 'btn btn-outline-success btn-sm btn_retired' data-id = "+data[i].user_id+"><i class = 'fa fa-alarm'></i> Resigned ?</button>";
                      if(data[i].retirementstatus == 1)
                      {
                        retirementstatus = "<span class = 'badge badge-danger'>Resigned</span>";
                        optionRetirement = "<button class = 'btn btn-outline-warning btn-sm btn_reemployed' data-id = "+data[i].user_id+"><i class = 'fa fa-alarm'></i> Re-Employed ?</button>";
                      } 
                      row += "<tr>";
                      row += "<td>"+data[i].id+"</td>";
                      row += "<td>"+data[i].name+"</td>";
                      row += "<td>"+data[i].username+"</td>";
                      row += "<td>"+data[i].email+"</td>";
                      row += "<td align = 'center'>"+retirementstatus+"</td>";
                      row += "<td style = 'font-size: 10px'>"+new Date(data[i].created_at)+"</td>";
                      row += "<td style = 'font-size: 10px'>"+new Date(data[i].updated_at)+"</td>";
                      row +=  "<td style = 'text-align: center'>"+
                                  "<button class = 'btn btn-outline-primary btn-sm edit' data-id = "+data[i].user_id+"><i class = 'fa fa-edit'></i> Edit</button>"+
                                  optionRetirement+
                              "</td>";
                      row += "</tr>";
                    }
                }
                $("table tbody").html(row);
            },
        })
    }
    $("#btn_modal").on('click', function(e){
        e.preventDefault();
        $("form").trigger('reset');
        $(".modal").modal({
          backdrop: 'static',
          keyboard: false,
        }, 'show');
        $('.modal-title').text('Add User');

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
