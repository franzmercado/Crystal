@extends('layouts.admins')
@section('content')

      <div class="p-3 bg-white border rounded">
        <div class="row">
          <div class="col-md-12">
            <h4>Generate Reports</h4>
            <div class="row">
              <div class="col-md-3">
                <h5>Date</h5>
                <select class="form-control" name="">
                  <option value="" disabled selected></option>
                  <option value="">Daily</option>
                  <option value="">Weekly</option>
                  <option value="">Monthly</option>
                  <option value="">Annually</option>



                </select>
                <input type="date" name="" value=""class="form-control">
                  <input type="month" name="" value=""class="form-control">
                  <input type="week" name="" value=""class="form-control">
              </div>
              <div class="col-md-3">
                  <h5>Status</h5>
                  <select class="form-control" name="">
                    <option value="" disabled selected></option>
                    <option value="">All</option>
                    <option value="">Delivered</option>
                    <option value="">Shipping</option>
                    <option value="">Cancelled</option>



                  </select>
              </div>
              <div class="col-md-1">


              </div>
              <div class="col-md-3">
                <button type="button" class="btn btn-danger btn-md" name="button">Generate</button>

              </div>

            </div>
          </div>
        </div><br>

  </div>

@endsection
