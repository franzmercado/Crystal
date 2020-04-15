@extends('layouts.admins')
@section('content')

      <div class="p-3 bg-white border rounded">
        <div class="row">
          <div class="col-md-12">
            <h4>Manage Products</h4>

          </div>
        </div><br>
        <div class="row ">
          <div class="col-md-12 form-group">
        <div class="table-responsive " style="min-height:460px;">
              <table id="productsTbl" class="table table-striped table-bordered table-hover "style="width:100%">
                <thead>
                    <tr>
                    <th width="15%">Image</th>
                    <th width="30%">Name</th>
                    <th width="20%">Category</th>
                    <th width="15%">Price</th>
                    <th width="15%">Action</th>
                  </tr>
                </thead>
              </table>

        </div>

      </div>
    </div>
  </div>

  <div id="edtProduct" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Product</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form id="editProdForm"  class="form-horizontal" method="post" role="form">
            <div class="modal-body">
              @csrf
              @method('PUT')
            <div class="col-md-8 offset-2 mb-2">
              <label for="Productname">Product Name: </label>
              <input type="text" class="form-control " name="Productname" id="Productname" required>
            </div>
            <div class="col-md-5 offset-2 mb-2">
              <label for="Category">Category: </label>
              <select class="form-control" name="Category" id="Category" required>
                <option value="" disabled selected></option>
                @isset($category)
                  @foreach ($category as $value)
                      <option value="@php echo $value->id @endphp">@php echo $value->description @endphp</option>
                  @endforeach
                @endisset
              </select>
            </div>

            <div class="row col-md-3 offset-2 mb-2">
              <label for="Size">Size: </label>
              <select class="form-control" name="Size" id="size" required>
                <option value="" selected disabled></option>
                <option value="325ml">325ml</option>
                <option value="500ml">500ml</option>
                <option value="750ml">750ml</option>
                <option value="1L">1L</option>
                <option value="1.5L">1.5L</option>
                <option value="1.75L">1.75L</option>
                <option value="2L">2L</option>
                </select>
            </div>
            <div class="col-md-4 offset-2 mb-2">
              <label for="Price">Price: </label>
              <input type="number" min="1.00" max="10000.00"  step="0.01" id="price" name="Price" class="form-control" required>
            </div>

            <div class="col-md-8 offset-2 mb-2">
              <label for="Description">Description: </label>
              <textarea name="Description" rows="4" id="Description"class="form-control" required></textarea>
            </div>

        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-warning uptProd" value="Update">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
        </form>
      </div>
    </div>
  </div>
@endsection
