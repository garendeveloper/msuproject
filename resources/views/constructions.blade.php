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
    <!-- Content Header (Page header) -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="adminlte3/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="500" width="500">
    </div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Constructions (Scope of Work) && (Estimation of Cost)</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/ConstructionTypes') }}">Construction Types</a> </li>
              <li class="breadcrumb-item active">Constructions</li>
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
                  <div class="col-md-6">
                    <button class = "btn btn-outline-primary btn-sm" id = "btn_openmodal" type = "button"><i class = "fa fa-plus"></i> Add Construction (SOW )</button>
                    <a  href="{{ url('/constructiontypes') }}" class = "btn btn-outline-primary btn-sm"  align = "right"><i class = "fa fa-arrow-left"></i> Back</a>
                  </div>
                  <div class="col-md-6">
                    <input class="form-control" id = "search" type="search" placeholder="Search Item Here.." aria-label="Search">
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="data-table" class="table table-bordered table-striped data-table" style = "table-layout: absolute; ">
                  <thead style = "background-color: #1C518A; color: white;">
                  <tr>
                    <th>Constructions/Repair/Improvements</th>
                    <th>Scope of work</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                
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
  <div class="modal fade openmodal" id="modal">
    <div class="modal-dialog modal-lg">
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
            <button type="submit" class="btn btn-primary btn-block" id = "save"><i class = "fa fa-save"></i> Save</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

      <div class="modal fade emc_modal" id="modal-xl">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header bg-success" >
              <div class="row">
                <div class="col-md-12">
                <h5 class = "modal-title" id = "constructiontype_title"></h5>
                </div>
                <div class="col-md-12">
                  <h9 class="modal-title" id = "description_modaltitle"></h9>
                </div>
              </div>
             
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <ul id = "ecm_ajaxresponse"></ul>
            <form action="" method="post" id = "ecm_form">
              @csrf
              <input type="hidden" id = "ecm_construction_id" class = "form-control ecm_construction_id" name = "construction_id">
              <input type="hidden" name = "alphabethical" value = "A">
              <input type="hidden" name = "emc_id" id = "emc_id">
              <div class="modal-body">
                  <div class="row">
                    <div class="col-md-2">
                      <label for="unit">Unit</label>
                      <input type="text" id = "unit" name = "unit" class = "form-control" style = "text-align: right" autocomplete = "off" required>
                    </div>
                    <div class="col-md-4">
                      <label for="description">Description</label>
                      <textarea name="description" id="description" cols="30" rows="3" class = "form-control" required></textarea>
                    </div>
                    <div class="col-md-2">
                      <label for="unitcost">Unit Cost</label>
                      <input type="number" id = "unitcost" name = "unitcost" autocomplete = "off" step = "1" style = "text-align: right" class = "form-control" required>
                    </div>
                    <div class="col-md-2">
                      <label for="quantity">Quantity</label>
                      <input type="number" id = "quantity" name = "quantity" class = "form-control" style = "text-align: right" autocomplete = "off" required>
                    </div> 
                    <div class="col-md-2">
                      <label for="amount">Amount</label>
                      <input type="number" value = "0" id = "amount" name = "amount" autocomplete = "off" step = "1" style = "text-align: right" class = "form-control" readonly>
                    </div>
                  </div>
                  <input type="submit" style = "display: none">
                  <br>
                  <div class="row"></div>
                  <div class="col-md-12">
                    <table id = "tbl_ecm" class="table table-bordered table-striped" style = "table-layout: fixed; ">
                      <thead class = "bg-success">
                      <tr>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>Description</th>
                        <th>Unit Cost</th>
                        <th>Amount</th>
                        <th>Actions</th>
                      </tr>
                      </thead>
                      <tbody>
                    
                      </tbody>
                      <tfoot>
                    
                      </tfoot>
                    </table>
                  </div>
              </div>
              <div class="modal-footer ">
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <div class="modal fade estimation_selection_modal" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <!-- <div class="overlay">
                <i class="fas fa-2x fa-sync fa-spin"></i>
            </div> -->
            <div class="modal-header" style = "background-color: #1C518A; color: white;">
              <h4 class="modal-title" id = "e_modaltitle" > SELECT ITEM FOR THE ESTIMATION </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          
              <div class="modal-body">
                @csrf
                <input type="hidden"  id = "selection_construction_id">
                <div class="row">
                    <div class="col-md-4">
                      <a class = "btn btn-app bg-success" id = "btn_materialcost" style = "width: 200px; font-size: 16px; height: 80px"><i class = "fa fa-building"></i> Material Cost</a>
                    </div>
                    <div class="col-md-4">
                      <a class = "btn btn-app bg-warning" id = "btn_equipmentcost" style = "width: 200px; font-size: 16px; height: 80px" ><i class = "fa fa-building"></i> Equipment Cost</a>
                    </div>
                    <div class="col-md-4">
                      <a class = "btn btn-app bg-primary" id = "btn_rentalcost" style = "width: 200px; font-size: 16px; height: 80px"><i class = "fa fa-building"></i> Rental Cost</a>
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

      
      <div class="modal fade eec_modal" id="modal-xl">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header bg-warning">
              <div class="row">
                <div class="col-md-12">
                <h5 class = "modal-title" id = "eec_title"></h5>
                </div>
                <div class="col-md-12">
                  <h9 class="modal-title" id = "eec_description_modaltitle"></h9>
                </div>
              </div>
             
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <ul id = "eec_ajaxresponse"></ul>
            <form action="" method="post" id = "eec_form">
              @csrf
              <input type="text" style = "display: none" id = "eec_construction_id" class = "form-control" name = "construction_id">
              <input type="text" style = "display: none" name = "eec_id" id = "eec_id">
              <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <label for="manpower">Equipment</label>
                      <input type="text" id = "equipment" name = "equipment" class = "form-control" style = "text-align: right" autocomplete = "off" required>
                    </div>

                    <div class="col-md-2">
                      <label for="no_ofpersons">No.</label>
                      <input type="number" class = "form-control" id = "no_ofpersons" name = "no_ofpersons" style = "text-align: right" autocomplete = "off"  required>
                    </div>
                    <div class="col-md-2">
                      <label for="no_ofheaddays">No. Of Days</label>
                      <input type="number" class = "form-control" id = "no_ofheaddays" name = "no_ofheaddays" style = "text-align: right" autocomplete = "off"  required>
                    </div>
                    <div class="col-md-2">
                      <label for="totalDays">Total Days</label>
                      <input type="number" class = "form-control" id = "no_mandays" name = "no_mandays" style = "text-align: right" autocomplete = "off"  readonly required>
                    </div>
                    <div class="col-md-2">
                      <label for="daily_rate">Rate/Day</label>
                      <input type="number" class = "form-control" id = "daily_rate" name = "daily_rate" style = "text-align: right" autocomplete = "off"  required>
                    </div>
                    <div class="col-md-4">
                      <label for="amount">Amount</label>
                      <input type="number" class = "form-control" id = "total_amount" name = "amount" style = "text-align: right" autocomplete = "off"  readonly required>
                    </div>
                  </div>
                  <input type="submit" style = "display: none">
                  <br>
                  <div class="row"></div>
                  <div class="col-md-12">
                    <table id = "tbl_eec" class="table table-bordered table-striped" style = "table-layout: fixed; ">
                      <thead class = "bg-warning">
                      <tr>
                        <th>Equipments</th>
                        <th>No.</th>
                        <th>No. of Days</th>
                        <th>Total Days</th>
                        <th>Rate/Day</th>
                        <th>Amount</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                      </tr>
                      </thead>
                      <tbody>
                    
                      </tbody>
                      <tfoot>
                    
                      </tfoot>
                    </table>
                  </div>
              </div>
              <div class="modal-footer ">
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <!-- ESTIMATED LABOR COSTS -->
      <div class="modal fade elc_modal" id="modal-xl">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header" style = "background-color: #1C518A; color: white;">
              <div class="row">
                <div class="col-md-12">
                <h5 class = "modal-title" id = "elc_title"></h5>
                </div>
                <div class="col-md-12">
                  <h9 class="modal-title" id = "elc_description_modaltitle"></h9>
                </div>
              </div>
             
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <ul id = "elc_ajaxresponse"></ul>
            <form action="" method="post" id = "elc_form">
              @csrf
              <input type="text" style = "display: none" id = "elc_construction_id" class = "form-control" name = "construction_id">
              <input type="text" style = "display: none" name = "elc_id" id = "elc_id">
              <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <label for="manpower">Manpower</label>
                      <input type="text" id = "manpower" list = "manpowers" name = "manpower" class = "form-control" style = "text-align: right" autocomplete = "off" required>
                      <datalist id = "manpowers">
                      </datalist>
                    </div>
                    <div class="col-md-2">
                      <label for="no_ofpersons">No.</label>
                      <input type="number" class = "form-control" id = "elc_no_ofpersons" name = "no_ofpersons" style = "text-align: right" autocomplete = "off"  required>
                    </div>
                    <div class="col-md-2">
                      <label for="no_ofheaddays">No. Of Days</label>
                      <input type="number" class = "form-control" id = "elc_no_ofheaddays" name = "no_ofheaddays" style = "text-align: right" autocomplete = "off"  required>
                    </div>
                    <div class="col-md-2">
                      <label for="totalDays">Man Days</label>
                      <input type="number" class = "form-control" id = "elc_no_mandays" name = "no_mandays" style = "text-align: right" autocomplete = "off"  readonly required>
                    </div>
                    <div class="col-md-2">
                      <label for="daily_rate">Rate/Day</label>
                      <input type="number" class = "form-control" id = "elc_daily_rate" name = "daily_rate" style = "text-align: right" autocomplete = "off"  required>
                    </div>
                    <div class="col-md-4">
                      <label for="amount">Amount</label>
                      <input type="number" class = "form-control" id = "elc_total_amount" name = "amount" style = "text-align: right" autocomplete = "off"  readonly required>
                    </div>
                  </div>
                  <input type="submit" style = "display: none">
                  <br>
                  <div class="row"></div>
                  <div class="col-md-12">
                    <table id = "tbl_elc" class="table table-bordered table-striped" style = "table-layout: fixed; ">
                      <thead style = "background-color: #1C518A; color: white;">
                      <tr>
                        <th>Manpower</th>
                        <th>No.</th>
                        <th>No. of Days</th>
                        <th>Man Days</th>
                        <th>Rate/Day</th>
                        <th>Amount</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                      </tr>
                      </thead>
                      <tbody>
                    
                      </tbody>
                      <tfoot>
                    
                      </tfoot>
                    </table>
                  </div>
              </div>
              <div class="modal-footer ">
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
      $("#data-table tbody tr").filter(function(){
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>
<script>
  $(document).ready(function(e){
    show_allData();
    show_allConstructionTypes();
    show_allDepartments();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
    $("body").on('click', '.ecm_edit', function(e)
    {
      e.preventDefault();
      var id = $(this).data('id');
      $.ajax({
        type: 'GET',
        url: '/show_emcdata/'+id,
        dataType: 'json',
        success:  function(response)
        {
          $("#quantity").val(response.quantity);
          $("#unit").val(response.unit);
          $("#description").val(response.description);
          $("#unitcost").val(response.unitcost);
          $("#amount").val(response.amount);
          $("#emc_id").val(response.id);
        },
        error:  function(response)
        {
          console.log("Server Error");
        }
      })
    })
    $("body").on('click', '.ecm_remove', function(e){
      e.preventDefault();
      $("#ecm_form").trigger('reset');
      var emc_id = $(this).data('id');
      if(confirm('Do you want to remove this item?'))
      {
        $.ajax({
          type: 'POST',
          url: '/ecm_add',
          data: {
            remove_emc_id: emc_id,
          },
          success: function(response)
          {
            if(response.status == 200)
            {
              alert("Item successfully removed!");
            }
            show_allECM();
          },
          error:  function(error){
            console.log("Server Error.");
          }
        })
      }
    })
    function show_allECM()
    {
      var construction_id = $(".ecm_construction_id").val();
      
      $.ajax({
        type: 'GET',
        url: '/show_allecm/'+construction_id,
        dataType: 'json',
        success:  function(data){
          var row = "";
          if(data.length > 0 ){
            for(var i = 0; i<data.length; i++)
            {
              row += "<tr>";
              row += "<td>"+data[i].quantity+"</td>";
              row += "<td>"+data[i].unit+"</td>";
              row += "<td>"+data[i].description+"</td>";
              row += "<td>"+data[i].unitcost+"</td>";
              row += "<td>"+data[i].amount+"</td>";
              row += "<td align = 'center'>"+
                        "<button class = 'btn btn-outline-primary btn-flat btn-sm ecm_edit' data-id = "+data[i].emc_id+"><i class = 'fa fa-edit'></i></button>"+
                        "<button class = 'btn btn-outline-danger btn-flat btn-sm ecm_remove' data-id = "+data[i].emc_id+"><i class = 'fa fa-trash'></i></button>"+
                    "</td>"; 
              row += "</tr>";
            }
          }
          else{
            row += "<tr> -- No data available -- </tr>";
          }
          $("#tbl_ecm tbody").html(row);
        },
        error:  function(e){
          console.log("Server Error");
        }
      })
    }
    $("#ecm_close").on('click', function(){
      $("#ecm_form").trigger('reset');
      $("#ecm_modal").modal('hide');
    })
    $("#no_ofheaddays").on('keyup', function(e){
      e.preventDefault();

      var no_headdays = $(this).val();
      var no_ofpersons = $("#no_ofpersons").val()*1;
      $("#no_mandays").val(no_headdays*no_ofpersons);
    })
    $("#elc_no_ofheaddays").on('keyup', function(e){
      e.preventDefault();

      var no_headdays = $(this).val();
      var no_ofpersons = $("#elc_no_ofpersons").val()*1;
      $("#elc_no_mandays").val(no_headdays*no_ofpersons);
    })
    $("#elc_daily_rate").on('keyup', function(e){
      e.preventDefault();

      var daily_rate = $(this).val();
      var totalDays = $("#elc_no_mandays").val()*1;
      $("#elc_total_amount").val(daily_rate*totalDays);
    })
    $("#daily_rate").on('keyup', function(e){
      e.preventDefault();

      var daily_rate = $(this).val();
      var totalDays = $("#no_mandays").val()*1;
      $("#total_amount").val(daily_rate*totalDays);
    })
    $("#eec_form").on('submit', function(e){
      e.preventDefault();

      $.ajax({
        type: 'POST',
        url: '/eec_actions',
        data: $(this).serializeArray(),
        dataType: 'json',
        success:  function(response){
          if(response.status == 400){
            $("#eec_ajaxresponse").html("");
            $("#eec_ajaxresponse").removeClass('alert alert-danger');
            $("#eec_ajaxresponse").addClass('alert alert-danger');
            $.each(response.errors, function (key, err_values){
              $("#eec_ajaxresponse").append('<li>'+err_values+'</li>');
            });
          }
          if(response.status == 200){
            alert(response.success);
            $("#eec_form").trigger('reset');
            var id = $("#selection_construction_id").val();
            $("#eec_construction_id").val(id);
          }
          if(response.status == 401){
            alert(response.fail);
          }
          show_allEquipments();
        }
      })
    })
    $("#elc_form").on('submit', function(e){
      e.preventDefault();

      $.ajax({
        type: 'POST',
        url: '/elc_actions',
        data: $(this).serializeArray(),
        dataType: 'json',
        success:  function(response){
          if(response.status == 400){
            $("#elc_ajaxresponse").html("");
            $("#elc_ajaxresponse").removeClass('alert alert-danger');
            $("#elc_ajaxresponse").addClass('alert alert-danger');
            $.each(response.errors, function (key, err_values){
              $("#elc_ajaxresponse").append('<li>'+err_values+'</li>');
            });
          }
          if(response.status == 200){
            alert(response.success);
            $("#elc_form").trigger('reset');
            var id = $("#selection_construction_id").val();
            $("#elc_construction_id").val(id);
          }
          if(response.status == 401){
            alert(response.fail);
          }
          show_allLaborCosts();
        }
      })
    })
    $("#ecm_form").on('submit', function(e){
      e.preventDefault();

      $.ajax({
        type: 'POST',
        url: '/ecm_add',
        data: $(this).serializeArray(),
        dataType: 'json',
        success:  function(response){
          if(response.status == 400){
            $("#ecm_ajaxresponse").html("");
            $("#ecm_ajaxresponse").removeClass('alert alert-danger');
            $("#ecm_ajaxresponse").addClass('alert alert-danger');
            $.each(response.errors, function (key, err_values){
              $("#ecm_ajaxresponse").append('<li>'+err_values+'</li>');
            });
          }
          if(response.status == 200){
            alert(response.success);
            $("#ecm_modal").modal('hide');
            $("#ecm_form").trigger('reset');
            $("#emc_id").val("");
            var id = $("#selection_construction_id").val();
            $("#ecm_construction_id").val(id);
          }
          show_allECM();
        }
      })
    })
    $("#quantity").on('keyup', function(e){
      var quantity = $("#quantity").val();
      var unitcost = $("#unitcost").val();
      $("#amount").val(quantity*unitcost);
    })
    function show_allConstructionTypes()
    {
      $.ajax({
        type: 'GET',
        url: '/get_allconstructiontypes',
        dataType: 'json',
        success: function(data)
        {
          var option = "";
          option += "<option value = ''> -- Select Item -- </option>";
          for(var i = 0; i<data.length; i++)
          {
            option += "<option value = "+data[i].id+">"+data[i].construction_type+"</option>";
          }
          $("#constructiontype_id").html(option);
        },
        error:  function(data)
        {
          alert('Something went wrong!\nPlease reload your page.')
        }
      })
    }
    $("body").on('click', '.btn_emc', function(e){
      var id = $(this).data('id');
      $(".ecm_construction_id").val(id);
      $("#selection_construction_id").val(id);
      $.ajax({
        type: 'GET',
        url: '/show_construction/'+id,
        dataType: 'json',
        success:  function(response)
        {
          $("#constructiontype_title").text(response[0].construction_type.toUpperCase());
          $("#description_modaltitle").text(response[0].construction_name+" ( ESTIMATION OF MATERIAL COST )");
          show_allECM();
        },
        error: function(e){
          alert("Something went wrong in fetching data in database.")
        }
      })

      $(".estimation_selection_modal").modal({
            backdrop: 'static',
            keyboard: false,
        }, 'show');
    })
    $("body").on('click', '.eec_remove', function(e){
      var id = $(this).data('id');

      if(confirm("Are you sure do you want to delete this item?"))
      {
        $.ajax({
          type: 'post',
          url: '/eec_actions',
          data: {
            remove: id
          },
          dataType: 'json',
          success: function(response)
          {
            if(response.status == 200) alert(response.success);
            show_allEquipments();
          }
        })
      }
    })
    $("body").on('click', '.elc_remove', function(e){
      var id = $(this).data('id');

      if(confirm("Are you sure do you want to delete this item?"))
      {
        $.ajax({
          type: 'post',
          url: '/elc_actions',
          data: {
            remove: id
          },
          dataType: 'json',
          success: function(response)
          {
            if(response.status == 200) alert(response.success);
            show_allLaborCosts();
          }
        })
      }
    })
    $("body").on('click', '.eec_edit', function(e){
      e.preventDefault();
      var eec_id = $(this).data('id');
      $.ajax({
        type: 'GET',
        url: '/get_equipmentData/'+eec_id,
        dataType: 'json',
        success: function(response)
        {
          $("#eec_id").val(response[0].id);
          $("#equipment").val(response[0].equipment);
          $("#no_ofpersons").val(response[0].no_ofpersons);
          $("#no_ofheaddays").val(response[0].no_ofheaddays);
          $("#no_mandays").val(response[0].no_mandays);
          $("#daily_rate").val(response[0].daily_rate);
          $("#total_amount").val(response[0].amount);
        },
        error: function(response){ alert("Something went wrong! Please reload your page")}
      })
    })
    $("body").on('click', '.elc_edit', function(e){
      e.preventDefault();
      var elc_id = $(this).data('id');
      $.ajax({
        type: 'GET',
        url: '/get_laborData/'+elc_id,
        dataType: 'json',
        success: function(response)
        {
          $("#elc_id").val(response.id);
          $("#manpower").val(response.manpower);
          $("#elc_no_ofpersons").val(response.no_ofpersons);
          $("#elc_no_ofheaddays").val(response.no_ofheaddays);
          $("#elc_no_mandays").val(response.no_mandays);
          $("#elc_daily_rate").val(response.daily_rate);
          $("#elc_total_amount").val(response.amount);
        },
        error: function(response){ alert("Something went wrong! Please reload your page")}
      })
    })
    //estimation cost modals
    $("#btn_equipmentcost").on('click', function(e){
      $("#eec_ajaxresponse").html("");
      $("#eec_ajaxresponse").removeClass('alert alert-danger');
      $("#eec_form").trigger('reset');

      $(".estimation_selection_modal").modal('hide');
      var id = $("#selection_construction_id").val();
      $("#eec_construction_id").val(id);
      $.ajax({
        type: 'GET',
        url: '/show_construction/'+id,
        dataType: 'json',
        success:  function(response)
        {
          $("#eec_title").text(response[0].construction_type.toUpperCase());
          $("#eec_description_modaltitle").text(response[0].construction_name+" ( ESTIMATION OF EQUIPMENT COST )");
          show_allEquipments();
        }
      })

      $(".eec_modal").modal({
            backdrop: 'static',
            keyboard: false,
        }, 'show');
    })
    $("#btn_materialcost").on('click', function(e)
    {
      $(".estimation_selection_modal").modal('hide');
      $(".emc_modal").modal({
            backdrop: 'static',
            keyboard: false,
        }, 'show');
    })
    $("#btn_rentalcost").on('click', function(e)
    {
      $("#elc_ajaxresponse").html("");
      $("#elc_ajaxresponse").removeClass('alert alert-danger');
      $("#elc_form").trigger('reset');

      $(".estimation_selection_modal").modal('hide');
      var id = $("#selection_construction_id").val();
      $("#eec_construction_id").val(id);
      $("#elc_construction_id").val(id);
      $.ajax({
        type: 'GET',
        url: '/show_construction/'+id,
        dataType: 'json',
        success:  function(response)
        {
          $("#elc_title").text(response[0].construction_type.toUpperCase());
          $("#elc_description_modaltitle").text(response[0].construction_name+" ( ESTIMATION OF LABOR COST )");
          show_allLaborCosts();
        }
      })

      $(".elc_modal").modal({
            backdrop: 'static',
            keyboard: false,
        }, 'show');
    })
    $("#manpower").on('input', function(e){
      e.preventDefault();
      var id = $(this).val();
      $.ajax({
        type: 'get',
        url: '/count_allLaborers/'+id,
        dataType: 'json',
        success: function(data)
        {
          $("#elc_no_ofpersons").val(data[0].total);
        },
        error: function(response)
        {
          alert("Server error: Unmatch item in database")
        }
      })
    })
    function show_allDepartments()
    {
      $.ajax({
        type: 'get',
        url: '/get_allDepartments',
        dataType: 'json',
        success: function(data)
        {
          var option = "";
          for(var i = 0; i<data.length; i++)
          {
            option += "<option>"+data[i].departmentname+"<option>";
          }
          $("#manpowers").html(option);
        }
      })
    }
    function show_allLaborCosts()
    {
      var construction_id = $("#selection_construction_id").val();
      $.ajax({
        type: 'GET',
        url: '/get_allLaborCosts/'+construction_id,
        dataType: 'json',
        success:  function (data)
        {
          var row = "";
          for(var i = 0; i<data.length; i++)
          {
            row += '<tr>';
            row += '<td>'+data[i].manpower+'</td>';
            row += '<td>'+data[i].no_ofpersons+'</td>';
            row += '<td>'+data[i].no_ofheaddays+'</td>';
            row += '<td>'+data[i].no_mandays+'</td>';
            row += '<td>'+data[i].daily_rate+'</td>';
            row += '<td>'+data[i].amount+'</td>';
            row += '<td style = "font-size: 10px">'+data[i].created_at+'</td>';
            row += '<td style = "font-size: 10px">'+data[i].updated_at+'</td>';
            row += '<td align = "center">';
            row += '<a class = "btn btn-outline-primary btn-sm elc_edit" data-id = '+data[i].id+'><i class = "fa fa-edit"></i> </a>';
            row += '<a class = "btn btn-outline-danger btn-sm elc_remove" data-id = '+data[i].id+'><i class = "fa fa-trash"></i> </a>';
            row += '</td>';
            row += '</tr>';
          }
          $("#tbl_elc tbody").html(row);
        },
        error: function (data)
        {
          alert('Something went wrong! Please reload the page.');
        }
      })

    }
    function show_allEquipments() 
    {
      var id = $("#selection_construction_id").val();
      $.ajax({
        type: 'GET',
        url: '/get_allEquipments/'+id,
        dataType: 'json',
        success:  function (data)
        {
          var row = "";
          for(var i = 0; i<data.length; i++)
          {
            row += '<tr>';
            row += '<td>'+data[i].equipment+'</td>';
            row += '<td>'+data[i].no_ofpersons+'</td>';
            row += '<td>'+data[i].no_ofheaddays+'</td>';
            row += '<td>'+data[i].no_mandays+'</td>';
            row += '<td>'+data[i].daily_rate+'</td>';
            row += '<td>'+data[i].amount+'</td>';
            row += '<td style = "font-size: 10px">'+data[i].created_at+'</td>';
            row += '<td style = "font-size: 10px">'+data[i].updated_at+'</td>';
            row += '<td align = "center">';
            row += '<a class = "btn btn-outline-primary btn-sm eec_edit" data-id = '+data[i].id+'><i class = "fa fa-edit"></i> </a>';
            row += '<a class = "btn btn-outline-danger btn-sm eec_remove" data-id = '+data[i].id+'><i class = "fa fa-trash"></i> </a>';
            row += '</td>';
            row += '</tr>';
          }
          $("#tbl_eec tbody").html(row);
        },
        error: function (data)
        {
          alert('Something went wrong! Please reload the page.');
        }
      })
    }
    function toTitleCase(str) {
        return str.replace(/(?:^|\s)\w/g, function(match) {
            return match.toUpperCase();
        });
    }
    function show_allData()
    {
      $.ajax({
        type: 'GET',
        url: '/get_allconstructions',
        dataType: 'json',
        success:  function (data)
        {
          var row = "";
          for(var i = 0; i<data.length; i++)
          {
            var status = "<span class = 'badge badge-warning'>Pending</span>";
            if(data[i].status == 1) status = '<a class = "btn btn-outline-dark  btn-sm btn_emc" data-id = '+data[i].construction_id+' data-construction_name = '+data[i].construction_name+' data-constructiontype_id = '+data[i].constructiontype_id+' data-constructiontype = '+data[i].construction_type+'><i class = "fa fa-eye"></i> Estimate Cost</a>';
            row += '<tr>';
            // row += '<td>'+data[i].construction_id+'</td>';
            row += '<td>'+toTitleCase(data[i].construction_type.toLowerCase())+'</td>';
            row += '<td>'+toTitleCase(data[i].construction_name.toLowerCase())+'</td>';
            // row += '<td>'+data[i].created_at+'</td>';
            // row += '<td>'+data[i].updated_at+'</td>';
            var id = data[i].construction_id;
            row += '<td style = "text-align:center">';
            row += status;
            row += '<a class = "btn btn-outline-primary btn-sm edit" data-id = '+data[i].construction_id+' data-construction_name = '+data[i].construction_name+' data-constructiontype_id = '+data[i].constructiontype_id+' data-constructiontype_name = '+data[i].construction_type+'><i class = "fa fa-edit"></i> </a>';
            row += '<a class = "btn btn-outline-danger btn-sm remove" data-id = '+data[i].construction_id+' data-construction_name = '+data[i].construction_name+' data-constructiontype_id = '+data[i].constructiontype_id+' data-constructiontype_name = '+data[i].construction_type+'><i class = "fa fa-trash"></i> </a>';
            row += '<a class = "btn btn-outline-primary btn-sm href" data-id = '+id+'><i class = "fa fa-eye"></i> </a>';
            row += '</td>';
            row += '</tr>';
          }
          $("#data-table tbody").html(row);
        },
        error: function (data)
        {
          alert('Something went wrong! Please reload the page.');
        }
      })
    }
    $("body").on('click', '.href', function(e){
      var id = $(this).data('id');
      window.location.href = "/constructionsbyID/"+id;
    })
    $("#btn_openmodal").on('click', function(e){
      $("form").trigger('reset');
      // $("#eec_ajaxresponse").html("");
      // $("#eec_ajaxresponse").removeClass('alert alert-danger');
      // $("#eec_ajaxresponse").addClass('alert alert-danger');
      // $("#eec_form").trigger('reset');
      $( "#c_modaltitle").text('Add Construction (SOW)');
      $("#modal").modal({
            backdrop: 'static',
            keyboard: false,
        }, 'show');
    });
    $("body").on('click', '.remove', function(e){
      e.preventDefault();
      var id = $(this).data('id');
      $("#id").val(id);
      if(confirm('Are you sure you want to delete this item?'))
      {
        $.ajax({
          type: 'POST',
          url: '/construction_actions',
          data:{
            item: 'delete',
            id: id,
          },
          dataType: 'json',
          success:  function  (response){
            if(response.status == 200){
              $("#id").val('');
              alert(response.success);

            }
            show_allConstructionTypes();
            show_allData();
          },
          error: function (response){
            alert('Something went wrong!\nReload the page!');
          }
        })
      }
    });
    
    $("body").on('click', '.edit', function(e){
      e.preventDefault();
      $("#eec_ajaxresponse").html("");
      $("#eec_ajaxresponse").removeClass('alert alert-danger');

      $("#elc_ajaxresponse").html("");
      $("#elc_ajaxresponse").removeClass('alert alert-danger');;

      $("#emc_ajaxresponse").html("");
      $("#emc_ajaxresponse").removeClass('alert alert-danger');

      $("#ajaxresponse").html("");
      $("#ajaxresponse").removeClass('alert alert-danger');
      $("form").trigger('reset');

      var id = $(this).data('id');
      var constructiontype_id = $(this).data('constructiontype_id');
      var construction_name = $(this).data('construction_name');
      var constructiontype_name = $(this).data('constructiontype_name');
      $("#id").val(id);
      $("#construction_name").val(construction_name);
      $("#constructiontype_id").val(constructiontype_id);
      $("#constructiontype_id").append(constructiontype_name);
      $("#c_modaltitle").text('Edit Scope Of Work');
      $("#modal").modal({
            backdrop: 'static',
            keyboard: false,
        }, 'show');
    });
    $("#form").on('submit', function(e){
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
          show_allConstructionTypes();
        },
        error:  function  (response)
        {
          alert('Something went wrong! Reload the page.')
        }
      });
    });
  })
</script>
</body>
</html>
