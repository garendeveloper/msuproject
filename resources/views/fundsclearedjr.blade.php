
<!-- @if($userinfo[0]->departmentname == "PPU HEAD" || $userinfo[0]->departmentname == "PPU PERSONNEL")
  <SCRipt>
    alert("You do not have the authority to visit this page!")
    window.location.href = "/constructiontypes";
  </SCRipt>
  @endif -->
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
   <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{url('adminlte3/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="120" width="120">
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
            <a href="{{ url('/dashboard')}}" class = "btn btn-primary btn-sm"><i class = "fa fa-arrow-left"></i></a>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Awaiting For Funds Clearance</li>
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
              <div class="card-header" style = "background-color: #1C518A; color: white;">
                <div class="row">
                <div class="col-md-12">
                    <h6>Job Requests For Scheduling ({{$total}})</h6> 
                  </div>
                
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    <div class="col-md-4" style = "text-align: right">
                      <input class="form-control" id = "search" type="search" placeholder="Search Item Here.." aria-label="Search" style = "font-size:12px; ">
                    </div>
                </div>
                <br>
                <table id = "tbl_jobrequests" class="table table-bordered table-striped data-table" style = "table-layout: responsive ">
                  <thead style = "background-color: #1C518A; color: white;">
                  <tr>
                    <th>Job Request</th>
                    <th>Urgency Status</th>
                    <th style = "text-align: right">Requested By:</th>
                    <th>Designation</th>
                    <th>Date Cleared</th>
                    <th style = "text-align: center">Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $i =0; 
                    
                        for($i =0; $i<count($jobrequests); $i++)
                        { ?>
                            <tr>
                                <td>{{$jobrequests[$i]['construction_type']}}</td>
                                @if($jobrequests[$i]['urgentstatus'] == 1)
                                <td align = "center"><span class = "badge badge-warning">Urgent</span></td>
                                @endif
                                @if($jobrequests[$i]['urgentstatus'] == 0)
                                <td align = "center"><span class = "badge badge-primary">No</span></td>
                                @endif
                                <td align = "right">{{$jobrequests[$i]['name']}}</td>
                                <td>{{$jobrequests[$i]['designation']}}</td>
                                <td>{{$jobrequests[$i]['dateCleared']}}</td>
                                <td align = "center">

                                <?php 
                                    $jobrequest_id = $jobrequests[$i]['id'];
                                    $schedule = DB::select('select jobrequestschedules.* 
                                                                from jobrequestschedules
                                                                where jobrequestschedules.jobrequest_id = "'.$jobrequest_id.'"');
                                    
                                    

                                ?>
                                @if($schedule[0]->status == 1)
                                  <a href="{{url('/schedulejobrequests/'.$jobrequests[$i]['id'])}}" class="btn btn-primary btn-sm disabled"><i class="fa fa-calendar"></i>&nbsp; Completed</a>
                                @endif
                                @if($schedule[0]->status == 0 || empty($schedule))
                                  <a href="{{url('/schedulejobrequests/'.$jobrequests[$i]['id'])}}" class="btn btn-primary btn-sm"><i class="fa fa-calendar"></i>&nbsp; Schedule </a>
                                @endif
                                </td>
                            </tr>
                        <?php }?>
                  </tbody>
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
  <div class="modal fade openmodal" id="modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style = "background-color: #1C518A; color: white;">
              <h4 class="modal-title" id = "c_modaltitle" >Add Construction (SOW ) </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <ul id = "ajaxresponse">

            </ul>
            <form id = "form" action="" method = "post">
              <div class="modal-body">
                @csrf
                <input type="hidden" value = "" id = "id" name = "id">
               
                <div class="form-group">
                  <label for="constructiontype_id">Construction Type</label>
                  <select class ="form-control" name="constructiontype_id" id="constructiontype_id">
                    <option value="">--Select Item -- </option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="construction">Scope of Work</label>
                  <input type="text" name = "construction_name" id= "construction_name" class = "form-control">
                </div>

              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id = "save">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
    $("#search").on('keyup', function(){
      var value = $(this).val().toLowerCase();
      $("#tbl_jobrequests tbody tr").filter(function(){
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>
<script>
  $(document).ready(function(e){
    show_allData();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    function toTitleCase(str) {
        return str.replace(/(?:^|\s)\w/g, function(match) {
            return match.toUpperCase();
        });
    }
    $("body").on('click', '.fundsCleared', function(){
      var id = $(this).data('id');

      if(confirm("Are you sure you want to proceed this Job Request for Funds Clearance?\n\nThis action cannot be undone!\nPress OK Otherwise."))
      $.ajax({
        type: 'get',
        url: '/fundsclearance/'+id,
        dataType: 'json',
        success:function(response){
          if(response.status == 200)
          {
            Toast.fire({
              icon: 'success',
              title: response.success
            })
          }
          else{
            alert("Something went wrong, Please reload your page!");
          }
        }
       
      })
      show_allData();
    })
    function show_allData(){
      $.ajax({
        type: 'GET',
        url: '/get_allconstructiontypes_unapproved',
        dataType: 'json',
        success: function(data){
          var html = "";
          for(var i = 0; i<data.length; i++)
          {
            var urgentstatus = "";
            var status = "<span class = 'badge badge-warning'>Still Process</span>";
            if(data[i].status == 1)  status = "<span class = 'badge badge-success'>Approved</span>";
            if(data[i].urgentstatus == 1) urgentstatus = "<span class = 'badge badge-danger'>Urgent</span>";
        
            html += "<tr style = 'text-align:left'>";
            html += "<td>"+toTitleCase(data[i].construction_type.toLowerCase())+" "+urgentstatus+"</td>";
            html += "<td align = 'right'>"+toTitleCase(data[i].name.toLowerCase())+"</td>";
            html += "<td>"+toTitleCase(data[i].designation.toLowerCase())+"</td>";
            html += "<td>"+status+"</td>";
            html += "<td>"+data[i].dateRequested+"</td>";
            if(data[i].status == 1)
            {
              if(data[i].fundstatus == 1)
              {
                html += '<td align = "center"> '+
                        '<a style = "font-size: 10px" class = "btn btn-sm btn-success fundsCleared disabled" data-constructiontype = "'+data[i].construction_type+'" data-id = "'+data[i].id+'" ><i class = "fa fa-certificate"></i>&nbsp; Funds Cleared</a>';
                     '</td>';
              }
              else
              {
                html += '<td align = "center"> '+
                        '<a style = "font-size: 10px" class = "btn btn-sm btn-success fundsCleared" data-constructiontype = "'+data[i].construction_type+'" data-id = "'+data[i].id+'" ><i class = "fa fa-certificate"></i>&nbsp; Funds Cleared</a>';
                     '</td>';
              }
            }
            else
            {
              html += '<td align = "center"> '+
                        '<a style = "font-size: 10px" class = "btn btn-sm btn-warning approveRequest" data-constructiontype = "'+data[i].construction_type+'" data-id = "'+data[i].id+'" ><i class = "fa fa-check-square"></i>&nbsp; Approve</a>';
                     '</td>';
            }
            html += "</tr>";
          }
         
          $("#tbl_constructiontypes tbody").html(html);
         
        },
        error: function(response){
          alert("Something went wrong in fetching data in database.");
        }
      });
    }
    $("body").on('click', '.approveRequest', function(response){
        var id = $(this).data('id');
        if(confirm("Do you want to approve this job request?\nThis action cannot be undone!\n\n\nPress OK Otherwise Cancel"))
        {
          $.ajax({
            type: 'post',
            url: '/approve_jobRequest/'+id,
            dataType: 'json',
            success: function(response)
            {
              if(response.status == 200)
              {
                Toast.fire({
                  icon: 'success',
                  title: response.success
                })
              }
              else 
              {
                alert(response.error_msg);
              }
              show_allData();
            }
          })
        }
    })
  })
</script>
</body>
</html>
