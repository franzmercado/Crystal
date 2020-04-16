@extends('layouts.app')

@section('content')


      <div class="p-4 bg-white border rounded">
      <div class="col-md-10 offset-1" style="min-height:500px;">

<div class="tab">
  <button class="tablinks active" onclick="openTab(event, 'Info')">Personal Info</button>
  <button class="tablinks" onclick="openTab(event, 'Address')">Address</button>
    <button class="tablinks" onclick="openTab(event, 'Accounts')">Account</button>
</div>
  <div id="Info" style="display: block;" class="tabcontent">
  <form class="form-profile" action="" method="post">
    <h3 class="ml-2">Profile</h3>
    <div class="row">
      <div class="form-group col-md-4 offset-2" >
          <label class="mb-0" for="fname">First Name:</label>
            <input class="form-control" type="text" value="" id="fname" name="fname">
      </div>
      <div class="form-group col-md-4" >
          <label class="mb-0"for="mname">Middle Name:</label>
          <input class="form-control" type="text" value="" id="mname" name="mname">
      </div>
    </div>
    <div class="row">
      <div class="form-group col-md-4 offset-2" >
          <label class="mb-0" for="lname">Last Name:</label>
            <input class="form-control" type="text" value="" id="lname" name="lname">
      </div>
      <div class="form-group col-md-2 " >
          <label class="mb-0" for="suffix">Suffix:</label>
            <select class="form-control border" name="suffix">
              <option value="">N/A</option>
              <option value="Jr">Jr</option>
              <option value="Sr">Sr</option>
              <option value="II">II</option>
              <option value="III">III</option>
              <option value="IV">IV</option>
              <option value="1">Other</option>
            </select>
      </div>
      <div class="form-group col-md-2 other" >
          <label class="mb-0" for="specify">Specify:</label>
            <input class="form-control" type="text" value="" id="specify" name="specify">
      </div>
    </div>
    <div class="row">
      <div class="form-group col-md-3 offset-2" >
          <label class="mb-0"for="bday">Birthday:</label>
            <input class="form-control" type="date" value="" id="bday" name="bday">
      </div>
      <div class="form-group col-md-2 " >
          <label class="mb-0" for="gender">Gender:</label>
            <select class="form-control border" id="gender" name="gender">
              <option value=""></option>
              <option value="0">Female</option>
              <option value="1">Male</option>

            </select>
      </div>
      <div class="form-group col-md-4" >
          <label class="mb-0" for="contact">Contact Number:</label>
          <div class="input-container">
            <i class="fa icon">+63</i>
            <input class="form-control pl-0" type="text" value="" id="contact" name="contact" pattern="[1-9]{1}[0-9]{9}" required>
            </div>
      </div>
    </div>
    <div class="row">
      <div class="form-group col-md-4 offset-2" >
          <label class="mb-0" for="email">Email:</label>
            <input class="form-control" type="email" value="" id="email" name="email" required>
      </div>
    </div>
    <div class="row">
      <div class="form-group col-md-5 offset-2">
        <input type="submit" class="btn btn-primary" name="submit" value="Save Changes">

      </div>
    </div>

      </form>
</div>


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
