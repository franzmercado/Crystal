@extends('layouts.app')

@section('content')


      <div class="p-4 bg-white border rounded">
      <div class="col-md-10 offset-1" style="min-height:500px;">

<div class="tab">
  <button class="tablinks active" onclick="openTab(event, 'Info')">Personal Info</button>
  <button class="tablinks" onclick="openTab(event, 'Address')">Address</button>
    <button class="tablinks" onclick="openTab(event, 'Accounts')">Account</button>
</div>
  <div id="Info" style="display: block; min-height:380px;" class="tabcontent">
  <form class="form-profile" action="" method="post">
    @csrf
    <h4>Profile</h4>
    <div class="row">
      <div class="form-group col-md-4 offset-2" >
          <label class="mb-0" for="fname">First Name:</label>
            <input class="form-control" type="text" value="" id="fname" name="fname" required>
      </div>
      <div class="form-group col-md-4" >
          <label class="mb-0"for="mname">Middle Name:</label>
          <input class="form-control" type="text" value="" id="mname" name="mname">
      </div>
    </div>
    <div class="row">
      <div class="form-group col-md-4 offset-2" >
          <label class="mb-0" for="lname">Last Name:</label>
            <input class="form-control" type="text" value="" id="lname" name="lname" required>
      </div>
      <div class="form-group col-md-2 " >
          <label class="mb-0" for="gender">Gender:</label>
            <select class="form-control border" id="gender" name="gender" required>
              <option value="" selected disabled></option>
              <option value="0">Female</option>
              <option value="1">Male</option>

            </select>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 offset-2" >
          <label class="mb-0"for="bday">Birthday:</label>
            <input class="form-control" type="date" value="" id="bday" name="bday" required>
      </div>

      <div class="col-md-4" >
          <label class="mb-0" for="contact">Contact Number:</label>
          <div class="input-container">
            <i class="fa icon">+63</i>
            {{-- <input class="form-control pl-0" type="text" value="" id="contact" name="contact" pattern="[1-9]{1}[0-9]{9}" required> --}}
            <input type="text" name="contact" id="contact" class="form-control pl-0" pattern="\d*" minlength="10" maxlength="10" title="10 digits only" required>

            </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 offset-2" >
          <label class="mb-0" for="email">Email:</label>
            <input class="form-control" type="email" value="" id="email" name="email" required>
      </div>
      <div class="col-md-2">

      </div>
      <div class="col-md-2">
        <br>
        <input type="submit" class="btn btn-primary" name="submit" value="Save Changes">
          <br>
      </div>

    </div>


      </form>
</div>


<div id="Address" class="tabcontent" style="min-height:380px;">
  <form class="form-address" method="post">
    @csrf
  <h4>Delivery Address</h4>
  <div class="row">
    <div class=" col-md-4 offset-2" >
      <label class="mb-0" for="province">Province:</label>
          <select class="form-control" id="province" name="province" required>
          </select><br>
    </div>
    <div class=" col-md-4" >
      <label class="mb-0" for="city">City/Town:</label>
      <input type="hidden" id="tag">
          <select class="form-control" id="city" name="city" required>
          </select><br>
    </div>
  </div>
<div class="row">
  <div class=" col-md-4 offset-2" >
    <label class="mb-0" for="brgy">Barangay:</label>
        <input type="text" name="brgy" id="brgy" class="form-control" required>
  </div>
  <div class=" col-md-4" >
    <label class="mb-0" for="houseNum">House/Building No., Street Name:</label>
        <input type="text" name="houseNum" id="houseNum" class="form-control" value="">
  </div>
</div>
<br>
<div class="row">
  <div class=" col-md-2 offset-2" >
    <label class="mb-0" for="houseNum">Zip Code:</label>
      <input type="text" name="zip" id="zip" class="form-control" pattern="\d*" maxlength="4" title="4 digits only" required>
  </div>
  <div class="col-md-4" >
  </div>
  <div class="col-md-2" >
    <br>
    <input type="submit" class="btn btn-primary" name="submit" value="Save Changes">
  </div>
</div>
</form>
<br>
</div>

<div id="Accounts" class="tabcontent" style="min-height:380px;">
  <form class="form-password" method="post">
    @csrf
    <h4>Change Password</h4>
    <div class="row">
      <div class="col-md-4 offset-2">
        <label class="mb-0" for="newpass">New Password:</label>
        <input type="password" id="newpass" name="newpass" required pattern=".{8,12}" title="8 to 12 characters" class="form-control">
      </div>
      <div class="col-md-4">
        <label class="mb-0" for="repass">Retype Password:</label>
        <input type="password" id="repass" name="repass" required pattern=".{8,12}" title="8 to 12 characters" class="form-control">
        <small class="ml-2 " id="errorRep"><font color="red">*Password do not match</font></small>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-4 offset-2">
        <label class="mb-0" for="pass">Old Password:</label>
        <input type="password" id="pass" name="pass" required pattern=".{8,12}" title="8 to 12 characters" class="form-control">
        <small class="ml-2 " id="errorPass"><font color="red">*Incorrect Password </font></small>

      </div>
      <div class="col-md-2">

      </div>
      <div class="col-md-2">
        <br>
        <input type="submit" name="submit" class="btn btn-primary" value="Save Changes">
      </div>
    </div>
  </form>
</div>

    </div>
    </div>

@endsection
