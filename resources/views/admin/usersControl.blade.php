@extends('layouts.admins')
@section('content')

      <div class="p-3 bg-white border rounded">
        <div class="row">
          <div class="col-md-12">
            <h4>Manage User Accounts</h4>

          </div>
        </div><br>

        <div class="row">
          <div class="col-md-12 form-group">
        <div class="table-responsive" style="min-height:460px;">

              <table id="usersTbl" class="table table-striped table-bordered table-hover " title="Double click to change status"style="width:100%; cursor: pointer;">
                <thead>
                    <tr>
                    <th width="10%">UserID</th>
                    <th width="30%">Name</th>
                    <th width="30%">Email</th>
                    <th width="5%">Age</th>
                    <th width="15%">Date Joined</th>
                    <th width="5%">Status</th>
                  </tr>
                </thead>
              </table>

        </div>

      </div>
    </div>
  </div>


@endsection
