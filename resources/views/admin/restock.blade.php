@extends('layouts.admins')
@section('content')

      <div class="p-3 bg-white border rounded">
        <div class="row">
          <div class="col-md-12">
            <h4>Restock Products</h4>

          </div>
        </div><br>
        <div class="row ">
          <div class="col-md-10 offset-1 form-group">
        <div class="table-responsive " style="min-height:460px;">
              <table id="productRestockTbl" class="table table-striped table-bordered table-hover "style="width:100%">
                <thead>
                    <tr>
                    <th width="15%">Image</th>
                    <th width="30%">Name</th>
                    <th width="20%">Category</th>
                    <th width="15%">Stock</th>
                    <th width="15%">Action</th>
                  </tr>
                </thead>
              </table>

        </div>

      </div>
    </div>
  </div>

  <div id="restockMpdal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add Stock</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>
        <form id="restockForm"  class="form-horizontal" method="post" role="form">
            <div class="modal-body">
            @csrf
            @method('PUT')
            <div class="col-md-10 offset-1 form-group">
              <label for="quantity">Quantity: </label>
              <input type="number" id="quantity" name="quantity" step="1" min="1"class="form-control" required>
            </div>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-info stkBtn" value="Submit">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
        </form>
      </div>

    </div>
  </div>
@endsection
