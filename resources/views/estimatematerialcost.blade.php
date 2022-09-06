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
            <h1>Constructions (Scope of Work)</h1>
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
                <!-- <h3 class="card-title">Constructions</h3> -->
                <button class = "btn btn-outline-primary btn-sm" id = "btn_openmodal" type = "button"><i class = "fa fa-plus"></i> Add Construction (SOW )</button>
                <a  href="{{ url('/constructiontypes') }}" class = "btn btn-outline-primary btn-sm"  align = "right"><i class = "fa fa-arrow-left"></i> Back</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="data-table" class="table table-bordered table-striped data-table" style = "table-layout: absolute; ">
                  <thead style = "background-color: #1C518A; color: white;">
                  <tr>
                    <th>ID</th>
                    <th>Construction Type</th>
                    <th>Scope of work</th>
                    <th>Date Created</th>
                    <th>Date Updated</th>
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
        <div class="modal-dialog">
          <div class="modal-content">
            <!-- <div class="overlay">
                <i class="fas fa-2x fa-sync fa-spin"></i>
            </div> -->
            <div class="modal-header">
              <h4 class="modal-title">Add Construction (SOW ) </h4>
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

      <div class="modal fade" id="modal_description">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" >
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
            <form action="" method="post" id = "description_form">
              <div class="modal-body">
                  <div class="row">
                    <div class="col-md-6">
                      <label for="quantity">Quantity</label>
                      <input type="number" id = "quantity" name = "quantity" class = "form-control" autocomplete = "off">
                    </div>
                    <div class="col-md-6">
                      <label for="unit">Unit</label>
                      <input type="text" id = "unit" name = "unit" class = "form-control" autocomplete = "off" >
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label for="description">Description</label>
                      <textarea name="description" id="description" cols="30" rows="4" class = "form-control"></textarea>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <label for="unitcost">Unit Cost</label>
                      <input type="number" id = "unitcost" name = "unitcost" autocomplete = "off" step = "1" class = "form-control">
                    </div>
                    <div class="col-md-6">
                      <label for="amount">Amount</label>
                      <input type="number" id = "amount" name = "amount" autocomplete = "off" step = "1" class = "form-control">
                    </div>
                  </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
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
  $(document).ready(function(e){
    show_allData();
    show_allConstructionTypes();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
  })
</script>
</body>
</html>
