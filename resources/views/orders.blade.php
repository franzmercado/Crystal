@extends('layouts.app')

@section('content')


      <div class="p-4 bg-white border rounded">
      <div class="col-md-12" style="min-height:500px;">
          <div class="row">
            <div class="col-md-10">
              <h2><b>My Purchase</b></h2>
            </div>

          </div>
          <hr>
          <div class="row ">
            <div class="col-md-12 form-group">
              <div class="table-responsive">
                <table id="purchaseTbl" class="table table-striped table-bordered table-hover "style="width:100%">
                  <thead>
                      <tr>
                      <th width="12%">TransactionID</th>
                      <th width="29%">Items</th>
                      <th width="13%">Date Ordered</th>
                      <th width="14%">Date Delivered</th>
                      <th width="11%">Amount</th>
                      <th width="10%">Status</th>
                      <th width="5%"></th>
                    </tr>
                  </thead>
                </table>
              </div>
        </div>
      </div>
    </div>
    </div>

@endsection
