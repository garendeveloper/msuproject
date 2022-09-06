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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Materials</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Materials</li>
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
                    <button class = "btn btn-primary btn-sm" id = "btn_material" type = "button" align = "left"><i class = "fa fa-plus"></i> Add Material</button>
                  </div>
                  <div class="col-md-6">
                  <input class="form-control" id = "search" type="search" placeholder="Search Item" aria-label="Search">
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tbl_materials" style = "table-layout: fixed; width: 100%;  border: 1px solid black;" class="table table-bordered table-striped">
                  <thead style = "background-color: #1C518A;color: white; ">
                  <tr>
                    <th>ID</th>
                    <th>Material</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    <th>Total Amount</th>
                    <th>Date Created</th>
                    <th>Date Updated</th>
                   
                    <th style = "text-align: center">Actions</th>
                  </tr>
                  </thead>
                  <tbody id = "tbody_materials">
                
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
  <div class="modal fade modal_material" id="modal-info">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- <div class="overlay">
              <i class="fas fa-2x fa-sync fa-spin"></i>
          </div> -->
          <div class="modal-header bg-dark">
            <h4 class="modal-title">Add Material</h4>
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
              <div class="form-group">
                <label for="construction">Material</label>
                <input type="text" name = "material" id= "material" class = "form-control" autofocus>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" name = "quantity" id= "quantity" class = "form-control" style = "text-align: right">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" name = "amount" id= "amount" class = "form-control" style = "text-align: right">
                  </div>
                </div>
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
      $("#tbl_materials tbody tr").filter(function(){
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  $("#form").on('submit', function(e){
    e.preventDefault();
    var data = $(this).serializeArray();
   
    $.ajax({
      type: 'POST',
      url: '/material_action',
      data: data,
      dataType: 'json',
      success:  function(response)
      {
        if(response.status == 200){
          $("#ajaxresponse").html("");
          $("#ajaxresponse").removeClass('alert alert-danger');
          $(".modal_material").modal('hide');
          $("#form").trigger('reset');
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
        show_allData();
      },
      error:  function(response){
        alert("Something went wrong! Please reload the page!");
      }
    })
  });

  $("#btn_material").on('click', function(e){
    e.preventDefault();
    $("form").trigger('reset');
    $(".modal-title").text('Add Material');
    $(".modal_material").modal('show');
  });
  $("body").on('click', '.edit', function(e){
    $(".modal-title").text('Edit Material');
    var id = $(this).data('id');
    var quantity = $(this).data('quantity');
    var amount = $(this).data('amount');
    var material = $(this).data('material');
    $("#id").val(id);
    $("#material").val(material);
    $("#amount").val(amount);
    $("#quantity").val(quantity);
    $(".modal_material").modal('show');
  })
  $("body").on('click', '.remove', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    if(confirm('Are you sure you want to delete this item?\nThis action cannot be undone!\nWould you like to proceed?')){
      $.ajax({
        type: 'POST',
        url: '/material_action',
        data: {
          item: 'remove', 
          id: id,
        },
        dataType: 'json',
        success: function(response){
          if(response.status == 200){
            alert(response.message);
          }
          else{
            alert(response.message);
          }
          show_allData();
        },
        error:  function(response){
          alert('Something went wrong!Please reload the page!');
        }
      })
    }
  });
  function show_allData()
  {
    $.ajax({
      type: 'GET',
      url: '/get_allmaterials',
      dataType: 'json',
      success:  function(data)
      {
        var html = "";
     
       
        for(var i = 0; i<data.length; i++)
        {
          var totalamount = (data[i].quantity * data[i].amount);
          html += "<tr>";
          html += "<td>"+data[i].id+"</td>";
          html += "<td>"+data[i].material+"</td>";
          html += "<td style = 'text-align: right'>"+data[i].quantity+"</td>";
          html += "<td style = 'text-align: right'>"+formatToCurrency(data[i].amount)+"</td>";
          html += "<td style = 'text-align: right'>"+formatToCurrency(totalamount)+"</td>";
          html += "<td style = 'font-size: 10px;'>"+new Date(data[i].created_at)+"</td>";
          html += "<td style = 'font-size: 10px;'>"+new Date(data[i].updated_at)+"</td>";
          html += '<td align = "center"> '+
                        '<a class = "btn btn-primary edit" data-material = "'+data[i].material+'" data-quantity = "'+data[i].quantity+'" data-amount = "'+data[i].amount+'" data-id = "'+data[i].id+'" ><i class = "fa fa-edit"></i> </a>'+ 
                        '<a class = "btn btn-danger remove" data-material = "'+data[i].material+'" data-quantity = "'+data[i].quantity+'" data-amount = "'+data[i].amount+'" data-id = "'+data[i].id+'" ><i class = "fa fa-trash"></i> </a>'+ 
                     '</td>';
          html += "</tr>";
        }
     
        $("table tbody").html(html);
      },
      error:  function(e)
      {
        alert("Something went wrong in fetching data in database.")
      }
    })
  }
  $.fn.currencyFormat = function() {
		this.each( function( i ) {
			$(this).change( function( e ){
				if( isNaN( parseFloat( this.value ) ) ) return;
				this.value = parseFloat(this.value).toFixed(2);
			});
		});
		return this; //for chaining
	}
</script>
</body>
</html>
