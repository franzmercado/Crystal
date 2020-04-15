@extends('layouts.app')

@section('content')


      <div class="p-4 bg-white border rounded">
      <div class="col-md-12" style="min-height:500px;">

<div class="tab">
  <button class="tablinks active" onclick="openTab(event, 'Info')">Personal Info</button>
  <button class="tablinks" onclick="openTab(event, 'Address')">Address</button>
    <button class="tablinks" onclick="openTab(event, 'Accounts')">Account</button>
</div>
  <form class="form-profile" action="" method="post">
  <!-- Tab content -->
  <div id="Info" style="display: block;" class="tabcontent">
    <h3>Profile</h3>
    <div class="form-group col-md-6 offset-3" >
        <label for="branch">First Name:</label>
        <div class="input-container">
          <i class="fa fa-info fa-lg icon"></i>
          <input class="input-field" type="text" value="" id="fname" name="fname">
          </div>
    </div>
    <div class="form-group col-md-6 offset-3" >
        <label for="branch">Middle Name:</label>
        <div class="input-container">
          <i class="fa fa-info fa-lg icon"></i>
          <input class="input-field" type="text" value="" id="mname" name="mname">
          </div>
    </div>
    <div class="form-group col-md-6 offset-3" >
        <label for="branch">Last Name:</label>
        <div class="input-container">
          <i class="fa fa-info fa-lg icon"></i>
          <input class="input-field" type="text" value="" id="lname" name="lname">
          </div>
    </div>
    <div class="form-group col-md-6 offset-3" >
        <label for="branch">Birthday:</label>
        <div class="input-container">
          <i class="fa fa-info fa-lg icon"></i>
          <input class="input-field" type="date" value="" id="bday" name="bday">
          </div>
    </div>
    <div class="form-group col-md-6 offset-3" >
        <label for="branch">Email:</label>
        <div class="input-container">
          <i class="fa fa-info fa-lg icon"></i>
          <input class="input-field" type="email" value="" id="email" name="email" required>
          </div>
    </div>
    <div class="form-group col-md-6 offset-3" >
        <label for="branch">Contact Number:</label>
        <div class="input-container">
          <i class="fa fa-info fa-lg icon"></i>
          <i class="fa icon">+63</i>
          <input class="input-field" type="text" value="" id="contact" name="contact" pattern="[1-9]{1}[0-9]{9}" required>
          </div>
    </div>
    <div class="col-md-6 offset-3">
      {{-- <button type="button" name="button" class="btn btn-primary">Save Changes</button> --}}
      <input type="submit" class="btn btn-primary" name="submit" value="Save Changes">
    </div>
</div>
  </form>

<div id="Address" class="tabcontent">
  <h4>Delivery Address</h4>
  <div class="form-group col-md-6 offset-3" >
    <label for="province">Province:</label>
      <div class="input-container">
        <i class="fa fa-info fa-lg icon"></i>
        <select class="form-control" id="province" name="province">
        </select><br>
        </div>
  </div>
  <div class="form-group col-md-6 offset-3" >
    <label for="city">City/Town:</label>
      <div class="input-container">
        <i class="fa fa-info fa-lg icon"></i>
        <select class="form-control" id="city" name="city">
        </select><br>
        </div>
  </div>
  <div class="form-group col-md-6 offset-3" >
    <label for="brgy">Barangay:</label>
      <div class="input-container">
        <i class="fa fa-info fa-lg icon"></i>
        <input type="text" name="brgy" id="brgy" class="form-control">
        </div>
  </div>
  <div class="form-group col-md-6 offset-3" >
    <label for="houseNum">House/Building Number, Street Name:</label>
      <div class="input-container">
        <i class="fa fa-info fa-lg icon"></i>
        <textarea name="houseNum" id="houseNum" rows="3" class="form-control" cols="80"></textarea><br>

        </div>
  </div>
  <div class="form-group col-md-6 offset-3" >
    <button type="button" name="button" class="btn btn-primary">Save Changes</button>
  </div>


</div>
<div id="Accounts" class="tabcontent" style="min-height:300px;">
  <h4>Change Password</h4>
<div class="col-md-6 offset-3">
  <label for="">Old Password:</label>
  <input type="password" name="" class="form-control"><br>
  <label for="">New Password:</label>
  <input type="password" name="" class="form-control"><br>
  <label for="">Retype Password:</label>
  <input type="password" name="" class="form-control"><br>

  <button type="button" name="button" class="btn btn-primary">Save Changes</button>

  </div>
</div>

    </div>
    </div>

@endsection
