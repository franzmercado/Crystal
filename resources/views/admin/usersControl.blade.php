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

              <table id="usersTbl" class="table table-striped table-bordered table-hover "style="width:100%">
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


<div id="actModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="actTitle"></h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-success actBtn" style="display:none;">Activate</button>
        <button type="button" class="btn btn-danger deactBtn" style="display:none;">Deactivate</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
@endsection
