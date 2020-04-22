@extends('layouts.admins')
@section('content')

      <div class="p-3 bg-white border rounded">
        <div class="row">
          <div class="col-md-12">
            <h4>Manage Orders</h4>

          </div>
        </div><br>
        <div class="row ">
          <div class="col-md-12 form-group">
        <div class="table-responsive " style="min-height:460px;">
              <table id="ordersTbl" class="table table-striped table-bordered table-hover "style="width:100%; cursor: default;">
                <thead>
                    <tr>
                    <th width="20%">TransactionID</th>
                    <th width="28%">Client Name</th>
                    <th width="15%">Date Ordered</th>
                    <th width="15%">Date Finished</th>
                    <th width="13%">Total Amount</th>
                    <th width="15%">Status</th>

                  </tr>
                </thead>
              </table>

        </div>

      </div>
    </div>
  </div>

  <div id="actedtModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="actTitle"></h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form id="editForm"  class="form-horizontal" method="post" role="form">
            <div class="modal-body">
            @csrf
            @method('PUT')
            <div class="col-md-8 offset-2 mb-2">
              <label for="Productname">Product Name: </label>
              <input type="text" class="form-control " name="Productname" required>
            </div>
            <div class="col-md-5 offset-2 float-left mb-2">
              <label for="Category">Category: </label>
              <select class="form-control" name="Category" required>
                <option value="" disabled selected></option>
                @isset($category)
                  @foreach ($category as $value)
                      <option value="@php echo $value->id @endphp">@php echo $value->description @endphp</option>
                  @endforeach
                @endisset
              </select>
            </div>

            <div class="col-md-3 float-left mb-2">
              <label for="Size">Size: </label>
              <select class="form-control" name="Size" required>
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
            <div class="col-md-5 offset-2 float-left mb-2">
              <label for="Price">Price: </label>
              <input type="number" min="1.00" max="10000.00"  step="0.01" name="Price" class="form-control" required>
            </div>
            <div class="col-md-3 float-left mb-2">
              <label for="Qty">Qty. : </label>
              <input type="number" min="1" max="10000"  step="1" name="Qty" class="form-control" required>
            </div>
            <div class="col-md-8 offset-2 mb-2">
              <label for="Description">Description: </label>
              <textarea name="Description" rows="4" name="Description"class="form-control" required></textarea>
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

  <div id="showOrders" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="mr-2">TransactionID:</h5> <p class="modal-title" id="transID"></p>
            <button type="button" class="close " data-dismiss="modal"><i class="fas fa-window-close "></i></button>
        </div>
            <div class="modal-body">
              <div class="row" >
                <div class="col-md-5 offset-1 ">
                  <label class="mb-0" for="name">Name:</label>
                  <input type="text" name="name" id="name" class="form-control" readonly>
                </div>
                <div class="col-md-3">
                  <label class="mb-0" for="">Date Ordered:</label>
                  <input type="text" name="date" id="date" class="form-control" readonly>
                </div>
                <div class="col-md-3 FinishedDate" style="display: none;">
                  <label class="mb-0" for="">Date Finished:</label>
                  <input type="text" name="Fdate" id="Fdate" class="form-control" readonly>
                </div>
                    </div>
                    <div class="row mt-2">
                      <div class="col-md-3 offset-1">
                        <label class="mb-0" for="name">Contact Number:</label>
                        <input type="text" name="contactnum" id="contactnum" class="form-control" readonly>
                      </div>
                      <div class="col-md-3">
                        <label class="mb-0" for="">Total:</label>
                        <input type="text" id="totalPrice" class="form-control" readonly>
                      </div>
                      <div class="col-md-3">
                        <label class="mb-0" for="">Status:</label>
                        <select class="form-control" name="status" id="status" disabled>
                          <option value="0">Cancelled</option>
                          <option value="1">Pending</option>
                          <option value="2">Preparing</option>
                          <option value="3">Shipping</option>
                          <option value="4">Delivered</option>
                          <option value="9">Declined</option>
                        </select>
                      </div>
                          </div>
                    <div class="row">
                      <div class="col-md-9 offset-1 mb-3">
                        <label for="">Location:</label>
                        <textarea name="name" id="address" rows="2" cols="50" class="form-control" readonly></textarea>

                      </div>

                    </div>

              <div class="row col-md-10 offset-1">
                <h5>Order(s)</h5>
                <table id="showORdersTbl"  class="table table-striped table-bordered">
                  <thead>
                    <th  width="60%">Product Name</th>
                    <th width="10%">Quantity</th>
                  </thead>
                  <tbody >
                    <tr>

                    </tr>
                  </tbody>

                </table>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-sm btn-success actBtn" style="display: none;">Accept</button>
              <button class="btn btn-sm btn-success shpBtn" style="display: none;">Ship</button>
              <button class="btn btn-sm btn-success delBtn" style="display: none;">Complete</button>
              <button class="btn btn-sm btn-danger decBtn"style="display: none;" >Decline</button>
              <button class="btn btn-sm btn-danger cnclOrder" style="display: none;">Cancel</button>
            </div>
      </div>
    </div>
  </div>
@endsection
