@extends('layouts.admins')
@section('content')

      <div class="p-3 bg-white border rounded" style="min-height: 300px;">
        <div class="row">
          <div class="col-md-10 offset-1">
            <h4>Generate Reports</h4>
            <br>
            <form class="form-report" method="post">
            <div class="row">
              <div class="col-md-3">
                <h5 class="mb-0">Date</h5>
                <select class="form-control" name="repType" id="repType" required>
                  <option value="" disabled selected></option>
                  <option value="1">Daily</option>
                  <option value="2">Weekly</option>
                  <option value="3">Monthly</option>
                  <option value="4">Annually</option>
                </select>
                <br>
                <input type="date" name="repDay" id="repDay" class=" repDate form-control" disabled>
                <input type="week" name="repWeek" id="repWeek"  class="repDate form-control" disabled>
                <input type="month" name="repMonth" id="repMonth" class=" repDate form-control" disabled>
                <select class="form-control repDate" name="repYear" id="repYear" disabled>

                </select>


              </div>
              <div class="col-md-3">
                  <h5 class="mb-0">Status</h5>
                  <select class="form-control" name="status" required>
                    <option value="" disabled selected></option>
                    <option value="1">All</option>
                    <option value="2">Delivered</option>
                    <option value="3">Shipping</option>
                  </select>
              </div>
              <div class="col-md-1">
              </div>
              <div class="col-md-3">
                <br>

                {{-- <button type="button" class="btn btn-danger btn-md" id="gen" name="button">Generate</button> --}}
                <input type="submit" class="btn btn-danger btn-md" name="submit" value="Generate">
              </div>

            </div>
          </form>

          </div>
        </div><br>

  </div>

@endsection
