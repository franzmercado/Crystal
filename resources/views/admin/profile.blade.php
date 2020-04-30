@extends('layouts.admins')

@section('content')


<div class="p-3 bg-white border rounded">
    <div class="col-md-12">
                  <!-- Tab links -->
<div class="tab">
  <button class="tablinks active" onclick="openTab(event, 'Info')">Personal Info</button>
  <button class="tablinks" onclick="openTab(event, 'Account')">Account</button>
</div>

<!-- Tab content -->
<div id="Info" style="display: block;" class="tabcontent">
  <form class="form-info" action="" method="post">
    @csrf
  <div class="row justify-content-center">
  <h4>Profile</h4>
</div>
  <div class="row">
    <div class="col-md-4 offset-4">
      <label class="mb-0" for="fname">Firstname:</label>
      <input type="text" name="fname" id='fname' class="form-control">
      <p></p>

    </div>
  </div>
  <div class="row">
    <div class="col-md-4 offset-4">
      <label class="mb-0" for="lname">Lastname:</label>
      <input type="text" name="lname" id='lname' class="form-control">
      <p></p>

    </div>
  </div>
  <div class="row">
    <div class="col-md-4 offset-4">
      <label class="mb-0" for="mail">Email Address:</label>
      <input type="email" name="email" id='email' class="form-control">
      <p></p>

    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-md-4 offset-4">
      <input type="submit" name="" class="btn btn-primary btn-sm float-right" value="Save Changes">
    </div>
  </div>
  </form>
</div>

<div id="Account" class="tabcontent">
  <form class="form-pass" action="" method="post">
    @csrf
  <div class="row justify-content-center">
    <h4>Change Password</h4>
  </div>
  <div class="row">
    <div class="col-md-4 offset-4">
      <label class="mb-0" for="cpass">Current Password:</label>
      <input type="password" name="cpass" id='cpass' class="form-control" required>
      <small class="ml-2"><font color='red' class="cpass-error">*Incorrect password.</font></small>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4 offset-4">
      <label class="mb-0" for="npass">New Password:</label>
      <input type="password" name="npass" id='npass' class="form-control" title="8 to 12 characters" minlength="8" maxlength="12" required>
      <p></p>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4 offset-4">
      <label class="mb-0" for="rpass">Re-type New Password:</label>
      <input type="password" name="rpass" id='rpass' class="form-control" title="8 to 12 characters" minlength="8" maxlength="12" required>
      <small class="ml-2"><font color='red' class="newPass-error">*Password not match.</font></small>

    </div>
  </div>
  <div class="row">
    <div class="col-md-4 offset-4">
      <input type="submit" name="" class="btn btn-primary btn-sm btn-submit float-right" value="Save Changes">
    </div>
  </div>
    </form>
</div>


  </div>
</div>

@endsection
