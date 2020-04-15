@extends('layouts.admins')
@section('content')

      <div class="p-3 bg-white border rounded">
        <div class="row">
          <div class="col-md-12">
            <h4>Manage Brands</h4>

          </div>
        </div><br>
        <div class="row" >
          <div class="col-md-8 offset-2">
        <div class="table-responsive" style="min-height:460px;">
          <button type="button" class="btn btn-primary float-right p-1 " data-toggle="modal" data-target="#addBrand"><i class="fa fa-plus"></i> Add New</button>

              <table id="brandsTbl" class="table table-striped table-bordered table-hover "style="width:100%">
                <thead>
                    <tr>
                    <th width="20%">Brand ID</th>
                    <th width="60%">Description</th>
                    <th width="20%">Action</th>
                  </tr>
                </thead>

              </table>

        </div>

      </div>
    </div>
  </div>



<!-- Add Modal -->
<div id="addBrand" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title">Add Brand</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>

      </div>
      <form id="addForm"  class="form-horizontal" method="post" role="form">
          <div class="modal-body">
          @csrf
          <div class="col-md-10 offset-1 form-group">
            <label for="description">Description: </label>
            <input type="text" id="description" name="description" class="form-control" required>
          </div>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-success actBtn" id="submit">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </form>
    </div>

  </div>
</div>

{{-- Edit MOdal --}}
<div id="editBrand" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title">Edit Brand</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>

      </div>
      <form id="editForm"  class="form-horizontal" method="post" role="form">
          <div class="modal-body">
          @csrf
          @method('PUT')
          <div class="col-md-10 offset-1 form-group">
            <label for="descriptionedt">Description: </label>
            <input type="text" id="descriptions" name="descriptions" class="form-control" required>
          </div>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-warning uptBtn" value="Update">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </form>
    </div>

  </div>
</div>
@endsection
