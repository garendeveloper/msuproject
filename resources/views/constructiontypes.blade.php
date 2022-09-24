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
            <h1>Constructions/Repair/Improvements</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/constructions') }}">Constructions</a> </li>
              <li class="breadcrumb-item active">Constructions/Repair/Improvements</li>
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
                  <button class = "btn btn-outline-primary btn-sm" id = "btn_addconstructiontype" type = "button" align = "left"><i class = "fa fa-plus"></i> Add Construction Type</button>
                  <a  href="{{ url('/constructions') }}" class = "btn btn-outline-primary btn-sm"  align = "right"><i class = "fa fa-arrow-right"></i> View Scope of Works</a>
                  </div>
                  <div class="col-md-6">
                    <input class="form-control" id = "search" type="search" placeholder="Search Item Here.." aria-label="Search">
                  </div>
                </div>
              </div>
              <!-- /.card-header -->

              <div class="card-body">
                <table id="tbl_constructiontypes" class="table table-bordered table-striped" style = "table-layout: absolute">
                  <thead style = "background-color: #1C518A; color: white;">
                  <tr>
                    <th>ID</th>
                    <th>Constructions/Repair/Improvement</th>
                    <th>Status</th>
                    <th>Date Created</th>
                    <th>Date Updated</th>
                    <th style = "text-align: center">Actions</th>
                  </tr>
                  </thead>
                  <tbody id = "tbody_constructiontypes">

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
    </div>
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
    $("#search").on('keyup', function(){
      var value = $(this).val().toLowerCase();
      $("#tbl_constructiontypes tbody tr").filter(function(){
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>
<script type = "text/javascript">

 $(document).ready(function(){
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
            var status = "<span class = 'badge badge-warning'>Still process</span>";
            if(data[i].status == 1) status = "<span class = 'badge badge-success'>Approved</span>";
            
            html += "<tr style = 'text-align:center'>";
            html += "<td>"+data[i].id+"</td>";
            html += "<td>"+toTitleCase(data[i].construction_type)+"</td>";
            html += "<td>"+status+"</td>";
            html += "<td >"+data[i].created_at+"</td>";
            html += "<td>"+data[i].updated_at+"</td>";
            html += '<td align = "center"> '+
                        // '<a class = "btn btn-sm btn-warning addconstruction" data-constructiontype = "'+data[i].construction_type+'" data-id = "'+data[i].id+'" ><i class = "fa fa-plus"></i> Scope Of Work</a>'+ 
                        '<a class = "btn btn-sm btn-outline-primary edit" data-id = "'+data[i].id+'" ><i class = "fa fa-edit"></i> </a>'+ 
                        '<a class = "btn btn-sm btn-outline-danger remove" data-id = "'+data[i].id+'" ><i class = "fa fa-trash"></i> </a>'+ 
                        // '<a class = "btn btn-sm btn-outline-warning show_allconstructions" data-id = "'+data[i].id+'" ><i class = "fa fa-arrow-right"></i> Show Constructions</a>'+ 
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
  })
</script>
</body>
</html>
